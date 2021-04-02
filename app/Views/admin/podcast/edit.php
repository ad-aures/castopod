<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.edit') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_open_multipart(route_to('podcast-edit', $podcast->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?= form_section(
    lang('Podcast.form.identity_section_title'),
    lang('Podcast.form.identity_section_subtitle'),
) ?>

<?= form_label(lang('Podcast.form.image'), 'image') ?>
<img
    src="<?= $podcast->image->thumbnail_url ?>"
    alt="<?= $podcast->title ?>"
    class="object-cover w-32 h-32"
/>
<?= form_input([
    'id' => 'image',
    'name' => 'image',
    'class' => 'form-input',
    'type' => 'file',
    'accept' => '.jpg,.jpeg,.png',
]) ?>
<small class="mb-4 text-gray-600"><?= lang(
    'Common.forms.image_size_hint',
) ?></small>

<?= form_label(lang('Podcast.form.title'), 'title') ?>
<?= form_input([
    'id' => 'title',
    'name' => 'title',
    'class' => 'form-input mb-1',
    'value' => old('title', $podcast->title),
    'required' => 'required',
]) ?>
<span class="mb-4 text-sm"><?= $podcast->link ?></span>

<?= form_fieldset('', ['class' => 'mb-4']) ?>
    <legend><?= lang('Podcast.form.type.label') .
        hint_tooltip(lang('Podcast.form.type.hint'), 'ml-1') ?>
    </legend>
    <?= form_radio(
        ['id' => 'episodic', 'name' => 'type', 'class' => 'form-radio-btn'],
        'episodic',
        old('type') ? old('type') == 'episodic' : $podcast->type == 'episodic',
    ) ?>
    <label for="episodic"><?= lang('Podcast.form.type.episodic') ?></label>
    <?= form_radio(
        ['id' => 'serial', 'name' => 'type', 'class' => 'form-radio-btn'],
        'serial',
        old('type') ? old('type') == 'serial' : $podcast->type == 'serial',
    ) ?>
    <label for="serial"><?= lang('Podcast.form.type.serial') ?></label>
<?= form_fieldset_close() ?>

<div class="mb-4">
    <?= form_label(lang('Podcast.form.description'), 'description') ?>
    <?= form_textarea(
        [
            'id' => 'description',
            'name' => 'description',
            'class' => 'form-textarea',
            'required' => 'required',
        ],
        old('description', $podcast->description_markdown, false),
        'data-editor="markdown"',
    ) ?>
</div>

<?= form_section_close() ?>


<?= form_section(
    lang('Podcast.form.classification_section_title'),
    lang('Podcast.form.classification_section_subtitle'),
) ?>

<?= form_label(lang('Podcast.form.language'), 'language') ?>
<?= form_dropdown(
    'language',
    $languageOptions,
    old('language', $podcast->language_code),
    [
        'id' => 'language',
        'class' => 'form-select mb-4',
        'required' => 'required',
    ],
) ?>

<?= form_label(lang('Podcast.form.category'), 'category') ?>
<?= form_dropdown(
    'category',
    $categoryOptions,
    old('category', (string) $podcast->category_id),
    [
        'id' => 'category',
        'class' => 'form-select mb-4',
        'required' => 'required',
    ],
) ?>

<?= form_label(
    lang('Podcast.form.other_categories'),
    'other_categories',
    [],
    '',
    true,
) ?>
<?= form_multiselect(
    'other_categories[]',
    $categoryOptions,
    old('other_categories', $podcast->other_categories_ids),
    [
        'id' => 'other_categories',
        'class' => 'mb-4',
        'data-max-item-count' => '2',
    ],
) ?>

<?= form_fieldset('', ['class' => 'mb-4']) ?>
    <legend><?= lang('Podcast.form.parental_advisory.label') .
        hint_tooltip(lang('Podcast.form.parental_advisory.hint'), 'ml-1') ?>
    </legend>
    <?= form_radio(
        [
            'id' => 'undefined',
            'name' => 'parental_advisory',
            'class' => 'form-radio-btn',
        ],
        'undefined',
        old('parental_advisory')
            ? old('parental_advisory') === 'undefined'
            : $podcast->parental_advisory === null,
    ) ?>
    <label for="undefined"><?= lang(
        'Podcast.form.parental_advisory.undefined',
    ) ?></label>
    <?= form_radio(
        [
            'id' => 'clean',
            'name' => 'parental_advisory',
            'class' => 'form-radio-btn',
        ],
        'clean',
        old('parental_advisory')
            ? old('parental_advisory') === 'clean'
            : $podcast->parental_advisory === 'clean',
    ) ?>
    <label for="clean"><?= lang(
        'Podcast.form.parental_advisory.clean',
    ) ?></label>
    <?= form_radio(
        [
            'id' => 'explicit',
            'name' => 'parental_advisory',
            'class' => 'form-radio-btn',
        ],
        'explicit',
        old('parental_advisory')
            ? old('parental_advisory') === 'explicit'
            : $podcast->parental_advisory === 'explicit',
    ) ?>
    <label for="explicit"><?= lang(
        'Podcast.form.parental_advisory.explicit',
    ) ?></label>
<?= form_fieldset_close() ?>

<?= form_section_close() ?>

<?= form_section(
    lang('Podcast.form.author_section_title'),
    lang('Podcast.form.author_section_subtitle'),
) ?>

<?= form_label(
    lang('Podcast.form.owner_name'),
    'owner_name',
    [],
    lang('Podcast.form.owner_name_hint'),
) ?>
<?= form_input([
    'id' => 'owner_name',
    'name' => 'owner_name',
    'class' => 'form-input mb-4',
    'value' => old('owner_name', $podcast->owner_name),
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form.owner_email'),
    'owner_email',
    [],
    lang('Podcast.form.owner_email_hint'),
) ?>
<?= form_input([
    'id' => 'owner_email',
    'name' => 'owner_email',
    'class' => 'form-input mb-4',
    'value' => old('owner_email', $podcast->owner_email),
    'type' => 'email',
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form.publisher'),
    'publisher',
    [],
    lang('Podcast.form.publisher_hint'),
    true,
) ?>
<?= form_input([
    'id' => 'publisher',
    'name' => 'publisher',
    'class' => 'form-input mb-4',
    'value' => old('publisher', $podcast->publisher),
]) ?>

<?= form_label(lang('Podcast.form.copyright'), 'copyright', [], '', true) ?>
<?= form_input([
    'id' => 'copyright',
    'name' => 'copyright',
    'class' => 'form-input mb-4',
    'value' => old('copyright', $podcast->copyright),
]) ?>

<?= form_section_close() ?>

<?= form_section(
    lang('Podcast.form.location_section_title'),
    lang('Podcast.form.location_section_subtitle'),
) ?>

<?= form_label(
    lang('Podcast.form.location_name'),
    'location_name',
    [],
    lang('Podcast.form.location_name_hint'),
    true,
) ?>
<?= form_input([
    'id' => 'location_name',
    'name' => 'location_name',
    'class' => 'form-input mb-4',
    'value' => old('location_name', $podcast->location_name),
]) ?>
<?= form_section_close() ?>

<?= form_section(
    lang('Podcast.form.monetization_section_title'),
    lang('Podcast.form.monetization_section_subtitle'),
) ?>

<?= form_label(
    lang('Podcast.form.payment_pointer'),
    'payment_pointer',
    [],
    lang('Podcast.form.payment_pointer_hint'),
    true,
) ?>
<?= form_input([
    'id' => 'payment_pointer',
    'name' => 'payment_pointer',
    'class' => 'form-input mb-4',
    'value' => old('payment_pointer', $podcast->payment_pointer),
]) ?>

<?= form_label(lang('Podcast.form.partnership')) ?>
<div class="flex flex-col mb-4 gap-x-2 gap-y-4 md:flex-row">
    <div class="flex flex-col flex-shrink w-32">
        <?= form_label(
            lang('Podcast.form.partner_id'),
            'partner_id',
            [],
            lang('Podcast.form.partner_id_hint'),
            true,
        ) ?>
        <?= form_input([
            'id' => 'partner_id',
            'name' => 'partner_id',
            'class' => 'form-input w-full',
            'value' => old('partner_id', $podcast->partner_id),
        ]) ?>
    </div>
    <div class="flex flex-col flex-1">
        <?= form_label(
            lang('Podcast.form.partner_link_url'),
            'partner_link_url',
            [],
            lang('Podcast.form.partner_link_url_hint'),
            true,
        ) ?>
        <?= form_input([
            'id' => 'partner_link_url',
            'name' => 'partner_link_url',
            'class' => 'form-input w-full',
            'value' => old('partner_link_url', $podcast->partner_link_url),
        ]) ?>
    </div>
    <div class="flex flex-col flex-1">
        <?= form_label(
            lang('Podcast.form.partner_image_url'),
            'partner_image_url',
            [],
            lang('Podcast.form.partner_image_url_hint'),
            true,
        ) ?>
        <?= form_input([
            'id' => 'partner_image_url',
            'name' => 'partner_image_url',
            'class' => 'form-input w-full',
            'value' => old('partner_image_url', $podcast->partner_image_url),
        ]) ?>
    </div>
</div>
<?= form_section_close() ?>

<?= form_section(
    lang('Podcast.form.advanced_section_title'),
    lang('Podcast.form.advanced_section_subtitle'),
) ?>
<?= form_label(
    lang('Podcast.form.custom_rss'),
    'custom_rss',
    [],
    lang('Podcast.form.custom_rss_hint'),
    true,
) ?>
<?= form_textarea([
    'id' => 'custom_rss',
    'name' => 'custom_rss',
    'class' => 'form-textarea',
    'value' => old('custom_rss', $podcast->custom_rss_string),
]) ?>
<?= form_section_close() ?>

<?= form_section(
    lang('Podcast.form.status_section_title'),
    lang('Podcast.form.status_section_subtitle'),
) ?>

<?= form_switch(
    lang('Podcast.form.block'),
    ['id' => 'block', 'name' => 'block'],
    'yes',
    old('block', $podcast->is_blocked),
    'mb-2',
) ?>

<?= form_switch(
    lang('Podcast.form.complete'),
    ['id' => 'complete', 'name' => 'complete'],
    'yes',
    old('complete', $podcast->is_completed),
    'mb-2',
) ?>

<?= form_switch(
    lang('Podcast.form.lock') .
        hint_tooltip(lang('Podcast.form.lock_hint'), 'ml-1'),
    ['id' => 'lock', 'name' => 'lock'],
    'yes',
    old('lock', $podcast->is_locked),
) ?>

<?= form_section_close() ?>

<?= button(
    lang('Podcast.form.submit_edit'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
