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
            'header' => lang('VideoClip.list.status'),
            'cell' => function ($videoClip): string {
                $pillVariantMap = [
                    'queued' => 'default',
                    'pending' => 'warning',
                    'running' => 'primary',
                    'canceled' => 'default',
                    'failed' => 'danger',
                    'passed' => 'success',
                ];

                $pillIconMap = [
                    'queued' => 'timer',
                    'pending' => 'pause',
                    'running' => 'play',
                    'canceled' => 'forbid',
                    'failed' => 'close',
                    'passed' => 'check',
                ];

                return '<Pill variant="' . $pillVariantMap[$videoClip->status] . '" icon="' . $pillIconMap[$videoClip->status] . '">' . $videoClip->status . '</Pill>';
            },
        ],
        [
            'header' => lang('VideoClip.list.label'),
            'cell' => function ($videoClip): string {
                $formatClass = [
                    'landscape' => 'aspect-video h-4',
                    'portrait' => 'aspect-[9/16] w-4',
                    'squared' => 'aspect-square h-6',
                ];
                return '<a href="#" class="inline-flex items-center w-full hover:underline gap-x-2"><span class="block w-3 h-3 rounded-full" data-tooltip="bottom" title="' . $videoClip->theme['name'] . '" style="background-color:hsl(' . $videoClip->theme['preview'] . ')"></span><span class="flex items-center justify-center text-white bg-gray-400 rounded-sm ' . $formatClass[$videoClip->format] . '" data-tooltip="bottom" title="' . $videoClip->format . '"><Icon glyph="play"/></span>' . $videoClip->label . '</a>';
            },
        ],
        [
            'header' => lang('VideoClip.list.clip_id'),
            'cell' => function ($videoClip): string {
                return '#' . $videoClip->id . ' by ' . $videoClip->user->username;
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($videoClip): string {
                return '…';
            },
        ],
    ],
    $videoClips,
    'mb-6'
) ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
