<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.episode_form.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.episode_form.title') ?> (<?= count($episode->persons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon('add-fill')?>
<x-Button variant="primary" uri="<?= route_to('person-create') ?>" iconLeft="add-fill"><?= lang('Person.create') ?></x-Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('episode-persons-manage', $podcast->id, $episode->id) ?>" method="POST" class="max-w-xl">
    <?= csrf_field() ?>

    <x-Forms.Section
        title="<?= lang('Person.episode_form.add_section_title') ?>"
        subtitle="<?= lang('Person.episode_form.add_section_subtitle') ?>"
    >

    <x-Forms.Field
        as="SelectMulti"
        id="persons"
        name="persons[]"
        label="<?= esc(lang('Person.episode_form.persons')) ?>"
        hint="<?= esc(lang('Person.episode_form.persons_hint')) ?>"
        options="<?= esc(json_encode($personOptions)) ?>"
        defaultValue="<?= esc(json_encode(old('persons', []))) ?>"
        isRequired="true"
    />

    <x-Forms.Field
        as="SelectMulti"
        id="roles"
        name="roles[]"
        label="<?= esc(lang('Person.episode_form.roles')) ?>"
        hint="<?= esc(lang('Person.episode_form.roles_hint')) ?>"
        options="<?= esc(json_encode($taxonomyOptions)) ?>"
        defaultValue="<?= esc(json_encode(old('roles', []))) ?>"
    />

    <x-Button variant="primary" type="submit" class="self-end"><?= lang('Person.episode_form.submit_add') ?></x-Button>

    </x-Forms.Section>

</form>

<?= data_table(
    [
        [
            'header' => lang('Person.episode_form.persons'),
            'cell'   => function ($person) {
                return '<div class="flex">' .
                    '<a href="' .
                    route_to('person-view', $person->id) .
                    '"><img src="' . get_avatar_url($person, 'thumbnail') . '" alt="' . esc($person->full_name) . '" class="object-cover w-16 rounded-full aspect-square" loading="lazy" /></a>' .
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
                // @icon('delete-bin-fill')
                return '<x-Button uri="' . route_to('episode-person-remove', $person->podcast_id, $person->episode_id, $person->id) . '" variant="danger" size="small" iconLeft="delete-bin-fill">' . lang('Person.episode_form.remove') . '</x-Button>';
            },
        ],
    ],
    $episode->persons,
    'max-w-xl mt-6'
) ?>

<?= $this->endSection() ?>
