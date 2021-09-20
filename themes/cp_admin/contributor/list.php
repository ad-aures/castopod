<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.podcast_contributors') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.podcast_contributors') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('contributor-add', $podcast->id) ?>" variant="accent" iconLeft="add"><?= lang('Contributor.add') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('Contributor.list.username'),
            'cell' => function ($contributor) {
                return $contributor->username;
            },
        ],
        [
            'header' => lang('Contributor.list.role'),
            'cell' => function ($contributor): string {
                return lang('Contributor.roles.' . $contributor->podcast_role);
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($contributor, $podcast) {
                return '<Button uri="' . route_to('contributor-edit', $podcast->id, $contributor->id) . '" variant="info" size="small">' . lang('Contributor.edit') . '</Button>' .
                '<Button uri="' . route_to('contributor-remove', $podcast->id, $contributor->id) . '" variant="danger" size="small">' . lang('Contributor.remove') . '</Button>';
            },
        ],
    ],
    $podcast->contributors,
    '',
    $podcast,
) ?>

<?= $this->endSection() ?>
