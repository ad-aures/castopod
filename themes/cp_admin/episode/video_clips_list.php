<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.video_clips.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.video_clips.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= data_table(
    [
        [
            'header' => lang('Episode.list.episode'),
            'cell' => function ($videoClip): string {
                return $videoClip->label;
            },
        ],
        [
            'header' => lang('Episode.list.visibility'),
            'cell' => function ($videoClip): string {
                return $videoClip->status;
            },
        ],
    ],
    $videoClips,
    'mb-6'
) ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
