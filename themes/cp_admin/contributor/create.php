<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Contributor.add_contributor', [esc($podcast->title)]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form method="POST" action="<?= route_to('contributor-add', $podcast->id) ?>" class="flex flex-col max-w-sm gap-y-4">
<?= csrf_field() ?>

<x-Forms.Field
    as="Select"
    name="user"
    label="<?= esc(lang('Contributor.form.user')) ?>"
    options="<?= esc(json_encode($contributorOptions)) ?>"
    placeholder="<?= lang('Contributor.form.user_placeholder') ?>"
    isRequired="true" />

<x-Forms.Field
    as="Select"
    name="role"
    label="<?= esc(lang('Contributor.form.role')) ?>"
    options="<?= esc(json_encode($roleOptions)) ?>"
    placeholder="<?= lang('Contributor.form.role_placeholder') ?>"
    defaultValue="<?= setting('AuthGroups.defaultPodcastGroup') ?>"
    isRequired="true" />

<x-Button type="submit" class="self-end" variant="primary"><?= lang('Contributor.form.submit_add') ?></x-Button>

</form>

<?= $this->endSection() ?>
