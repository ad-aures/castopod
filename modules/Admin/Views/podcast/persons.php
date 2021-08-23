<?= $this->extend('Modules\Admin\Views\_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.podcast_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.podcast_form.title') ?> (<?= count($podcast->persons) ?>)
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

<?= form_open(route_to('podcast-person-edit', $podcast->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?= form_section(
    lang('Person.podcast_form.manage_section_title'),
    lang('Person.podcast_form.manage_section_subtitle'),
) ?>


<?= data_table(
    [
        [
            'header' => lang('Person.podcast_form.person'),
            'cell' => function ($person) {
                return '<div class="flex">' .
                    '<a href="' .
                    route_to('person-view', $person->id) .
                    "\"><img src=\"{$person->image->thumbnail_url}\" alt=\"{$person->full_name}\" class=\"object-cover w-16 h-16 rounded-full\" /></a>" .
                    '<div class="flex flex-col ml-3">' .
                    $person->full_name .
                    implode(
                        '',
                        array_map(function ($role) {
                            return '<span class="text-sm text-gray-600">' .
                                lang(
                                    "PersonsTaxonomy.persons.{$role->group}.label",
                                ) .
                                ' › ' .
                                lang(
                                    "PersonsTaxonomy.persons.{$role->group}.roles.{$role->role}.label",
                                ) .
                                '</span>';
                        }, $person->roles),
                    ) .
                    ($person->information_url === null
                        ? ''
                        : "<a href=\"{$person->information_url}\" target=\"_blank\" rel=\"noreferrer noopener\" class=\"text-sm text-blue-800 hover:underline\">" .
                            $person->information_url .
                            '</a>') .
                    '</div></div>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($person): string {
                return button(
                    lang('Person.podcast_form.remove'),
                    route_to(
                        'podcast-person-remove',
                        $person->podcast_id,
                        $person->id,
                    ),
                    [
                        'variant' => 'danger',
                        'size' => 'small',
                    ],
                );
            },
        ],
    ],
    $podcast->persons,
) ?>

<?= form_section_close() ?>


<?= form_section(
    lang('Person.podcast_form.add_section_title'),
    lang('Person.podcast_form.add_section_subtitle'),
) ?>

<?= form_label(
    lang('Person.podcast_form.persons'),
    'persons',
    [],
    lang('Person.podcast_form.persons_hint'),
) ?>
<?= component('Forms/MultiSelect', ['options' => $personOptions, 'selected' => old('persons', [])], [
    'id' => 'persons',
    'name' => 'persons[]',
    'class' => 'mb-4',
    'required' => 'required',
    'data-max-item-count' => '2',
]) ?>

<?= form_label(
    lang('Person.podcast_form.roles'),
    'roles',
    [],
    lang('Person.podcast_form.roles_hint'),
    true,
) ?>
<?= component('Forms/MultiSelect', ['options' => $taxonomyOptions, 'selected' => old('roles', [])], [
    'id' => 'roles',
    'name' => 'roles[]',
    'class' => 'mb-4',
]) ?>

<?= form_section_close() ?>
<?= button(
    lang('Person.podcast_form.submit_add'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>
<?= form_close() ?>

<?= $this->endSection() ?>
