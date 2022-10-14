<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.publish_date_edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.publish_date_edit') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= anchor(
    route_to('episode-view', $podcast->id, $episode->id),
    icon('arrow-left', 'mr-2 text-lg') . lang('Episode.publish_form.back_to_episode_dashboard'),
    [
        'class' => 'inline-flex items-center font-semibold mr-4 text-sm',
    ],
) ?>

<form action="<?= route_to('episode-publish_date_edit', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col items-start w-full max-w-lg mx-auto mt-4" data-submit="validate-message">
<?= csrf_field() ?>
<input type="hidden" name="client_timezone" value="UTC" />

<Forms.Field
    as="DatetimePicker"
    name="new_publication_date"
    label="<?= lang('Episode.publish_date_edit_form.new_publication_date') ?>"
    hint="<?= lang('Episode.publish_date_edit_form.new_publication_date_hint') ?>"
    value="<?= $episode->published_at ?>"
    required="true"
/>

<Button variant="primary" type="submit" class="mt-4"><?= lang('Episode.publish_date_edit_form.submit') ?></Button>

</form>

<?= $this->endSection() ?>
