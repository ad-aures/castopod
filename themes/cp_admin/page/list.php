<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Page.all_pages') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Page.all_pages') ?> (<?= count($pages) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon('add-fill')?>
<Button uri="<?= route_to('page-create') ?>" variant="primary" iconLeft="add-fill"><?= lang('Page.create') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('Page.page'),
            'cell'   => function ($page) {
                return '<div class="flex flex-col">' .
                    esc($page->title) .
                    '<span class="text-sm text-skin-muted">/' .
                    esc($page->slug) .
                    '</span></div>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($page) {
                return '<Button uri="' . route_to('page', esc($page->slug)) . '" variant="secondary" size="small">' . lang('Page.go_to_page') . '</Button>' .
                '<Button uri="' . route_to('page-edit', $page->id) . '" variant="info" size="small">' . lang('Page.edit') . '</Button>' .
                '<Button uri="' . route_to('page-delete', $page->id) . '" variant="danger" size="small">' . lang('Page.delete') . '</Button>';
            },
        ],
    ],
    $pages,
) ?>

<?= $this->endSection() ?>
