<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Contributor.add_contributor', [esc($podcast->title)]) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.add_contributor', [esc($podcast->title)]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form method="POST" action="<?= route_to('contributor-add', $podcast->id) ?>" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>

<Forms.Field
    as="Select"
    name="user"
    label="<?= lang('Contributor.form.user') ?>"
    options="<?= esc(json_encode($userOptions)) ?>"
    placeholder="<?= lang('Contributor.form.user_placeholder') ?>"
    required="true" />

<Forms.Field
    as="Select"
    name="role"
    label="<?= lang('Contributor.form.role') ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    placeholder="<?= lang('Contributor.form.role_placeholder') ?>"
    required="true" />

<Button type="submit" class="self-end" variant="primary"><?= lang('Contributor.form.submit_add') ?></Button>

</form>

<?= $this->endSection() ?>
