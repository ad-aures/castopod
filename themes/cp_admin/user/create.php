<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('user-create') ?>" method="POST" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>

<x-Forms.Field
    name="username"
    label="<?= esc(lang('User.form.username')) ?>"
    isRequired="true" />

<x-Forms.Field
    name="email"
    type="email"
    label="<?= esc(lang('User.form.email')) ?>"
    isRequired="true" />

<x-Forms.Field
    as="Select"
    name="role"
    label="<?= esc(lang('User.form.role')) ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    defaultValue="<?= setting('AuthGroups.defaultGroup') ?>"
    isRequired="true" />

<x-Button variant="primary" type="submit" class="self-end"><?= lang('User.form.submit_create') ?></x-Button>

</form>

<?= $this->endSection() ?>
