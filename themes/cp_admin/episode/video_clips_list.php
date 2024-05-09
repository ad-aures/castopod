<?php declare(strict_types=1);

use App\Entities\Clip\VideoClip;
use CodeIgniter\I18n\Time;

?>
<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('VideoClip.list.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('VideoClip.list.title') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon('add-fill')?>
<x-Button uri="<?= route_to('video-clips-create', $podcast->id, $episode->id) ?>" variant="primary" iconLeft="add-fill"><?= lang('VideoClip.create') ?></x-Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= data_table(
    [
        [
            'header' => lang('VideoClip.list.status.label'),
            'cell'   => function ($videoClip): string {
                $pillVariantMap = [
                    'queued'   => 'default',
                    'pending'  => 'warning',
                    'running'  => 'primary',
                    'canceled' => 'default',
                    'failed'   => 'danger',
                    'passed'   => 'success',
                ];

                $pillIconMap = [
                    'queued'   => 'timer-fill', // @icon('timer-fill')
                    'pending'  => 'pause-fill', // @icon('pause-fill')
                    'running'  => 'loader-fill', // @icon('loader-fill')
                    'canceled' => 'forbid-fill', // @icon('forbid-fill')
                    'failed'   => 'close-fill', // @icon('close-fill')
                    'passed'   => 'check-fill', // @icon('check-fill')
                ];

                $pillIconClassMap = [
                    'queued'   => '',
                    'pending'  => '',
                    'running'  => 'animate-spin',
                    'canceled' => '',
                    'failed'   => '',
                    'passed'   => '',
                ];

                return '<x-Pill variant="' . $pillVariantMap[$videoClip->status] . '" icon="' . $pillIconMap[$videoClip->status] . '" iconClass="' . $pillIconClassMap[$videoClip->status] . '" hint="' . lang('VideoClip.list.status.' . $videoClip->status . '_hint') . '">' . lang('VideoClip.list.status.' . $videoClip->status) . '</x-Pill>';
            },
        ],
        [
            'header' => lang('VideoClip.list.clip'),
            'cell'   => function ($videoClip): string {
                $formatClass = [
                    'landscape' => 'aspect-video',
                    'portrait'  => 'aspect-[9/16]',
                    'squared'   => 'aspect-square',
                ];
                return '<a href="' . route_to('video-clip', $videoClip->podcast_id, $videoClip->episode_id, $videoClip->id) . '" class="inline-flex items-center w-full group gap-x-2"><div class="relative"><span class="absolute block w-3 h-3 rounded-full ring-2 ring-white -bottom-1 -left-1" data-tooltip="bottom" title="' . lang('Settings.theme.' . $videoClip->theme['name']) . '" style="background-color:hsl(' . $videoClip->theme['preview'] . ')"></span><div class="flex items-center justify-center h-6 overflow-hidden bg-black rounded-sm aspect-video" data-tooltip="bottom" title="' . lang('VideoClip.format.' . $videoClip->format) . '"><span class="flex items-center justify-center h-full text-white bg-gray-400 ' . $formatClass[$videoClip->format] . '">' . icon('play-fill') . '</span></div></div><div class="flex flex-col"><div class="text-sm">#' . $videoClip->id . ' – <span class="font-semibold group-hover:underline">' . esc($videoClip->title) . '</span><span class="ml-1 text-sm">by ' . esc($videoClip->user->username) . '</span></div><span class="text-xs">' . format_duration((int) $videoClip->duration) . '</span></div></a>';
            },
        ],
        [
            'header' => lang('VideoClip.list.duration'),
            'cell'   => function (VideoClip $videoClip): string {
                $duration = '';
                if ($videoClip->job_started_at !== null) {
                    if ($videoClip->job_ended_at !== null) {
                        $duration = '<div class="flex flex-col text-xs gap-y-1">' .
                        '<div class="inline-flex items-center font-mono gap-x-1">' . icon('timer-fill', [
                            'class' => 'text-sm text-gray-400',
                        ]) . format_duration((int) $videoClip->job_duration, true) . '</div>' .
                        '<div class="inline-flex items-center gap-x-1">' . icon('calendar-fill', [
                            'class' => 'text-sm text-gray-400',
                        ]) . relative_time($videoClip->job_ended_at) . '</div>' .
                        '</div>';
                    } else {
                        $duration = '<div class="inline-flex items-center font-mono text-xs gap-x-1">' . icon('timer-fill', [
                            'class' => 'text-sm text-gray-400',
                        ]) . format_duration(($videoClip->job_started_at->difference(Time::now()))->getSeconds(), true) . '</div>';
                    }
                }

                return $duration;
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($videoClip): string {
                $downloadButton = '';
                if ($videoClip->media) {
                    helper('misc');
                    $filename = 'clip-' . slugify($videoClip->title) . "-{$videoClip->start_time}-{$videoClip->end_time}";
                    // @icon('import-fill')
                    $downloadButton = '<x-IconButton glyph="import-fill" uri="' . $videoClip->media->file_url . '" download="' . $filename . '">' . lang('VideoClip.download_clip') . '</x-IconButton>';
                }

                return '<div class="inline-flex items-center gap-x-2">' . $downloadButton .
                '<button id="more-dropdown-' . $videoClip->id . '" type="button" class="inline-flex items-center p-1 rounded-full" data-dropdown="button" data-dropdown-target="more-dropdown-' . $videoClip->id . '-menu" aria-haspopup="true" aria-expanded="false">' .
                        icon('more-2-fill') .
                        '</button>' .
                        '<x-DropdownMenu id="more-dropdown-' . $videoClip->id . '-menu" labelledby="more-dropdown-' . $videoClip->id . '" offsetY="-24" items="' . esc(json_encode([
                            [
                                'type'  => 'link',
                                'title' => lang('VideoClip.go_to_page'),
                                'uri'   => route_to('video-clip', $videoClip->podcast_id, $videoClip->episode_id, $videoClip->id),
                            ],
                            [
                                'type'  => 'link',
                                'title' => lang('VideoClip.retry'),
                                'uri'   => route_to('video-clip-retry', $videoClip->podcast_id, $videoClip->episode_id, $videoClip->id),
                            ],
                            [
                                'type' => 'separator',
                            ],
                            [
                                'type'  => 'link',
                                'title' => lang('VideoClip.delete'),
                                'uri'   => route_to('video-clip-delete', $videoClip->podcast_id, $videoClip->episode_id, $videoClip->id),
                                'class' => 'font-semibold text-red-600',
                            ],
                        ])) . '" />' .
                        '</div>';
            },
        ],
    ],
    $videoClips,
    'mb-6'
) ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
