<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.podcast_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.podcast_form.title') ?> (<?= count($podcastPersons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Person.create'),
    route_to('person-create'),
    ['variant' => 'primary', 'iconLeft' => 'add'],
    ['class' => 'mr-2']
) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_open(route_to('podcast-person-edit', $podcast->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?php if ($podcastPersons): ?>

<?= form_section(
    lang('Person.podcast_form.manage_section_title'),
    lang('Person.podcast_form.manage_section_subtitle')
) ?>


<?= data_table(
    [
        [
            'header' => lang('Person.podcast_form.person'),
            'cell' => function ($podcastPerson) {
                return '<div class="flex">' .
                    '<a href="' .
                    route_to('person-view', $podcastPerson->person->id) .
                    "\"><img src=\"{$podcastPerson->person->image->thumbnail_url}\" alt=\"{$podcastPerson->person->full_name}\" class=\"object-cover w-16 h-16 rounded-full\" /></a>" .
                    '<div class="flex flex-col ml-3">' .
                    $podcastPerson->person->full_name .
                    ($podcastPerson->person_group && $podcastPerson->person_role
                        ? '<span class="text-sm text-gray-600">' .
                            lang(
                                "PersonsTaxonomy.persons.{$podcastPerson->person_group}.label"
                            ) .
                            ' ▸ ' .
                            lang(
                                "PersonsTaxonomy.persons.{$podcastPerson->person_group}.roles.{$podcastPerson->person_role}.label"
                            ) .
                            '</span>'
                        : '') .
                    (empty($podcastPerson->person->information_url)
                        ? ''
                        : "<a href=\"{$podcastPerson->person->information_url}\" target=\"_blank\" rel=\"noreferrer noopener\" class=\"text-sm text-blue-800 hover:underline\">" .
                            $podcastPerson->person->information_url .
                            '</a>') .
                    '</div></div>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($podcastPerson) {
                return button(
                    lang('Person.podcast_form.remove'),
                    route_to(
                        'podcast-person-remove',
                        $podcastPerson->podcast_id,
                        $podcastPerson->id
                    ),

                    ['variant' => 'danger', 'size' => 'small']
                );
            },
        ],
    ],
    $podcastPersons
) ?>

<?= form_section_close() ?>
<?php endif; ?>


<?= form_section(
    lang('Person.podcast_form.add_section_title'),
    lang('Person.podcast_form.add_section_subtitle')
) ?>

<?= form_label(
    lang('Person.podcast_form.person'),
    'person',
    [],
    lang('Person.podcast_form.person_hint')
) ?>
<?= form_multiselect('person[]', $personOptions, old('person', []), [
    'id' => 'person',
    'class' => 'form-select mb-4',
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Person.podcast_form.group_role'),
    'group_role',
    [],

    lang('Person.podcast_form.group_role_hint'),
    true
) ?>
<?= form_multiselect(
    'person_group_role[]',
    $taxonomyOptions,
    old('person_group_role', []),
    ['id' => 'person_group_role', 'class' => 'form-select mb-4']
) ?>
        
    
<?= form_section_close() ?>
<?= button(
    lang('Person.podcast_form.submit_add'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end']
) ?> 
<?= form_close() ?>

<?= $this->endSection() ?>
