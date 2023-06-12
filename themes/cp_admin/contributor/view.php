<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.view', [
    'username'     => esc($contributor->username),
    'podcastTitle' => esc($podcast->title),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.view', [
    'username'     => esc($contributor->username),
    'podcastTitle' => esc($podcast->title),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="px-4 py-5 bg-base sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('Contributor.list.username') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5 sm:mt-0 sm:col-span-2">
    <?= esc($contributor->username) ?>
    </dd>
</div>
<div class="px-4 py-5 bg-base sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('Contributor.list.role') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5 sm:mt-0 sm:col-span-2">
    <?= $contributor->podcast_role ?>
    </dd>
</div>
<?= $this->endSection() ?>
