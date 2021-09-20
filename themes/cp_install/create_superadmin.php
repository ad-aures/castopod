<?= $this->extend('_layout') ?>

<?= $this->section('content') ?>

<form action="<?= route_to('create-superadmin') ?>" method="POST" class="flex flex-col w-full max-w-sm gap-y-4">
<?= csrf_field() ?>

<div class="flex items-center mb-2">
    <span class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm font-semibold tracking-wider border-4 rounded-full text-pine-700 border-pine-700">4/4</span>
    <Heading tagName="h1"><?= lang('Install.form.create_superadmin') ?></Heading>
</div>

<Forms.Field
    name="email"
    label="<?= lang('Install.form.email') ?>"
    type="email"
    required="true" />

<Forms.Field
    name="username"
    label="<?= lang('Install.form.username') ?>"
    required="true" />

<Forms.Field
    name="password"
    label="<?= lang('Install.form.password') ?>"
    type="password"
    required="true"
    autocomplete="new-password" />

<Button variant="primary" type="submit" class="self-end" iconLeft="check"><?= lang('Install.form.submit') ?></Button>

</form>

<?= $this->endSection() ?>
