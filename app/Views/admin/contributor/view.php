<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.view', [
    'username' => $contributor->username,
    'podcastName' => $contributor->podcast->name,
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    Username
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    <?= $contributor->username ?>
    </dd>
</div>
<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    Role
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    <?= $contributor->podcast_role ?>
    </dd>
</div>
<?= $this->endSection() ?>
