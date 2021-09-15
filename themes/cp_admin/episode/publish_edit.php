<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Episode.publish_edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Episode.publish_edit') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= anchor(
    route_to('episode-view', $podcast->id, $episode->id),
    icon('arrow-left', 'mr-2 text-lg') . lang('Episode.publish_form.back_to_episode_dashboard'),
    [
        'class' => 'inline-flex items-center font-semibold mr-4 text-sm',
    ],
) ?>

<form action="<?= route_to('episode-publish_edit', $podcast->id, $episode->id) ?>" method="POST" class="flex flex-col items-start max-w-xl mx-auto" data-submit="validate-message">
<?= csrf_field() ?>
<input type="hidden" name="client_timezone" value="UTC" />
<input type="hidden" name="post_id" value="<?= $post->id ?>" />

<label for="message" class="text-lg font-semibold"><?= lang(
    'Episode.publish_form.post',
) ?></label>
<small class="max-w-md mb-2 text-gray-600"><?= lang('Episode.publish_form.post_hint') ?></small>
<div class="mb-8 overflow-hidden bg-white shadow-md rounded-xl">
    <div class="flex px-4 py-3">
        <img src="<?= $podcast->actor->avatar_image_url ?>" alt="<?= $podcast->actor->display_name ?>" class="w-12 h-12 mr-4 rounded-full" />
        <div class="flex flex-col min-w-0">
            <p class="flex items-baseline min-w-0">
                <span class="mr-2 font-semibold truncate"><?= $podcast->actor->display_name ?></span>
                <span class="text-sm text-gray-500 truncate">@<?= $podcast->actor->username ?></span>
            </p>
            <?= relative_time($post->published_at, 'text-xs text-gray-500') ?>
        </div>
    </div>
    <div class="px-4 mb-2">
        <Forms.Textarea name="message" placeholder="<?= lang('Episode.publish_form.message_placeholder') ?>" autofocus="" value="<?= $post->message ?>" rows="2" />
    </div>
    <div class="flex border-t border-b">
        <img src="<?= $episode->image
                ->thumbnail_url ?>" alt="<?= $episode->title ?>" class="w-24 h-24" />
        <div class="flex flex-col flex-1">
            <a href="<?= $episode->link ?>" class="flex-1 px-4 py-2">
                <div class="flex items-baseline">
                    <span class="flex-1 w-0 mr-2 text-sm font-semibold truncate"><?= $episode->title ?></span>
                    <?= episode_numbering(
                    $episode->number,
                    $episode->season_number,
                    'text-xs font-semibold text-gray-600',
                    true,
                ) ?>
                </div>
                <div class="text-xs text-gray-600">
                    <?= relative_time($episode->published_at) ?>
                    <span class="mx-1">•</span>
                    <time datetime="PT<?= $episode->audio_file_duration ?>S">
                        <?= format_duration($episode->audio_file_duration) ?>
                    </time>
                </div>
            </a>
            <?= audio_player($episode->audio_file_url, $episode->audio_file_mimetype, 'mt-auto') ?>
        </div>
    </div>
    <footer class="flex justify-around px-6 py-3">
        <span class="inline-flex items-center"><Icon glyph="chat" class="mr-1 text-xl text-gray-400" />0</span>
        <span class="inline-flex items-center"><Icon glyph="repeat" class="mr-1 text-xl text-gray-400" />0</span>
        <span class="inline-flex items-center"><Icon glyph="heart" class="mr-1 text-xl text-gray-400" />0</span>
    </footer>
</div>

<fieldset class="flex flex-col">
<legend class="text-lg font-semibold"><?= lang(
                    'Episode.publish_form.publication_date',
                ) ?></legend>
    <Forms.Radio id="now" name="publication_method" isChecked="<?= old('publication_method') && old('publish') === 'now' ?>"><?= lang('Episode.publish_form.publication_method.now') ?></Forms.Radio>
    <div class="inline-flex flex-wrap items-center radio-toggler">
        <?= form_radio(
                    [
                        'id' => 'schedule',
                        'name' => 'publication_method',
                        'class' => 'text-pine-500 border-black border-3 focus:ring-2 focus:ring-pine-500 focus:ring-offset-2 focus:ring-offset-pine-100 w-6 h-6',
                    ],
                    'schedule',
                    old('publication_method') ? old('publication_method') === 'schedule' : true,
                ) ?>
        <Label for="schedule" class="pl-2 leading-8"><?= lang('Episode.publish_form.publication_method.schedule') ?></label>
        <div class="w-full mt-2 radio-toggler-element">
            <Forms.Field
                as="DatetimePicker"
                name="scheduled_publication_date"
                label="<?= lang('Episode.publish_form.scheduled_publication_date') ?>"
                hintText="<?= lang('Episode.publish_form.scheduled_publication_date_hint') ?>"
                value="<?= $episode->published_at ?>"
            />
        </div>
    </div>
</fieldset>

<Alert id="publish-warning" variant="warning" glyph="alert" class="hidden mt-2" title="<?= lang('Episode.publish_form.message_warning') ?>"><?= lang('Episode.publish_form.message_warning_hint') ?></Alert>

<div class="flex items-center justify-between w-full mt-4">
    <Button uri="<?= route_to('episode-publish-cancel', $podcast->id, $episode->id) ?>" variant="danger"><?= lang('Episode.publish_form.cancel_publication') ?></Button>
    <Button variant="primary" type="submit" data-btn-text-warning="<?= lang('Episode.publish_form.message_warning_submit') ?>" data-btn-text="<?= lang('Episode.publish_form.submit_edit') ?>"><?= lang('Episode.publish_form.submit_edit') ?></Button>
</div>

</form>

<?= $this->endSection() ?>
