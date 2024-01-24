<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.edit_role', [esc($contributor->username)]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.edit_role', [esc($contributor->username)]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form method="POST" action="<?= route_to('contributor-edit', $podcast->id, $contributor->id) ?>" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>

<Forms.Field
    as="Select"
    name="role"
    label="<?= esc(lang('Contributor.form.role')) ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    selected="<?= $contributorGroup ?>"
    placeholder="<?= lang('Contributor.form.role_placeholder') ?>"
    required="true" />

<Button variant="primary" type="submit" class="self-end"><?= lang('Contributor.form.submit_edit') ?></Button>

</form>

<?= $this->endSection() ?>
