<?php 
?>

<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Podcast.create') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open_multipart(route_to('podcast-create'), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?= form_section(
    lang('Podcast.form.identity_section_title'),
    lang('Podcast.form.identity_section_subtitle'),
) ?>

<?= form_label(lang('Podcast.form.image'), 'image') ?>
<?= form_input([
    'id' => 'image',
    'name' => 'image',
    'class' => 'form-input',
    'required' => 'required',
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
    'class' => 'form-input mb-4',
    'value' => old('title'),
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Podcast.form.handle'),
    'handle',
    [],
    lang('Podcast.form.handle_hint'),
) ?>
<div class="relative mb-4">
    <?= icon('at', 'absolute text-xl h-full inset-0 text-gray-400 left-3') ?>
    <?= form_input([
        'id' => 'handle',
        'name' => 'handle',
        'class' => 'form-input w-full pl-8',
        'value' => old('handle'),
        'required' => 'required',
        ]) ?>
</div>

<?= form_fieldset('', ['class' => 'mb-4']) ?>
    <legend>
    <?= lang('Podcast.form.type.label') .
        hint_tooltip(lang('Podcast.form.type.hint'), 'ml-1') ?>
    </legend>
    <?= form_radio(
        ['id' => 'episodic', 'name' => 'type', 'class' => 'form-radio-btn'],
        'episodic',
        old('type') ? old('type') == 'episodic' : true,
    ) ?>
    <label for="episodic"><?= lang('Podcast.form.type.episodic') ?></label>
    <?= form_radio(
        ['id' => 'serial', 'name' => 'type', 'class' => 'form-radio-btn'],
        'serial',
        old('type') && old('type') == 'serial',
    ) ?>
    <label for="serial"><?= lang('Podcast.form.type.serial') ?></label>
<?= form_fieldset_close() ?>

<div class="mb-4">
    <Forms.Label for="description"><?= lang('Podcast.form.description') ?></Forms.Label>
    <Forms.MarkdownEditor id="description" name="description" required="required"><?= old('description', '', false) ?></Forms.MarkdownEditor>
</div>

<?= form_section_close() ?>


<?= form_section(
    lang('Podcast.form.classification_section_title'),
    lang('Podcast.form.classification_section_subtitle'),
) ?>

<?= form_label(lang('Podcast.form.language'), 'language') ?>
<?= form_dropdown('language', $languageOptions, [old('language', $browserLang)], [
    'id' => 'language',
    'class' => 'form-select mb-4',
    'required' => 'required',
]) ?>

<?= form_label(lang('Podcast.form.category'), 'category') ?>
<?= form_dropdown('category', $categoryOptions, [old('category', '')], [
    'id' => 'category',
    'class' => 'form-select mb-4',
    'required' => 'required',
    'placeholder' => lang('Podcast.form.category_placeholder')
]) ?>

<?= form_label(
    lang('Podcast.form.other_categories'),
    'other_categories',
    [],
    '',
    true,
) ?>
<Forms.MultiSelect
    id="other_categories"
    name="other_categories[]"
    class="mb-4"
    data-max-item-count="2"
    selected="<?= htmlspecialchars(json_encode(old('other_categories', []))) ?>"
    options="<?= htmlspecialchars(json_encode($categoryOptions)) ?>" />

<?= form_fieldset('', ['class' => 'mb-4']) ?>
    <legend>
    <?= lang('Podcast.form.parental_advisory.label') .
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
            : true,
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
        old('parental_advisory') && old('parental_advisory') === 'clean',
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
        old('parental_advisory') && old('parental_advisory') === 'explicit',
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
    'value' => old('owner_name'),
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
    'value' => old('owner_email'),
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
    'value' => old('publisher'),
]) ?>

<?= form_label(lang('Podcast.form.copyright'), 'copyright', [], '', true) ?>
<?= form_input([
    'id' => 'copyright',
    'name' => 'copyright',
    'class' => 'form-input mb-4',
    'value' => old('copyright'),
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
    'value' => old('location_name'),
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
    'value' => old('payment_pointer'),
]) ?>

<?= form_label(lang('Podcast.form.partnership')) ?>
<div class="flex flex-col mb-4 gap-x-2 gap-y-4 md:flex-row">
    <div class="flex flex-col flex-shrink">
        <?= form_label(
            lang('Podcast.form.partner_id'),
            'partner_id',
            ['class' => 'text-sm'],
            lang('Podcast.form.partner_id_hint'),
            true,
        ) ?>
        <?= form_input([
            'id' => 'partner_id',
            'name' => 'partner_id',
            'class' => 'form-input w-full',
            'value' => old('partner_id'),
        ]) ?>
    </div>
    <div class="flex flex-col">
        <?= form_label(
            lang('Podcast.form.partner_link_url'),
            'partner_link_url',
            ['class' => 'text-sm'],
            lang('Podcast.form.partner_link_url_hint'),
            true,
        ) ?>
        <?= form_input([
            'id' => 'partner_link_url',
            'name' => 'partner_link_url',
            'class' => 'form-input w-full',
            'value' => old('partner_link_url'),
        ]) ?>
    </div>
    <div class="flex flex-col">
        <?= form_label(
            lang('Podcast.form.partner_image_url'),
            'partner_image_url',
            ['class' => 'text-sm'],
            lang('Podcast.form.partner_image_url_hint'),
            true,
        ) ?>
        <?= form_input([
            'id' => 'partner_image_url',
            'name' => 'partner_image_url',
            'class' => 'form-input w-full',
            'value' => old('partner_image_url'),
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
<Forms.XMLEditor id="custom_rss" name="custom_rss"><?= old('custom_rss', '', false) ?></Forms.XMLEditor>

<?= form_section_close() ?>

<?= form_section(
    lang('Podcast.form.status_section_title'),
    lang('Podcast.form.status_section_subtitle'),
) ?>

<Forms.Toggler class="mb-2" id="lock" name="lock" value="yes" checked="<?= old('complete', true) ?>" hint="<?= lang('Podcast.form.lock_hint') ?>">
    <?= lang('Podcast.form.lock') ?>
</Forms.Toggler>
<Forms.Toggler class="mb-2" id="block" name="block" value="yes" checked="<?= old('complete', false) ?>">
    <?= lang('Podcast.form.block') ?>
</Forms.Toggler>
<Forms.Toggler id="complete" name="complete" value="yes" checked="<?= old('complete', false) ?>">
    <?= lang('Podcast.form.complete') ?>
</Forms.Toggler>

<?= form_section_close() ?>

<?= button(
    lang('Podcast.form.submit_create'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>


<?= $this->endSection() ?>
