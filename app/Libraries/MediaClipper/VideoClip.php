<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace MediaClipper;

use App\Entities\Episode;
use GdImage;

class VideoClip
{
    /**
     * @var array<string, string>
     */
    public const FONTS = [
        'episodeTitle' => 'Rubik-Bold.ttf',
        'podcastTitle' => 'Inter-Regular.otf',
        'subtitles' => 'Inter-SemiBold',
        'episodeNumbering' => 'Inter-SemiBold.otf',
        'timestamp' => 'NotoSansMono-Regular.ttf',
    ];

    protected float $duration;

    protected string $soundbiteOutput;

    protected string $subtitlesClipOutput;

    protected string $videoClipBgOutput;

    protected string $videoClipOutput;

    protected ?string $episodeNumbering = null;

    /**
     * @var array<string, int|array<string, int|string>>
     */
    protected array $dimensions = [];

    /**
     * @var 'landscape'|'portrait'|'squared'
     */
    protected string $format = 'landscape';

    /**
     * @param 'landscape'|'portrait'|'squared' $format
     */
    public function __construct(
        protected Episode $episode,
        protected float $start,
        protected float $end,
        string $format,
    ) {
        $this->duration = $end - $start;
        $this->format = $format;
        $this->episodeNumbering = $this->episodeNumbering($this->episode->number, $this->episode->season_number);
        $this->dimensions = config('MediaClipper')
            ->formats[$format];

        helper('media');

        $podcastFolder = media_path("podcasts/{$this->episode->podcast->handle}");

        $this->soundbiteOutput = $podcastFolder . "/{$this->episode->slug}-soundbite-{$this->start}-to-{$this->end}.mp3";
        $this->subtitlesClipOutput = $podcastFolder . "/{$this->episode->slug}-subtitles-clip-{$this->start}-to-{$this->end}.srt";
        $this->videoClipBgOutput = $podcastFolder . "/{$this->episode->slug}-clip-bg-{$this->format}.png";
        $this->videoClipOutput = $podcastFolder . "/{$this->episode->slug}-clip-{$this->start}-to-{$this->end}.mp4";
    }

    public function soundbite(): void
    {
        $audioInput = media_path($this->episode->audio_file_path);
        $soundbiteCmd = "ffmpeg -y -ss {$this->start} -t {$this->duration} -i {$audioInput} {$this->soundbiteOutput}";
        exec($soundbiteCmd);
    }

    public function subtitlesClip(): void
    {
        if ($this->episode->transcript_file_path !== null) {
            $srtFileInput = media_path($this->episode->transcript_file_path);

            $subtitleClipCmd = "ffmpeg -y -i {$srtFileInput} -ss {$this->start} -t {$this->duration} {$this->subtitlesClipOutput}";
            exec($subtitleClipCmd);
        }
    }

    public function generate(): void
    {
        $this->soundbite();
        $this->subtitlesClip();

        // check if video clip bg already exists before generating it
        if (! file_exists($this->videoClipBgOutput)) {
            $this->generateVideoClipBg();
        }

        $generateCmd = $this->getCmd();

        shell_exec($generateCmd);
    }

    public function getCmd(): string
    {
        // @phpstan-ignore
        $filters = [
            "[0:a]aformat=channel_layouts=mono,showwaves=s={$this->dimensions['soundwaves']['width']}x{$this->dimensions['soundwaves']['height']}:mode=cline:rate=10:colors=white,format=yuva420p[waves]",
            "[waves]scale={$this->dimensions['width']}:{$this->dimensions['height']}:flags=neighbor[resizedwaves]",
            '[resizedwaves][3:v][4:v][5:v]threshold[cleanwaves]',
            '[cleanwaves][2:v]alphamerge[waves_t]',
            '[4:v][waves_t]overlay=x=0:y=0:shortest=1[waves_t2]',
            '[waves_t2]split[m][a]',
            '[m][a]alphamerge[waves_t3]',
            "[waves_t3]scale={$this->dimensions['soundwaves']['rescaleWidth']}:{$this->dimensions['soundwaves']['rescaleHeight']}[waves_final]",
            "[1:v][waves_final]overlay=x={$this->dimensions['soundwaves']['x']}:y={$this->dimensions['soundwaves']['y']}:shortest=1,drawtext=fontfile=" . $this->getFont(
                'timestamp'
            ) . ":text='%{pts\:gmtime\:{$this->start}\:%H\\\\\\\\\\:%M\\\\\\\\\\:%S\}':x={$this->dimensions['timestamp']['x']}:y={$this->dimensions['timestamp']['y']}:fontsize={$this->dimensions['timestamp']['fontsize']}:fontcolor=white:box=1:boxcolor=0x00564A:boxborderw={$this->dimensions['timestamp']['padding']}[v3]",
            "color=c=0x009486:s={$this->dimensions['width']}x{$this->dimensions['progressbar']['height']}[progressbar]",
            "[v3][progressbar]overlay=-w+(w/{$this->duration})*t:0:shortest=1:format=rgb,subtitles={$this->subtitlesClipOutput}:fontsdir=" . config(
                'MediaClipper'
            )->fontsFolder . ":force_style='Fontname=" . self::FONTS['subtitles'] . ",Alignment=5,Fontsize={$this->dimensions['subtitles']['fontsize']},BorderStyle=1,Outline=0,Shadow=0,MarginL={$this->dimensions['subtitles']['marginL']},MarginR={$this->dimensions['subtitles']['marginR']},MarginV={$this->dimensions['subtitles']['marginV']}'[outv]",
        ];

        $videoClipCmd = [
            'ffmpeg -y',
            "-i {$this->soundbiteOutput}",
            "-loop 1 -framerate 30 -i {$this->videoClipBgOutput}",
            "-loop 1 -framerate 30 -i {$this->dimensions['soundwaves']['mask']}",
            "-f lavfi -i color=gray:{$this->dimensions['width']}x{$this->dimensions['height']}",
            "-f lavfi -i color=black:{$this->dimensions['width']}x{$this->dimensions['height']}",
            "-f lavfi -i color=white:{$this->dimensions['width']}x{$this->dimensions['height']}",
            '-filter_complex "' . implode(';', $filters) . '"',
            '-map "[outv]"',
            '-map 0:a',
            '-acodec copy',
            '-vcodec libx264',
            "{$this->videoClipOutput}",
        ];

        // dd(implode(' ', $videoClipCmd));
        return implode(' ', $videoClipCmd);
    }

    private function episodeNumbering(?int $episodeNumber = null, ?int $seasonNumber = null,): ?string
    {
        if (! $episodeNumber && ! $seasonNumber) {
            return null;
        }

        $transKey = '';
        $args = [];
        if ($episodeNumber !== null) {
            $args['episodeNumber'] = sprintf('%02d', $episodeNumber);
        }

        if ($seasonNumber !== null) {
            $args['seasonNumber'] = sprintf('%02d', $seasonNumber);
        }

        if ($episodeNumber !== null && $seasonNumber !== null) {
            $transKey = 'Episode.season_episode';
        } elseif ($episodeNumber !== null && $seasonNumber === null) {
            $transKey = 'Episode.number';
        } elseif ($episodeNumber === null && $seasonNumber !== null) {
            $transKey = 'Episode.season';
        }

        return lang($transKey . '_abbr', $args);
    }

    private function generateVideoClipBg(): bool
    {
        $background = $this->generateColouredBg($this->dimensions['width'], $this->dimensions['height']);

        if ($background === null) {
            return false;
        }

        $episodeCover = imagecreatefromjpeg(media_path($this->episode->cover->path));
        if (! $episodeCover) {
            return false;
        }

        $scaledEpisodeCover = $this->scaleImage(
            $episodeCover,
            $this->dimensions['cover']['width'],
            $this->dimensions['cover']['height']
        );

        if (! $scaledEpisodeCover) {
            return false;
        }

        $roundedEpisodeCover = $this->roundCorners($scaledEpisodeCover, $this->dimensions['cover']['radius']);

        if (! $roundedEpisodeCover) {
            return false;
        }

        $isOverlaid = $this->overlayImages(
            $background,
            $roundedEpisodeCover,
            $this->dimensions['cover']['x'],
            $this->dimensions['cover']['y'],
            $this->dimensions['cover']['width'],
            $this->dimensions['cover']['height']
        );

        if (! $isOverlaid) {
            return false;
        }

        $this->addTextToImage(
            $background,
            $this->dimensions['episodeTitle']['x'],
            $this->dimensions['episodeTitle']['y'],
            $this->episode->title,
            $this->getFont('episodeTitle'),
            $this->dimensions['episodeTitle']['fontsize'],
            $this->dimensions['episodeTitle']['lines'],
            $this->dimensions['episodeTitle']['lineWidth'],
            $this->dimensions['episodeTitle']['leading'],
        );
        $this->addTextToImage(
            $background,
            $this->dimensions['podcastTitle']['x'],
            $this->dimensions['podcastTitle']['y'],
            $this->episode->podcast->title,
            $this->getFont('podcastTitle'),
            $this->dimensions['podcastTitle']['fontsize']
        );
        if ($this->episodeNumbering) {
            $this->addTextWithBox(
                $background,
                $this->dimensions['episodeNumbering']['x'],
                $this->dimensions['episodeNumbering']['y'],
                $this->episodeNumbering,
                $this->getFont('episodeNumbering'),
                $this->dimensions['episodeNumbering']['fontsize'],
                $this->dimensions['episodeNumbering']['paddingX'],
                $this->dimensions['episodeNumbering']['paddingY'],
            );
            // dd($this->episodeNumbering);
        }

        // Add quotes for subtitles
        $quotes = imagecreatefrompng(config('MediaClipper')->quotesImage);

        if (! $quotes) {
            return false;
        }

        $scaledQuotes = $this->scaleImage(
            $quotes,
            $this->dimensions['quotes']['width'],
            $this->dimensions['quotes']['height']
        );

        if (! $scaledQuotes) {
            return false;
        }

        $this->overlayImages(
            $background,
            $scaledQuotes,
            $this->dimensions['quotes']['x'],
            $this->dimensions['quotes']['y'],
            $this->dimensions['quotes']['width'],
            $this->dimensions['quotes']['height']
        );

        // Save Image
        imagepng($background, $this->videoClipBgOutput);

        return true;
    }

    private function getFont(string $name): string
    {
        return config('MediaClipper')->fontsFolder . self::FONTS[$name];
    }

    private function generateColouredBg(int $width, int $height): ?GdImage
    {
        $background = imagecreatetruecolor($width, $height);

        if ($background === false) {
            return null;
        }

        $coloredBackground = imagecolorallocate($background, 0, 86, 74);

        if ($coloredBackground === false) {
            return null;
        }

        imagefill($background, 0, 0, $coloredBackground);

        return $background;
    }

    private function scaleImage(GdImage $image, int $width, int $height): GdImage | false
    {
        return imagescale($image, $width, $height);
    }

    /**
     * Copied and adapted from https://stackoverflow.com/a/52626818
     */
    private function roundCorners(GdImage $source, int $radius): GdImage | false
    {
        $ws = imagesx($source);
        $hs = imagesy($source);

        $corner = $radius + 2;
        $s = $corner * 2;

        $src = imagecreatetruecolor($s, $s);
        if ($src === false) {
            return false;
        }
        imagecopy($src, $source, 0, 0, 0, 0, $corner, $corner);
        imagecopy($src, $source, $corner, 0, $ws - $corner, 0, $corner, $corner);
        imagecopy($src, $source, $corner, $corner, $ws - $corner, $hs - $corner, $corner, $corner);
        imagecopy($src, $source, 0, $corner, 0, $hs - $corner, $corner, $corner);

        $q = 8; # change this if you want
        $radius *= $q;

        # find unique color
        do {
            $r = rand(0, 255);
            $g = rand(0, 255);
            $b = rand(0, 255);
        } while (imagecolorexact($src, $r, $g, $b) < 0);

        $ns = $s * $q;

        $img = imagecreatetruecolor($ns, $ns);
        if ($img === false) {
            return false;
        }

        $alphacolor = imagecolorallocatealpha($img, $r, $g, $b, 127);

        if ($alphacolor === false) {
            return false;
        }

        imagealphablending($img, false);
        imagefilledrectangle($img, 0, 0, $ns, $ns, $alphacolor);

        imagefill($img, 0, 0, $alphacolor);
        imagecopyresampled($img, $src, 0, 0, 0, 0, $ns, $ns, $s, $s);
        imagedestroy($src);

        imagearc($img, $radius - 1, $radius - 1, $radius * 2, $radius * 2, 180, 270, $alphacolor);
        imagefilltoborder($img, 0, 0, $alphacolor, $alphacolor);
        imagearc($img, $ns - $radius, $radius - 1, $radius * 2, $radius * 2, 270, 0, $alphacolor);
        imagefilltoborder($img, $ns - 1, 0, $alphacolor, $alphacolor);
        imagearc($img, $radius - 1, $ns - $radius, $radius * 2, $radius * 2, 90, 180, $alphacolor);
        imagefilltoborder($img, 0, $ns - 1, $alphacolor, $alphacolor);
        imagearc($img, $ns - $radius, $ns - $radius, $radius * 2, $radius * 2, 0, 90, $alphacolor);
        imagefilltoborder($img, $ns - 1, $ns - 1, $alphacolor, $alphacolor);
        imagealphablending($img, true);
        imagecolortransparent($img, $alphacolor);

        # resize image down
        $dest = imagecreatetruecolor($s, $s);
        if ($dest === false) {
            return false;
        }
        imagealphablending($dest, false);
        imagefilledrectangle($dest, 0, 0, $s, $s, $alphacolor);
        imagecopyresampled($dest, $img, 0, 0, 0, 0, $s, $s, $ns, $ns);
        imagedestroy($img);

        # output image
        imagealphablending($source, false);
        imagecopy($source, $dest, 0, 0, 0, 0, $corner, $corner);
        imagecopy($source, $dest, $ws - $corner, 0, $corner, 0, $corner, $corner);
        imagecopy($source, $dest, $ws - $corner, $hs - $corner, $corner, $corner, $corner, $corner);
        imagecopy($source, $dest, 0, $hs - $corner, 0, $corner, $corner, $corner);
        imagealphablending($source, true);
        imagedestroy($dest);

        return $source;
    }

    private function overlayImages(
        GdImage $background,
        GdImage $foreground,
        int $x,
        int $y,
        int $width,
        int $height
    ): bool {
        return imagecopy($background, $foreground, $x, $y, 0, 0, $width, $height);
    }

    private function addTextToImage(
        GdImage $image,
        int $x,
        int $y,
        string $text,
        string $fontPath,
        int $fontsize,
        int $numberOfLines = 1,
        int $lineWidth = 32,
        int $leading = 5,
    ): bool {
        // Allocate A Color For The Text
        $white = imagecolorallocate($image, 255, 255, 255);

        if ($white === false) {
            return false;
        }

        if ($numberOfLines > 1) {
            $text = wordwrap($text, $lineWidth, PHP_EOL);
            preg_match_all('~' . PHP_EOL . '~', $text, $matches, PREG_OFFSET_CAPTURE);
            if (array_key_exists($numberOfLines - 1, $matches[0])) {
                $text = substr($text, 0, (int) $matches[0][$numberOfLines - 1][1]) . '…';
            }

            $lines = explode(PHP_EOL, $text);
            foreach ($lines as $i => $line) {
                // Print line On Image
                imagettftext($image, $fontsize, 0, $x, $y + (($fontsize + $leading) * $i), $white, $fontPath, $line);
            }
        } else {
            // Print Text On Image
            imagettftext($image, $fontsize, 0, $x, $y, $white, $fontPath, $text);
        }

        return true;
    }

    private function addTextWithBox(
        GdImage $image,
        int $x,
        int $y,
        string $text,
        string $fontPath,
        int $fontsize,
        int $paddingX = 0,
        int $paddingY = 0,
    ): bool {
        // Create some colors
        $white = imagecolorallocate($image, 255, 255, 255);
        $bgColor = imagecolorallocate($image, 0, 86, 74);

        if ($white === false || $bgColor === false) {
            return false;
        }

        $bbox = $this->calculateTextBox($fontsize, 0, $fontPath, $text);

        if ($bbox === false) {
            return false;
        }

        $x1 = $x + $bbox['left'];
        $y1 = $y + $bbox['top'];
        $x2 = $x + $bbox['width'] + $paddingX;
        $y2 = $y + $bbox['height'] + $paddingY;

        imagefilledrectangle($image, $x - $paddingX, $y - $paddingY, $x2, $y2, $bgColor);
        imagettftext($image, $fontsize, 0, $x1, $y1, $white, $fontPath, $text);

        return true;
    }

    /**
     * Adapted from: https://www.php.net/manual/fr/function.imagettfbbox.php#105593
     *
     * @return array<string, mixed>|false
     */
    private function calculateTextBox(int $fontSize, int $fontAngle, string $fontFile, string $text): array | false
    {
        /************
        simple function that calculates the *exact* bounding box (single pixel precision).
        The function returns an associative array with these keys:
        left, top:  coordinates you will pass to imagettftext
        width, height: dimension of the image you have to create
        *************/
        $bbox = imagettfbbox($fontSize, $fontAngle, $fontFile, $text);
        if (! $bbox) {
            return false;
        }
        $minX = min([$bbox[0], $bbox[2], $bbox[4], $bbox[6]]);
        $maxX = max([$bbox[0], $bbox[2], $bbox[4], $bbox[6]]);
        $minY = min([$bbox[1], $bbox[3], $bbox[5], $bbox[7]]);
        $maxY = max([$bbox[1], $bbox[3], $bbox[5], $bbox[7]]);

        return [
            'left' => abs($minX) - 1,
            'top' => abs($minY),
            'width' => $maxX - $minX,
            'height' => $maxY - $minY,
            'box' => $bbox,
        ];
    }
}
