<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.episode_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.episode_form.title') ?> (<?= count($episodePersons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Person.create'),
    route_to('person-create'),
    ['variant' => 'primary', 'iconLeft' => 'add'],
    ['class' => 'mr-2'],
) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_open(route_to('episode-person-edit', $episode->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?php if ($episodePersons): ?>

<?= form_section(
    lang('Person.episode_form.manage_section_title'),
    lang('Person.episode_form.manage_section_subtitle'),
) ?>


<?= data_table(
    [
        [
            'header' => lang('Person.episode_form.person'),
            'cell' => function ($episodePerson) {
                return '<div class="flex">' .
                    '<a href="' .
                    route_to('person-view', $episodePerson->person->id) .
                    "\"><img src=\"{$episodePerson->person->image->thumbnail_url}\" alt=\"{$episodePerson->person->full_name}\" class=\"object-cover w-16 h-16 rounded-full\" /></a>" .
                    '<div class="flex flex-col ml-3">' .
                    $episodePerson->person->full_name .
                    ($episodePerson->person_group && $episodePerson->person_role
                        ? '<span class="text-sm text-gray-600">' .
                            lang(
                                "PersonsTaxonomy.persons.{$episodePerson->person_group}.label",
                            ) .
                            ' ▸ ' .
                            lang(
                                "PersonsTaxonomy.persons.{$episodePerson->person_group}.roles.{$episodePerson->person_role}.label",
                            ) .
                            '</span>'
                        : '') .
                    (empty($episodePerson->person->information_url)
                        ? ''
                        : "<a href=\"{$episodePerson->person->information_url}\" target=\"_blank\" rel=\"noreferrer noopener\" class=\"text-sm text-blue-800 hover:underline\">" .
                            $episodePerson->person->information_url .
                            '</a>') .
                    '</div></div>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($episodePerson): string {
                return button(
                    lang('Person.episode_form.remove'),
                    route_to(
                        'episode-person-remove',
                        $episodePerson->podcast_id,
                        $episodePerson->episode_id,
                        $episodePerson->id,
                    ),
                    [
                        'variant' => 'danger',
                        'size' => 'small',
                    ],
                );
            },
        ],
    ],
    $episodePersons,
) ?>

<?= form_section_close() ?>
<?php endif; ?>


<?= form_section(
    lang('Person.episode_form.add_section_title'),
    lang('Person.episode_form.add_section_subtitle'),
) ?>

<?= form_label(
    lang('Person.episode_form.person'),
    'person',
    [],
    lang('Person.episode_form.person_hint'),
) ?>
<?= form_multiselect('person[]', $personOptions, old('person', []), [
    'id' => 'person',
    'class' => 'form-select mb-4',
    'required' => 'required',
]) ?>

<?= form_label(
    lang('Person.episode_form.group_role'),
    'group_role',
    [],
    lang('Person.episode_form.group_role_hint'),
    true,
) ?>
<?= form_multiselect(
    'person_group_role[]',
    $taxonomyOptions,
    old('person_group_role', []),
    [
        'id' => 'person_group_role',
        'class' => 'form-select mb-4',
    ],
) ?>
        
    
<?= form_section_close() ?>
<?= button(
    lang('Person.episode_form.submit_add'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?> 
<?= form_close() ?>

<?= $this->endSection() ?>
