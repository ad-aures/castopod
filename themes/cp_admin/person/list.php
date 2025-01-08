<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Person.all_persons') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Person.all_persons') ?> (<?= count($persons) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("add-fill")?>
<Button uri="<?= route_to('person-create') ?>" variant="primary" iconLeft="add-fill"><?= lang('Person.create') ?></Button>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if ($persons !== null): ?>
    <div class="grid gap-4 grid-cols-cards">
        <?php foreach ($persons as $person): ?>
            <?= view('person/_card', [
                'person' => $person,
            ]) ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="italic"><?= lang('Person.no_person') ?></p>
<?php endif; ?>

<?= $this->endSection() ?>
