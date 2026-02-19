<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\MediaClipper;

use App\Entities\Episode;
use Exception;
use GdImage;
use Modules\Media\Entities\Transcript;
use Modules\Media\FileManagers\FileManagerInterface;

/**
 * TODO: refactor this by splitting process modules into different classes (image generation, subtitles clip, video
 * generation)
 */
class VideoClipper
{
    /**
     * @var array<string, string>
     */
    final public const array FONTS = [
        'episodeTitle'     => 'Rubik-Bold.ttf',
        'podcastTitle'     => 'Inter-Regular.otf',
        'subtitles'        => 'Inter-SemiBold',
        'episodeNumbering' => 'Inter-SemiBold.otf',
        'timestamp'        => 'NotoSansMono-Regular.ttf',
    ];

    public ?string $logs = null;

    public bool $error = false;

    public string $videoClipFileKey;

    public string $videoClipOutput;

    protected float $duration;

    protected string $audioInput;

    protected string $episodeCoverPath;

    protected string $soundbiteOutput;

    protected string $subtitlesClipOutput;

    protected string $videoClipBgOutput;

    protected ?string $episodeNumbering = null;

    protected string $tempFileOutput;

    /**
     * @var array<string, mixed>
     */
    protected array $dimensions = [];

    /**
     * @var array<string, mixed>
     */
    protected array $colors = [];

    /**
     * @param 'landscape'|'portrait'|'squared' $format
     * @param 'pine'|'crimson'|'lake'|'amber'|'jacaranda'|'onyx' $theme
     */
    public function __construct(
        protected Episode $episode,
        protected float $start,
        protected float $end,
        protected string $format = 'landscape',
        protected string $theme = 'pine',
    ) {
        $this->duration = $end - $start;
        $this->episodeNumbering = $this->episodeNumbering($this->episode->number, $this->episode->season_number);
        $this->dimensions = config('MediaClipper')
            ->formats[$format];
        $this->colors = config('MediaClipper')
            ->themes[$theme];

        /** @var FileManagerInterface $fileManager */
        $fileManager = service('file_manager');

        $this->audioInput = $fileManager->getFileInput($this->episode->audio->file_key);
        $this->episodeCoverPath = $fileManager->getFileInput($this->episode->cover->file_key);

        // Temporary files to generate clip
        $tempFile = tempnam(WRITEPATH . 'temp', "{$this->episode->slug}-{$this->start}-{$this->end}");

        if (! $tempFile) {
            throw new Exception(
                'Could not create temporary files, check for permissions on your ' . WRITEPATH . 'temp folder.',
            );
        }

        $this->videoClipFileKey = "podcasts/{$this->episode->podcast->handle}/{$this->episode->slug}-clip-{$this->start}-to-{$this->end}-{$this->format}-{$this->theme}.mp4";

        $this->tempFileOutput = $tempFile;
        $this->videoClipOutput = $tempFile . '-video-clip.mp4';
        $this->soundbiteOutput = $tempFile . '-soundbite.mp3';
        $this->subtitlesClipOutput = $tempFile . '-subtitle.srt';
        $this->videoClipBgOutput = $tempFile . '-bg.png';
    }

    public function soundbite(): void
    {
        $soundbiteCmd = "ffmpeg -y -ss {$this->start} -t {$this->duration} -i {$this->audioInput} {$this->soundbiteOutput}";
        exec($soundbiteCmd);
    }

    public function subtitlesClip(): void
    {
        if (! $this->episode->transcript instanceof Transcript) {
            throw new Exception('Episode does not have a transcript!');
        }

        if ($this->episode->transcript->json_url) {
            $this->generateSubtitlesClipFromJson($this->episode->transcript->json_key);
        } else {
            $subtitlesInput = $this->episode->transcript->file_url;
            $subtitleClipCmd = "ffmpeg -y -i {$subtitlesInput} -ss {$this->start} -t {$this->duration} {$this->subtitlesClipOutput}";
            exec($subtitleClipCmd);
        }
    }

    public function generateSubtitlesClipFromJson(string $jsonFileKey): void
    {
        /** @var FileManagerInterface $fileManager */
        $fileManager = service('file_manager');

        $jsonTranscriptString = (string) $fileManager->getFileContents($jsonFileKey);
        if ($jsonTranscriptString === '') {
            throw new Exception('Cannot get transcript json contents.');
        }

        $jsonTranscript = json_decode($jsonTranscriptString, true);
        if ($jsonTranscript === null) {
            throw new Exception('Transcript json is invalid.');
        }

        $srtClip = '';
        $segmentIndex = 1;
        foreach ($jsonTranscript as $segment) {
            $startTime = null;
            $endTime = null;

            if ($segment['startTime'] < $this->end && $segment['endTime'] > $this->start) {
                $startTime = $segment['startTime'] - $this->start;
                $endTime = $segment['endTime'] - $this->start;
            }

            if ($segment['startTime'] < $this->start && $this->start < $segment['endTime']) {
                $startTime = 0;
            }

            if ($segment['startTime'] < $this->end && $segment['endTime'] >= $this->end) {
                $endTime = $this->duration;
            }

            if ($startTime !== null && $endTime !== null) {
                $formattedStartTime = $this->formatSeconds($startTime);
                $formattedEndTime = $this->formatSeconds($endTime);
                $srtClip .= <<<CODE_SAMPLE
                {$segmentIndex}
                {$formattedStartTime} --> {$formattedEndTime}
                {$segment['text']}


                CODE_SAMPLE;

                ++$segmentIndex;
            }
        }

        // create srt clip file
        file_put_contents($this->subtitlesClipOutput, $srtClip);
    }

    public function formatSeconds(float $seconds): string
    {
        $milliseconds = str_replace('0.', '', (string) (round($seconds - floor($seconds), 3)));

        return gmdate('H:i:s', (int) floor($seconds)) . ',' . str_pad($milliseconds, 3, '0', STR_PAD_RIGHT);
    }

    public function cleanTempFiles(): void
    {
        // delete generated video background image, soundbite & subtitlesClip
        unlink($this->tempFileOutput);
        unlink($this->soundbiteOutput);
        unlink($this->subtitlesClipOutput);
        unlink($this->videoClipBgOutput);
    }

    /**
     * @return int 0 for success, else error
     */
    public function generate(): int
    {
        $this->soundbite();
        $this->subtitlesClip();

        // check if video clip bg already exists before generating it
        if (! file_exists($this->videoClipBgOutput)) {
            $this->generateVideoClipBg();
        }

        $generateCmd = $this->getCmd();

        $cmdResult = $this->cmd_exec($generateCmd);

        $this->cleanTempFiles();

        return $cmdResult;
    }

    public function getCmd(): string
    {
        $filters = [
            "[0:a]aformat=channel_layouts=mono,showwaves=s={$this->dimensions['soundwaves']['width']}x{$this->dimensions['soundwaves']['height']}:mode=cline:rate=10:colors=white,format=rgb24[waves]",
            "[waves]scale={$this->dimensions['width']}:{$this->dimensions['height']}:flags=neighbor[resizedwaves]",
            '[resizedwaves][3:v][4:v][5:v]threshold[cleanwaves]',
            '[cleanwaves][2:v]alphamerge[waves_t]',
            '[4:v][waves_t]overlay=x=0:y=0:shortest=1[waves_t2]',
            '[waves_t2]split[m][a]',
            '[m][a]alphamerge[waves_t3]',
            "[waves_t3]scale={$this->dimensions['soundwaves']['rescaleWidth']}:{$this->dimensions['soundwaves']['rescaleHeight']},lutrgb=r='if(gt(val,100),{$this->colors['soundwaves'][0]},val)':g='if(gt(val,100),{$this->colors['soundwaves'][1]},val)':b='if(gt(val,100),{$this->colors['soundwaves'][2]},val)'[waves_final]",
            "[1:v][waves_final]overlay=x={$this->dimensions['soundwaves']['x']}:y={$this->dimensions['soundwaves']['y']}:shortest=1,drawtext=fontfile=" . $this->getFont(
                'timestamp',
            ) . ":text='%{pts\:gmtime\:{$this->start}\:%H\\\\\\\\\\:%M\\\\\\\\\\:%S\}':x={$this->dimensions['timestamp']['x']}:y={$this->dimensions['timestamp']['y']}:fontsize={$this->dimensions['timestamp']['fontsize']}:fontcolor=0x{$this->colors['timestampText']}:box=1:boxcolor=0x{$this->colors['timestampBg']}:boxborderw={$this->dimensions['timestamp']['padding']}[v3]",
            "color=c=0x{$this->colors['progressbar']}:s={$this->dimensions['width']}x{$this->dimensions['progressbar']['height']}[progressbar]",
            "[v3][progressbar]overlay=-w+(w/{$this->duration})*t:0:shortest=1:format=rgb,subtitles={$this->subtitlesClipOutput}:fontsdir=" . config(
                'MediaClipper',
            )->fontsFolder . ":force_style='Fontname=" . self::FONTS['subtitles'] . ",Alignment=5,Fontsize={$this->dimensions['subtitles']['fontsize']},PrimaryColour=&H{$this->colors['subtitles']}&,BorderStyle=1,Outline=0,Shadow=0,MarginL={$this->dimensions['subtitles']['marginL']},MarginR={$this->dimensions['subtitles']['marginR']},MarginV={$this->dimensions['subtitles']['marginV']}'[outv]",
            "[6:v]scale={$this->dimensions['watermark']['width']}:{$this->dimensions['watermark']['height']}[watermark]",
            "color=0x{$this->colors['watermarkBg']}:{$this->dimensions['watermark']['width']}x{$this->dimensions['watermark']['height']}[over]",
            '[over][watermark]overlay=x=0:y=0:shortest=1[watermark_box]',
            "[outv][watermark_box]overlay=x={$this->dimensions['watermark']['x']}:y={$this->dimensions['watermark']['y']}:shortest=1[watermarked]",
            '[watermarked]scale=w=-1:h=-1:out_color_matrix=bt709[outfinal]',
        ];

        $watermark = config('MediaClipper')
            ->watermark;

        $videoClipCmd = [
            'ffmpeg -y',
            "-i {$this->soundbiteOutput}",
            "-loop 1 -framerate 30 -i {$this->videoClipBgOutput}",
            "-loop 1 -framerate 30 -i {$this->dimensions['soundwaves']['mask']}",
            "-f lavfi -i color=gray:{$this->dimensions['width']}x{$this->dimensions['height']}",
            "-f lavfi -i color=black:{$this->dimensions['width']}x{$this->dimensions['height']}",
            "-f lavfi -i color=white:{$this->dimensions['width']}x{$this->dimensions['height']}",
            "-loop 1 -framerate 1 -i {$watermark}",
            '-filter_complex "' . implode(';', $filters) . '"',
            '-t ' . $this->duration,
            '-map "[outfinal]"',
            '-map 0:a',
            '-acodec aac',
            '-vcodec libx264 -pix_fmt yuv420p',
            "{$this->videoClipOutput}",
        ];

        return implode(' ', $videoClipCmd);
    }

    private function episodeNumbering(?int $episodeNumber = null, ?int $seasonNumber = null): ?string
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
        $background = $this->generateBackground($this->dimensions['width'], $this->dimensions['height']);

        if (! $background instanceof GdImage) {
            return false;
        }

        $episodeCover = $this->createCoverImage();
        if (! $episodeCover) {
            return false;
        }

        $scaledEpisodeCover = $this->scaleImage(
            $episodeCover,
            $this->dimensions['cover']['width'],
            $this->dimensions['cover']['height'],
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
            $this->dimensions['cover']['height'],
        );

        if (! $isOverlaid) {
            return false;
        }

        $this->addParagraphToImage(
            $background,
            $this->dimensions['podcastTitle']['x'],
            $this->dimensions['podcastTitle']['y'],
            $this->episode->podcast->title,
            $this->getFont('podcastTitle'),
            $this->dimensions['podcastTitle']['fontsize'],
            $this->dimensions['podcastTitle']['lineWidth'],
            $this->dimensions['podcastTitle']['lines'] ?? 1,
            $this->dimensions['podcastTitle']['lineHeight'] ?? 1,
        );

        $episodeNumberingWidth = 0;
        if ($this->episodeNumbering) {
            $episodeTitleBox = $this->calculateTextBox(
                $this->dimensions['episodeTitle']['fontsize'],
                0,
                $this->getFont('episodeTitle'),
                $this->episode->title,
            );
            $episodeNumberingBox = $this->calculateTextBox(
                $this->dimensions['episodeNumbering']['fontsize'],
                0,
                $this->getFont('episodeNumbering'),
                $this->episodeNumbering,
            );
            if (! $episodeTitleBox || ! $episodeNumberingBox) {
                return false;
            }

            $episodeTitleCenter = (int) ($episodeTitleBox['height'] / 2);
            $episodeNumberingCenter = (int) (($episodeNumberingBox['height'] + ($this->dimensions['episodeNumbering']['paddingY'] * 2)) / 2);
            $episodeNumberingWidth = $episodeNumberingBox['width'] + ($this->dimensions['episodeNumbering']['paddingX'] * 2);

            $this->addTextWithBox(
                $background,
                $this->dimensions['episodeTitle']['x'],
                $this->dimensions['episodeTitle']['y'] + $episodeTitleCenter - $episodeNumberingCenter,
                $this->episodeNumbering,
                $this->getFont('episodeNumbering'),
                $this->dimensions['episodeNumbering']['fontsize'],
                $this->colors['episodeNumberingText'],
                $this->colors['episodeNumberingBg'],
                $this->dimensions['episodeNumbering']['paddingX'],
                $this->dimensions['episodeNumbering']['paddingY'],
            );
        }

        $this->addParagraphToImage(
            $background,
            $this->dimensions['episodeTitle']['x'],
            $this->dimensions['episodeTitle']['y'],
            $this->episode->title,
            $this->getFont('episodeTitle'),
            $this->dimensions['episodeTitle']['fontsize'],
            $this->dimensions['episodeTitle']['lineWidth'],
            $this->dimensions['episodeTitle']['lines'],
            $this->dimensions['episodeTitle']['lineHeight'] ?? 1,
            $episodeNumberingWidth + ($episodeNumberingWidth === 0 ? 0 : $this->dimensions['episodeNumbering']['marginRight']),
        );

        // Add quotes for subtitles
        $quotes = imagecreatefrompng(config('MediaClipper')->quotesImage);

        if (! $quotes) {
            return false;
        }

        $cleanedQuotes = $this->cleanTransparency($quotes);

        if (! $cleanedQuotes) {
            return false;
        }

        imagefilter($cleanedQuotes, IMG_FILTER_CONTRAST, 255);
        imagefilter($cleanedQuotes, IMG_FILTER_COLORIZE, ...$this->colors['quotes']);

        $scaledQuotes = $this->scaleImage(
            $cleanedQuotes,
            $this->dimensions['quotes']['width'],
            $this->dimensions['quotes']['height'],
        );

        if (! $scaledQuotes) {
            return false;
        }

        imagesavealpha($scaledQuotes, true);
        $this->overlayImages(
            $background,
            $scaledQuotes,
            $this->dimensions['quotes']['x'],
            $this->dimensions['quotes']['y'],
            $this->dimensions['quotes']['width'],
            $this->dimensions['quotes']['height'],
        );

        // Save Image
        imagepng($background, $this->videoClipBgOutput);

        return true;
    }

    /**
     * @return int 0 (success), 1 - 2 - 254 - 255 (error)
     */
    private function cmd_exec(string $cmd): int
    {
        $outFile = tempnam(WRITEPATH . 'logs', 'cmd-out-');

        if (! $outFile) {
            return 254;
        }

        $descriptorSpec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['file', $outFile, 'w'],
            // FFmpeg outputs to stderr by default
        ];
        $proc = proc_open($cmd, $descriptorSpec, $pipes);

        if (! is_resource($proc)) {
            return 255;
        }

        fclose($pipes[0]);    //Don't really want to give any input

        $exit = proc_close($proc);

        $this->logs = (string) file_get_contents($outFile);

        // remove temporary files
        unlink($outFile);

        return $exit;
    }

    private function getFont(string $name): string
    {
        return config('MediaClipper')->fontsFolder . self::FONTS[$name];
    }

    private function generateBackground(int $width, int $height): ?GdImage
    {
        $background = imagecreatetruecolor($width, $height);

        if ($background === false) {
            return null;
        }

        $coloredBackground = imagecolorallocate($background, ...$this->colors['background']);

        if ($coloredBackground === false) {
            return null;
        }

        imagefill($background, 0, 0, $coloredBackground);

        return $background;
    }

    private function createCoverImage(): GdImage | false
    {
        return match ($this->episode->cover->file_mimetype) {
            'image/jpeg' => imagecreatefromjpeg($this->episodeCoverPath),
            'image/png'  => imagecreatefrompng($this->episodeCoverPath),
            default      => imagecreate(1400, 1400),
        };
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
            $r = random_int(0, 255);
            $g = random_int(0, 255);
            $b = random_int(0, 255);
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

        # output image
        imagealphablending($source, false);
        imagecopy($source, $dest, 0, 0, 0, 0, $corner, $corner);
        imagecopy($source, $dest, $ws - $corner, 0, $corner, 0, $corner, $corner);
        imagecopy($source, $dest, $ws - $corner, $hs - $corner, $corner, $corner, $corner, $corner);
        imagecopy($source, $dest, 0, $hs - $corner, 0, $corner, $corner, $corner);
        imagealphablending($source, true);

        return $source;
    }

    private function overlayImages(
        GdImage $background,
        GdImage $foreground,
        int $x,
        int $y,
        int $width,
        int $height,
    ): bool {
        return imagecopy($background, $foreground, $x, $y, 0, 0, $width, $height);
    }

    private function addParagraphToImage(
        GdImage $image,
        int $x,
        int $y,
        string $text,
        string $fontPath,
        int $fontsize,
        int $lineWidth,
        int $numberOfLines = 1,
        float $lineHeight = 1,
        int $paragraphIndent = 0,
    ): bool {
        // Allocate A Color For The Text
        $textColor = imagecolorallocate($image, ...$this->colors['text']);

        if ($textColor === false) {
            return false;
        }

        $lines = $this->textToParagraph($text, $fontPath, $fontsize, $lineWidth, $numberOfLines, $paragraphIndent);
        if (! $lines) {
            return false;
        }

        $leading = (int) ($fontsize * $lineHeight);
        foreach ($lines as $i => $line) {
            // Print line On Image
            imagettftext(
                $image,
                $fontsize,
                0,
                $x + ($paragraphIndent * ($i === 0 ? 1 : 0)),
                $y + $fontsize + ($leading * $i),
                $textColor,
                $fontPath,
                $line,
            );
        }

        return true;
    }

    /**
     * Adapted from: https://www.php.net/manual/fr/function.imagettfbbox.php#105593
     *
     * @return array<string, mixed>|false
     */
    private function calculateTextBox(int $fontSize, int $fontAngle, string $fontFile, string $text): array|bool
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
            'left'   => abs($minX) - 1,
            'top'    => abs($minY),
            'width'  => $maxX - $minX,
            'height' => $maxY - $minY,
            'box'    => $bbox,
        ];
    }

    /**
     * @param int[] $boxTextColor
     * @param int[] $boxBgColor
     */
    private function addTextWithBox(
        GdImage $image,
        int $x,
        int $y,
        string $text,
        string $fontPath,
        int $fontsize,
        array $boxTextColor,
        array $boxBgColor,
        int $paddingX = 0,
        int $paddingY = 0,
    ): bool {
        // Create some colors
        $textColor = imagecolorallocate($image, ...$boxTextColor);
        $bgColor = imagecolorallocate($image, ...$boxBgColor);

        if ($textColor === false || $bgColor === false) {
            return false;
        }

        $bbox = $this->calculateTextBox($fontsize, 0, $fontPath, $text);

        if ($bbox === false) {
            return false;
        }

        $x1 = $x + $bbox['left'] + $paddingX;
        $y1 = $y + $bbox['top'] + $paddingY;
        $x2 = $x + $bbox['width'] + ($paddingX * 2);
        $y2 = $y + $bbox['height'] + ($paddingY * 2);

        imagefilledrectangle($image, $x, $y, $x2, $y2, $bgColor);
        imagettftext($image, $fontsize, 0, $x1, $y1, $textColor, $fontPath, $text);

        return true;
    }

    /**
     * This helps getting a truly transparent background for images with transparency:
     * https://stackoverflow.com/a/2611911
     */
    private function cleanTransparency(GdImage $image): GdImage | false
    {
        $imageBg = imagecolorallocate($image, 0, 0, 0);
        if ($imageBg === false) {
            return false;
        }

        // removing the black from the image
        imagecolortransparent($image, $imageBg);

        // turning off alpha blending (to ensure alpha channel information
        // is preserved, rather than removed (blending with the rest of the
        // image in the form of black))
        imagealphablending($image, false);

        // turning on alpha channel information saving (to ensure the full range
        // of transparency is preserved)
        imagesavealpha($image, true);

        return $image;
    }

    /**
     * @return array<int, string>|false
     */
    private function textToParagraph(
        string $text,
        string $fontPath,
        int $fontsize,
        int $lineWidth,
        int $numberOfLines,
        int $paragraphIndent = 0,
    ): array|bool {
        // check length of text
        $bbox = $this->calculateTextBox($fontsize, 0, $fontPath, $text);
        if (! $bbox) {
            return false;
        }

        // return early if text width is less than line width
        if ($bbox['width'] <= $lineWidth) {
            return [$text];
        }

        // cut text in multiple lines based on the lineWidth property
        $lines = [''];
        $length = $paragraphIndent;
        $words = preg_split('~\b(?=\S)|(?=\s)~', $text);
        if (! $words) {
            return false;
        }

        $wordCount = count($words);
        $lineNumber = 0;
        for ($i = 0; $i < $wordCount; ++$i) {
            $word = $words[$i];
            $wordBox = $this->calculateTextBox($fontsize, 0, $fontPath, $word);
            if (! $wordBox) {
                return false;
            }

            $wordWidth = $wordBox['width'];

            if (($wordWidth + $length) > $lineWidth) {
                ++$lineNumber;
                if ($lineNumber > $numberOfLines - 1) {
                    $lines[$numberOfLines - 1] .= '…';
                    break;
                }

                $lines[$lineNumber] = '';
                $length = 0;

                // If the current word is just a space, don't bother. Skip (saves a weird-looking gap in the text).
                if ($word === ' ') {
                    continue;
                }
            }

            $lines[$lineNumber] .= $word;
            $length += $wordWidth;
        }

        return $lines;
    }
}
