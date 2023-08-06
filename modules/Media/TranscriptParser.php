<?php

declare(strict_types=1);

/**
 * Generates and renders a breadcrumb based on the current url segments
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
                    } else {
                        if ($subText !== '') {
                            $subText .= PHP_EOL . $line;
                        }

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

    private function getSecondsFromTimeString(string $timeString): float
    {
        $timeString = explode(',', $timeString);
        return (strtotime($timeString[0]) - strtotime('TODAY')) + (float) "0.{$timeString[1]}";
    }
}
