<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.episode_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.episode_form.title') ?> (<?= count($episode->persons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Person.create'),
    route_to('person-create'),
    [
        'variant' => 'primary',
        'iconLeft' => 'add',
    ],
    [
        'class' => 'mr-2',
    ],
) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= form_open(route_to('episode-person-edit', $episode->id), [
    'method' => 'post',
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>


<?= form_section(
    lang('Person.episode_form.manage_section_title'),
    lang('Person.episode_form.manage_section_subtitle'),
) ?>


<?= data_table(
    [
        [
            'header' => lang('Person.episode_form.person'),
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
                    lang('Person.episode_form.remove'),
                    route_to(
                        'episode-person-remove',
                        $person->podcast_id,
                        $person->episode_id,
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
    $episode->persons,
) ?>

<?= form_section_close() ?>


<?= form_section(
    lang('Person.episode_form.add_section_title'),
    lang('Person.episode_form.add_section_subtitle'),
) ?>

<Forms.Label for="persons" hint="<?= lang('Person.episode_form.persons_hint') ?>"><?= lang('Person.episode_form.persons') ?></Forms.Label>
<Forms.MultiSelect id="persons" name="persons[]" class="mb-4" required="required" options="<?= htmlspecialchars(json_encode($personOptions)) ?>" selected="<?= htmlspecialchars(json_encode(old('persons', []))) ?>"/>

<Forms.Label for="roles" hint="<?= lang('Person.episode_form.roles_hint') ?>" isOptional="true"><?= lang('Person.episode_form.roles') ?></Forms.Label>
<Forms.MultiSelect id="roles" name="roles[]" class="mb-4" options="<?= htmlspecialchars(json_encode($taxonomyOptions)) ?>" selected="<?= htmlspecialchars(json_encode(old('roles', []))) ?>"/>

<?= form_section_close() ?>
<?= button(
    lang('Person.episode_form.submit_add'),
    '',
    [
        'variant' => 'primary',
    ],
    [
        'type' => 'submit',
        'class' => 'self-end',
    ],
) ?>
<?= form_close() ?>

<?= $this->endSection() ?>
