<?= $this->extend('episode/_layout-preview') ?>

<?= $this->section('content') ?>

<?php if (isset($captions)) : ?>
    <div class="flex flex-col gap-2">
        <x-Button uri="<?= $transcript->file_url ?>" size="small" iconLeft="download" class="self-start" variant="secondary" target="_blank" download="" rel="noopener noreferrer"><?= lang('Episode.download_transcript', [
            'extension' => '.' . $transcript->file_extension,
        ]) ?></x-Button>
    <?php
    $previousSpeaker = '';
    $previousStartTime = '';
    $captionTextBlock = '';
    $renderCue = false;

    foreach ($captions as $caption) {
        $captionText = array_key_exists('text', $caption) ? $caption['text'] : '';

        if (isset($caption['speaker'])) {
            if ($caption['speaker'] !== $previousSpeaker) {
                if ($renderCue === true) {
                    echo view('episode/_partials/transcript', [
                        'startTime' => $startTimeFormatted ?? '',
                        'speaker'   => $speakerLabel ?? '',
                        'text'      => $captionTextBlock ?? '',
                    ]);
                    $captionTextBlock = '';
                }
                $startTimeFormatted = format_duration($caption['startTime']);
                $speakerLabel = $caption['speaker'];
                $captionTextBlock .= $captionText;
                $previousSpeaker = $speakerLabel;
                $renderCue = true;
            } else {
                // concatenate cues with the same speaker
                $captionTextBlock .= ' ' . $captionText;
            }
        } else {
            $startTimeFormatted = isset($caption['startTime']) ? format_duration($caption['startTime']) : '';
            echo view('episode/_partials/transcript', [
                'startTime' => $startTimeFormatted,
                'speaker'   => $caption['speaker'] ?? '',
                'text'      => $captionText ?? '',
            ]);
        }
    }
// render last cue if not already rendered
if ($captionTextBlock !== '') {
    echo view('episode/_partials/transcript', [
        'startTime' => $startTimeFormatted ?? '',
        'speaker'   => $speakerLabel ?? '',
        'text'      => $captionTextBlock ?? '',
    ]);
}
?>
    </div>
<?php else : ?>
    <div class="text-center"><?= lang('Episode.no_transcript') ?></div>
<?php endif; ?>
<?= $this->endSection() ?>
