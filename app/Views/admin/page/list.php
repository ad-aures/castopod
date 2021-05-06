<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Page.all_pages') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Page.all_pages') ?> (<?= count($pages) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(lang('Page.create'), route_to('page-create'), [
    'variant' => 'accent',
    'iconLeft' => 'add',
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('Page.page'),
            'cell' => function ($page) {
                return '<div class="flex flex-col">' .
                    $page->title .
                    '<span class="text-sm text-gray-600">/' .
                    $page->slug .
                    '</span></div>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($page) {
                return button(
                    lang('Page.go_to_page'),
                    route_to('page', $page->slug),
                    [
                        'variant' => 'secondary',
                        'size' => 'small',
                    ],
                    ['class' => 'mr-2'],
                ) .
                    button(
                        lang('Page.edit'),
                        route_to('page-edit', $page->id),
                        ['variant' => 'info', 'size' => 'small'],
                        ['class' => 'mr-2'],
                    ) .
                    button(
                        lang('Page.delete'),
                        route_to('page-delete', $page->id),
                        ['variant' => 'danger', 'size' => 'small'],
                    );
            },
        ],
    ],
    $pages,
) ?>

<?= $this->endSection() ?>
