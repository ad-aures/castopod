<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.unpublish') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.unpublish') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_open(route_to('episode-unpublish', $podcast->id, $episode->id), [
    'class' => 'flex flex-col max-w-xl mx-auto',
]) ?>

<p class="flex max-w-xl p-2 mb-4 font-semibold text-red-900 bg-red-100 border border-red-300"><?= icon(
    'alert',
    'mr-4 text-2xl flex-shrink-0 text-red-500',
) . lang('Episode.unpublish_form.disclaimer') ?></p>

<label for="understand" class="inline-flex items-center mb-4">
    <?= form_checkbox(
    [
        'id' => 'understand',
        'name' => 'understand',
        'class' => 'text-pine-700',
        'required' => 'required',
    ],
    'yes',
    old('understand', false),
) ?>
    <span class="ml-2"><?= lang('Episode.unpublish_form.understand') ?></span>
</label>

<div class="self-end">
<?= button(
    lang('Common.cancel'),
    route_to('episode-view', $podcast->id, $episode->id),
) ?>

<?= button(
    lang('Episode.unpublish_form.submit'),
    '',
    [
        'variant' => 'danger',
    ],
    [
        'type' => 'submit',
    ],
) ?>
</div>


<?= form_close() ?>

<?= $this->endSection() ?>
