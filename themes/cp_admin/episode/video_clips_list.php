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
                    'landscape' => 'aspect-video',
                    'portrait' => 'aspect-[9/16]',
                    'squared' => 'aspect-square',
                ];
                return '<a href="' . route_to('video-clip', $videoClip->podcast_id, $videoClip->episode_id, $videoClip->id) . '" class="inline-flex items-center font-semibold hover:underline gap-x-2 focus:ring-accent"><div class="relative"><span class="absolute block w-3 h-3 rounded-full -bottom-1 -left-1" data-tooltip="bottom" title="' . $videoClip->theme['name'] . '" style="background-color:hsl(' . $videoClip->theme['preview'] . ')"></span><div class="flex items-center justify-center h-6 overflow-hidden bg-black rounded-sm aspect-video" data-tooltip="bottom" title="' . $videoClip->format . '"><span class="flex items-center justify-center h-full text-white bg-gray-400 ' . $formatClass[$videoClip->format] . '"><Icon glyph="play"/></span></div></div>' . $videoClip->label . '</a>';
            },
        ],
        [
            'header' => lang('VideoClip.list.clip_id'),
            'cell' => function ($videoClip): string {
                return '<a href="' . route_to('video-clip', $videoClip->podcast_id, $videoClip->episode_id, $videoClip->id) . '" class="font-semibold hover:underline focus:ring-accent">#' . $videoClip->id . '</a><span class="ml-1 text-sm">by ' . $videoClip->user->username . '</span>';
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
