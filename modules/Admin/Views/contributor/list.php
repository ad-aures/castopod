<?= $this->extend('Modules\Admin\Views\_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.podcast_contributors') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.podcast_contributors') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(lang('Contributor.add'), route_to('contributor-add', $podcast->id), [
    'variant' => 'accent',
    'iconLeft' => 'add',
]) ?>
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
                return button(
                    lang('Contributor.edit'),
                    route_to(
                        'contributor-edit',
                        $podcast->id,
                        $contributor->id,
                    ),
                    [
                        'variant' => 'info',
                        'size' => 'small',
                    ],
                    ['class' => 'mr-2'],
                ) .
                    button(
                        lang('Contributor.remove'),
                        route_to(
                            'contributor-remove',
                            $podcast->id,
                            $contributor->id,
                        ),
                        [
                            'variant' => 'danger',
                            'size' => 'small',
                        ],
                        ['class' => 'mr-2'],
                    );
            },
        ],
    ],
    $podcast->contributors,
    '',
    $podcast,
) ?>

<?= $this->endSection() ?>
