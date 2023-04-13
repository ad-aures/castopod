<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= esc($person->full_name) ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= esc($person->full_name) ?>

<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('person-edit', $person->id) ?>" variant="secondary" iconLeft="edit"><?= lang('Person.edit') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-wrap gap-2">
    <img
        src="<?= get_avatar_url($person, 'medium') ?>"
        alt="<?= esc($person->full_name) ?>"
        class="object-cover w-full max-w-xs rounded aspect-square"
        loading="lazy"
    />
    <div class="flex flex-col">
        <?= esc($person->full_name) ?>
        <a class="font-semibold no-underline text-accent-base hover:underline" href="<?= esc($person->information_url) ?>"><?= esc($person->information_url) ?></a>
    </div>
</div>

<?= $this->endSection() ?>
