<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= $person->full_name ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= $person->full_name ?>

<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(
    lang('Person.edit'),
    route_to('person-edit', $person->id),
    [
        'variant' => 'secondary',
        'iconLeft' => 'edit',
    ],
    [
        'class' => 'mr-2',
    ],
) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="flex flex-wrap">
    <div class="w-full max-w-sm mb-6 md:mr-4">
        <img
            src="<?= $person->image->medium_url ?>"
            alt="$person->full_name"
            class="object-cover w-full rounded"
        />
    </div>

    <section class="w-full prose">
    <?= $person->full_name ?><br />
    <a href="<?= $person->information_url ?>"><?= $person->information_url ?></a>
    </section>
</div>

<?= $this->endSection() ?>
