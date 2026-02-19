<?php

declare(strict_types=1);

/**
 * Converts a SRT or VTT file to JSON
 *
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Media;

use Exception;
use stdClass;

class TranscriptParser
{
    protected string $transcriptContent;

    public function loadString(string $content): self
    {
        $this->transcriptContent = $content;

        return $this;
    }

    /**
     * Adapted from: https://stackoverflow.com/a/11659306
     *
     * @return string Returns the json encoded string
     */
    public function parseSrt(): string
    {
        if (! defined('SRT_STATE_SUBNUMBER')) {
            define('SRT_STATE_SUBNUMBER', 0);
        }

        if (! defined('SRT_STATE_TIME')) {
            define('SRT_STATE_TIME', 1);
        }

        if (! defined('SRT_STATE_TEXT')) {
            define('SRT_STATE_TEXT', 2);
        }

        if (! defined('SRT_STATE_BLANK')) {
            define('SRT_STATE_BLANK', 3);
        }

        $subs = [];
        $state = SRT_STATE_SUBNUMBER;
        $subNum = 0;
        $subText = '';
        $subTime = '';

        $lines = explode(PHP_EOL, $this->transcriptContent);
        foreach ($lines as $line) {
            switch ($state) {
                case SRT_STATE_SUBNUMBER:
                    $subNum = trim($line);
                    $state = SRT_STATE_TIME;
                    break;

                case SRT_STATE_TIME:
                    $subTime = trim($line);
                    $state = SRT_STATE_TEXT;
                    break;

                case SRT_STATE_TEXT:
                    if (trim($line) === '') {
                        $sub = new stdClass();
                        $sub->number = (int) $subNum;
                        [$startTime, $endTime] = explode(' --> ', $subTime);
                        $sub->startTime = $this->getSecondsFromTimeString($startTime);
                        $sub->endTime = $this->getSecondsFromTimeString($endTime);
                        $sub->text = trim($subText);
                        $subText = '';
                        $state = SRT_STATE_SUBNUMBER;
                        $subs[] = $sub;
                    } elseif ($subText !== '') {
                        $subText .= PHP_EOL . $line;
                    } else {
                        $subText .= $line;
                    }

                    break;
            }
        }

        if ($state === SRT_STATE_TEXT) {
            // if file was missing the trailing newlines, we'll be in this
            // state here.  Append the last read text and add the last sub.
            // @phpstan-ignore-next-line
            $sub->text = $subText;
            // @phpstan-ignore-next-line
            $subs[] = $sub;
        }

        $jsonString = json_encode($subs, JSON_PRETTY_PRINT);

        if (! $jsonString) {
            throw new Exception('Failed to parse SRT to JSON.');
        }

        return $jsonString;
    }

    public function parseVtt(): string
    {
        if (! defined('VTT_STATE_HEADER')) {
            define('VTT_STATE_HEADER', 0);
        }

        if (! defined('VTT_STATE_BLANK')) {
            define('VTT_STATE_BLANK', 1);
        }

        if (! defined('VTT_STATE_TIME')) {
            define('VTT_STATE_TIME', 2);
        }

        if (! defined('VTT_STATE_TEXT')) {
            define('VTT_STATE_TEXT', 3);
        }

        $subs = [];
        $state = VTT_STATE_HEADER;
        $subNum = 0;
        $subText = '';
        $subTime = '';

        $lines = explode(PHP_EOL, $this->transcriptContent);
        // add a newline as last item, if it isn't already a newline
        if (array_last($lines) !== '') {
            $lines[] = PHP_EOL;
        }

        foreach ($lines as $line) {
            switch ($state) {
                case VTT_STATE_HEADER:
                    $state = VTT_STATE_BLANK;
                    break;

                case VTT_STATE_BLANK:
                    $speakercount = 0;
                    $state = VTT_STATE_TIME;
                    break;

                case VTT_STATE_TIME:
                    $subTime = trim($line);
                    $state = VTT_STATE_TEXT;
                    break;

                case VTT_STATE_TEXT:
                    if (trim($line) === '') {
                        $state = VTT_STATE_TIME;
                        // @phpstan-ignore-next-line
                    } elseif ($subText !== '') {
                        $subText .= PHP_EOL . $line;
                    } else {
                        /** VTT includes a lot of information on the spoken line
                         * An example may look like this:
                         * <v.loud.top John>So this is it
                         * We need to break this down into it's components, namely:
                         * 1. The actual words for the caption
                         * 2. Who is speaking
                         * 3. Any styling cues encoded in the VTT (which we dump)
                         * More information: https://www.w3.org/TR/webvtt1/
                         *
                         * If there is more than one speaker in a cue, we also need
                         * to handle this, to repeat the start and end times for
                         * the second cue.
                         * */

                        $vtt_speaker_pattern = '/^<.*>/U';
                        $removethese = ['</v>', '<', '>'];
                        preg_match($vtt_speaker_pattern, $line, $matches);
                        if (isset($matches[0])) {
                            $subVoiceCue = str_replace($removethese, '', $matches[0]);
                            $subSpeaker = substr($subVoiceCue, strpos($subVoiceCue, ' '));
                        } else {
                            $subSpeaker = '';
                        }

                        $subText .= preg_replace($vtt_speaker_pattern, '', $line);
                        $sub = new stdClass();
                        $sub->number = $subNum;
                        [$startTime, $endTime] = explode(' --> ', $subTime);
                        $sub->startTime = $this->getSecondsFromVTTTimeString($startTime);
                        $sub->endTime = $this->getSecondsFromVTTTimeString($endTime);
                        $sub->text = trim($subText);
                        if ($subSpeaker !== '') {
                            $sub->speaker = trim($subSpeaker);
                        }

                        $subText = '';
                        $subs[] = $sub;
                        ++$subNum;
                    }

                    break;
            }
        }

        $jsonString = json_encode($subs, JSON_PRETTY_PRINT);

        if (! $jsonString) {
            throw new Exception('Failed to parse VTT to JSON.');
        }

        return $jsonString;
    }

    private function getSecondsFromTimeString(string $timeString): float
    {
        $timeString = explode(',', $timeString);
        return (strtotime($timeString[0]) - strtotime('TODAY')) + (float) "0.{$timeString[1]}";
    }

    private function getSecondsFromVTTTimeString(string $timeString): float
    {
        $timeString = explode('.', $timeString);
        if (substr_count($timeString[0], ':') === 1) {
            // add hours if only MM:SS.mmm format
            $timeString[0] = '00:' . $timeString[0];
        }

        return (strtotime($timeString[0]) - strtotime('TODAY')) + (float) "0.{$timeString[1]}";
    }
}
