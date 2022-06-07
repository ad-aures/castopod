<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.delete') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('podcast-delete', $podcast->id) ?>" method="POST" class="flex flex-col w-full max-w-xl mx-auto">
<?= csrf_field() ?>

<Alert variant="danger" glyph="alert" class="font-semibold"><?= lang('Podcast.delete_form.disclaimer') ?></Alert>

<Forms.Checkbox class="mt-2" name="understand" required="true" isChecked="false"><?= lang('Podcast.delete_form.understand') ?></Forms.Checkbox>

<div class="self-end mt-4">
    <Button uri="<?= route_to('podcast-view', $podcast->id) ?>"><?= lang('Common.cancel') ?></Button>
    <Button type="submit" variant="danger"><?= lang('Podcast.delete_form.submit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
