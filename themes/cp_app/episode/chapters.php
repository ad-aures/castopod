<?= $this->extend('episode/_layout') ?>

<?= $this->section('content') ?>

<?php if (isset($chapters)): ?>
    <div class="flex flex-col gap-2">
        <?php foreach ($chapters['chapters'] as $chapter) {
            if (isset($chapter['toc'])) {
                if ($chapter['toc'] !== true) {
                    continue;
                }
            }

            echo view('episode/_partials/chapter', [
                'title'         => array_key_exists('title', $chapter) ? $chapter['title'] : '',
                'startTime'     => format_duration($chapter['startTime']),
                'chapterImgUrl' => array_key_exists('img', $chapter) ? $chapter['img'] : $episode->cover->thumbnail_url,
                'chapterUrl'    => array_key_exists('url', $chapter) ? $chapter['url'] : '',
            ]);
        } ?>
    </div>
<?php else: ?>
    <div class="text-center"><?= lang('Episode.no_chapters') ?></div>
<?php endif; ?>
<?= $this->endSection() ?>
