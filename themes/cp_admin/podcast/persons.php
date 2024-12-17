<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.podcast_form.title') ?> (<?= count($podcast->persons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("add-fill")?>
<x-Button uri="<?= route_to('person-create') ?>" variant="primary" iconLeft="add-fill"><?= lang('Person.create') ?></x-Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('podcast-persons-manage', $podcast->id) ?>" method="POST" class="max-w-xl">
    <?= csrf_field() ?>

    <x-Forms.Section
        title="<?= lang('Person.podcast_form.add_section_title') ?>"
        subtitle="<?= lang('Person.podcast_form.add_section_subtitle') ?>"
    >

    <x-Forms.Field
        as="SelectMulti"
        id="persons"
        name="persons"
        label="<?= esc(lang('Person.podcast_form.persons')) ?>"
        hint="<?= esc(lang('Person.podcast_form.persons_hint')) ?>"
        options="<?= esc(json_encode($personOptions)) ?>"
        defaultValue="<?= esc(json_encode(old('persons', []))) ?>"
        isRequired="true" />

    <x-Forms.Field
        as="SelectMulti"
        id="roles"
        name="roles"
        label="<?= esc(lang('Person.podcast_form.roles')) ?>"
        hint="<?= esc(lang('Person.podcast_form.roles_hint')) ?>"
        options="<?= esc(json_encode($taxonomyOptions)) ?>"
        defaultValue="<?= esc(json_encode(old('roles', []))) ?>"
    />

    <x-Button variant="primary" class="self-end" type="submit"><?= lang('Person.podcast_form.submit_add') ?></x-Button>

    </x-Forms.Section>
</form>

<?= data_table(
    [
        [
            'header' => lang('Person.podcast_form.persons'),
            'cell'   => function ($person) {
                return '<div class="flex">' .
                    '<a href="' .
                    route_to('person-view', $person->id) .
                    '"><img src="' . get_avatar_url($person, 'thumbnail') . '" alt="' . esc($person->full_name) . '" class="object-cover w-16 h-16 rounded-full aspect-square" loading="lazy" /></a>' .
                    '<div class="flex flex-col ml-3">' .
                    esc($person->full_name) .
                    implode(
                        '',
                        array_map(function ($role) {
                            return '<span class="text-sm text-skin-muted">' .
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
                        : '<a href="' . esc($person->information_url) . '" target="_blank" rel="noreferrer noopener" class="text-sm font-semibold text-accent-base hover:text-accent-hover">' .
                            esc($person->information_url) .
                            '</a>') .
                    '</div></div>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($person): string {
                // @icon("delete-bin-fill")
                return '<x-Button uri="' . route_to('podcast-person-remove', $person->podcast_id, $person->id) . '" variant="danger" size="small" iconLeft="delete-bin-fill">' . lang('Person.podcast_form.remove') . '</x-Button>';
            },
        ],
    ],
    $podcast->persons,
    'max-w-xl mt-6'
) ?>

<?= $this->endSection() ?>