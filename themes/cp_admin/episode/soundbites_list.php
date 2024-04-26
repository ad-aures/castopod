<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Soundbite.list.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Soundbite.list.title') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon('add-fill')?>
<Button uri="<?= route_to('soundbites-create', $podcast->id, $episode->id) ?>" variant="primary" iconLeft="add-fill"><?= lang('Soundbite.create') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('Soundbite.list.soundbite'),
            'cell'   => function ($soundbite): string {
                return '<div class="flex gap-x-2"><play-soundbite audio-src="' . $soundbite->episode->audio->file_url . '" start-time="' . $soundbite->start_time . '" duration="' . $soundbite->duration . '" play-label="' . lang('Soundbite.play') . '" playing-label="' . lang('Soundbite.stop') . '"></play-soundbite><div class="flex flex-col"><span class="text-sm font-semibold">' . esc($soundbite->title) . '</span><span class="text-xs">' . format_duration((int) $soundbite->duration) . '</span></div></div>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($soundbite): string {
                return '<button id="more-dropdown-' . $soundbite->id . '" type="button" class="inline-flex items-center p-1 rounded-full focus:ring-accent" data-dropdown="button" data-dropdown-target="more-dropdown-' . $soundbite->id . '-menu" aria-haspopup="true" aria-expanded="false">' .
                icon('more-2-fill') .
                '</button>' .
                '<DropdownMenu id="more-dropdown-' . $soundbite->id . '-menu" labelledby="more-dropdown-' . $soundbite->id . '" offsetY="-24" items="' . esc(json_encode([
                    [
                        'type'  => 'link',
                        'title' => lang('Soundbite.delete'),
                        'uri'   => route_to('soundbites-delete', $soundbite->podcast_id, $soundbite->episode_id, $soundbite->id),
                        'class' => 'font-semibold text-red-600',
                    ],
                ])) . '" />';
            },
        ],
    ],
    $soundbites,
    'mb-6',
) ?>

<?= $pager->links() ?>

<?= $this->endSection() ?>
