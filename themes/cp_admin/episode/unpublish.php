<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.unpublish') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.unpublish') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('episode-unpublish', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col max-w-lg mx-auto">
<?= csrf_field() ?>

<Alert variant="danger" class="font-semibold"><?= lang('Episode.unpublish_form.disclaimer') ?></Alert>

<Forms.Checkbox class="mt-2" name="understand" required="true" isChecked="false"><?= lang('Episode.unpublish_form.understand') ?></Forms.Checkbox>

<div class="self-end mt-4">
    <Button uri="<?= route_to('episode-view', $podcast->id, $episode->id) ?>"><?= lang('Common.cancel') ?></Button>
    <Button type="submit" variant="danger"><?= lang('Episode.unpublish_form.submit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
