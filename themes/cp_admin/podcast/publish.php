<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.publish') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= anchor(
    route_to('podcast-view', $podcast->id),
    icon('arrow-left-line', [
        'class' => 'mr-2 text-lg',
    ]) . lang('Podcast.publish_form.back_to_podcast_dashboard'),
    [
        'class' => 'inline-flex items-center font-semibold mr-4 text-sm',
    ],
) ?>

<form action="<?= route_to('podcast-publish', $podcast->id) ?>" method="POST" class="flex flex-col items-start w-full max-w-lg mx-auto mt-4" data-submit="validate-message">
<?= csrf_field() ?>
<input type="hidden" name="client_timezone" value="UTC" />

<label for="message" class="text-lg font-semibold"><?= lang(
    'Podcast.publish_form.post',
) ?></label>
<small class="max-w-md mb-2 text-skin-muted"><?= lang('Podcast.publish_form.post_hint') ?></small>
<div class="mb-8 overflow-hidden shadow-md bg-elevated rounded-xl">
    <div class="flex px-4 py-3 gap-x-2">
        <img src="<?= $podcast->actor->avatar_image_url ?>" alt="<?= esc($podcast->actor->display_name) ?>" class="w-10 h-10 rounded-full aspect-square" loading="lazy" />
        <div class="flex flex-col min-w-0">
            <p class="flex items-baseline min-w-0">
                <span class="mr-2 font-semibold truncate"><?= esc($podcast->actor->display_name) ?></span>
                <span class="text-sm truncate text-skin-muted">@<?= esc($podcast->actor->username) ?></span>
            </p>
        </div>
    </div>
    <div class="px-4 mb-2">
        <x-Forms.Textarea name="message" placeholder="<?= lang('Podcast.publish_form.message_placeholder') ?>" autofocus="" rows="2" />
    </div>
    <footer class="flex justify-around px-6 py-3">
        <span class="inline-flex items-center"><?= icon('chat-4-fill', [
            'class' => 'mr-1 text-xl opacity-40',
        ]) ?>0</span>
        <span class="inline-flex items-center"><?= icon('repeat-fill', [
            'class' => 'mr-1 text-xl opacity-40',
        ]) ?>0</span>
        <span class="inline-flex items-center"><?= icon('heart-fill', [
            'class' => 'mr-1 text-xl opacity-40',
        ]) ?>0</span>
    </footer>
</div>

<fieldset class="flex flex-col">
    <legend class="text-lg font-semibold"><?= lang(
        'Podcast.publish_form.publication_date',
    ) ?></legend>
    <x-Forms.Radio value="now" name="publication_method" isChecked="<?= old('publication_method') ? old('publish') === 'now' : true ?>"><?= lang('Podcast.publish_form.publication_method.now') ?></x-Forms.Radio>
    <div class="inline-flex flex-wrap items-center radio-toggler">
        <input
            class="w-6 h-6 border-contrast text-accent-base border-3"
            type="radio" id="schedule" name="publication_method" value="schedule" <?= old('publication_method') && old('publication_method') === 'schedule' ? 'checked' : '' ?> />
        <x-Label for="schedule" class="pl-2 leading-8"><?= lang('Podcast.publish_form.publication_method.schedule') ?></label>
        <div class="w-full mt-2 radio-toggler-element">
            <x-Forms.Field
                as="DatetimePicker"
                name="scheduled_publication_date"
                label="<?= esc(lang('Podcast.publish_form.scheduled_publication_date')) ?>"
                hint="<?= esc(lang('Podcast.publish_form.scheduled_publication_date_hint')) ?>"
                value="<?= $podcast->published_at ?>"
            />
        </div>
    </div>
</fieldset>

<x-Alert id="publish-warning" variant="warning" class="hidden mt-2" title="<?= lang('Podcast.publish_form.message_warning') ?>"><?= lang('Podcast.publish_form.message_warning_hint') ?></x-Alert>

<div class="flex items-center justify-between w-full mt-4">
    <x-Button uri="<?= route_to('podcast-publish-cancel', $podcast->id) ?>" variant="danger"><?= lang('Podcast.publish_form.cancel_publication') ?></x-Button>
    <x-Button variant="primary" type="submit" data-btn-text-warning="<?= lang('Podcast.publish_form.message_warning_submit') ?>" data-btn-text="<?= lang('Podcast.publish_form.submit') ?>"><?= lang('Podcast.publish_form.submit') ?></x-Button>
</div>

</form>

<?= $this->endSection() ?>
