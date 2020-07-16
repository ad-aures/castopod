<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('MyAccount.info') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    Email
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    <?= user()->email ?>
    </dd>
</div>
<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    Username
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    <?= user()->username ?>
    </dd>
</div>
<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    Permissions
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    [<?= implode(', ', user()->permissions) ?>]
    </dd>
</div>

<?= $this->endSection()
?>
