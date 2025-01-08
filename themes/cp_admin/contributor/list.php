<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.podcast_contributors') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.podcast_contributors') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("add-fill")?>
<Button uri="<?= route_to('contributor-add', $podcast->id) ?>" variant="primary" iconLeft="add-fill"><?= lang('Contributor.add') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('Contributor.list.username'),
            'cell'   => function ($contributor) {
                return esc($contributor->username);
            },
        ],
        [
            'header' => lang('Contributor.list.role'),
            'cell'   => function ($contributor, $podcast): string {
                $role = get_group_info(get_podcast_group($contributor, $podcast->id), $podcast->id)['title'];

                if ($podcast->created_by === $contributor->id) {
                    $role = '<div class="inline-flex items-center"><span class="mr-2 focus:ring-accent" tabindex="0" data-tooltip="bottom" title="' . lang('Auth.podcast_groups.owner.title') . '">' . icon('shield-user-fill') . '</span>' . $role . '</div>';
                }

                return $role;
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($contributor, $podcast) {
                // @icon("pencil-fill")
                // @icon("delete-bin-fill")
                return '<Button uri="' . route_to('contributor-edit', $podcast->id, $contributor->id) . '" variant="secondary" iconLeft="pencil-fill" size="small">' . lang('Contributor.edit') . '</Button>' .
                '<Button uri="' . route_to('contributor-remove', $podcast->id, $contributor->id) . '" variant="danger" iconLeft="delete-bin-fill" size="small">' . lang('Contributor.remove') . '</Button>';
            },
        ],
    ],
    $podcast->contributors,
    '',
    $podcast,
) ?>

<?= $this->endSection() ?>
