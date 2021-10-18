<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.episode_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.episode_form.title') ?> (<?= count($episode->persons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button variant="primary" uri="<?= route_to('person-create') ?>" iconLeft="add"><?= lang('Person.create') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('episode-persons-manage', $podcast->id, $episode->id) ?>" method="POST">
    <?= csrf_field() ?>

    <Forms.Section
        title="<?= lang('Person.episode_form.add_section_title') ?>"
        subtitle="<?= lang('Person.episode_form.add_section_subtitle') ?>"
    >

    <Forms.Field
        as="MultiSelect"
        id="persons"
        name="persons[]"
        label="<?= lang('Person.episode_form.persons') ?>"
        hint="<?= lang('Person.episode_form.persons_hint') ?>"
        options="<?= htmlspecialchars(json_encode($personOptions)) ?>"
        selected="<?= htmlspecialchars(json_encode(old('persons', []))) ?>"
        required="true"
    />

    <Forms.Field
        as="MultiSelect"
        id="roles"
        name="roles[]"
        label="<?= lang('Person.episode_form.roles') ?>"
        hint="<?= lang('Person.episode_form.roles_hint') ?>"
        options="<?= htmlspecialchars(json_encode($taxonomyOptions)) ?>"
        selected="<?= htmlspecialchars(json_encode(old('roles', []))) ?>"
        required="true"
    />

    <Button variant="primary" type="submit" class="self-end"><?= lang('Person.episode_form.submit_add') ?></Button>

    </Forms.Section>

</form>

<?= data_table(
    [
        [
            'header' => lang('Person.episode_form.persons'),
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
                return '<Button uri="' . route_to('episode-person-remove', $person->podcast_id, $person->episode_id, $person->id) . '" variant="danger" size="small" iconLeft="delete-bin">' . lang('Person.episode_form.remove') . '</Button>';
            },
        ],
    ],
    $episode->persons,
    'max-w-xl mt-6'
) ?>

<?= $this->endSection() ?>
