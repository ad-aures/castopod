<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $person->full_name ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $person->full_name ?>

<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('person-edit', $person->id) ?>" variant="secondary" iconLeft="edit"><?= lang('Person.edit') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-wrap gap-2">
    <img
        src="<?= $person->avatar->medium_url ?>"
        alt="$person->full_name"
        class="object-cover w-full max-w-xs rounded aspect-square"
    />
    <div class="flex flex-col">
        <?= $person->full_name ?>
        <a class="font-semibold no-underline text-accent-base hover:underline" href="<?= $person->information_url ?>"><?= $person->information_url ?></a>
    </div>
</div>

<?= $this->endSection() ?>
