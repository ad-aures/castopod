<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('user-create') ?>" method="POST" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>

<Forms.Field
    name="username"
    label="<?= lang('User.form.username') ?>"
    required="true" />

<Forms.Field
    name="email"
    type="email"
    label="<?= lang('User.form.email') ?>"
    required="true" />

<Forms.Field
    as="Select"
    name="role"
    label="<?= lang('User.form.role') ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    selected="<?= setting('AuthGroups.defaultGroup') ?>"
    required="true" />

<Button variant="primary" type="submit" class="self-end"><?= lang('User.form.submit_create') ?></Button>

</form>

<?= $this->endSection() ?>
