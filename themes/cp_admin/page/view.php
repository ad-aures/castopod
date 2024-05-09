<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($page->title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($page->title) ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon('add-fill')?>
<x-Button variant="primary" uri="<?= route_to('page-edit', $page->id) ?>" iconLeft="add-fill"><?= lang('Page.edit') ?></x-Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="prose">
    <?= $page->content_html ?>
</div>
<?= $this->endSection() ?>
