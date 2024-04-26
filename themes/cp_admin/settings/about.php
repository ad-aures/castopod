<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('AboutCastopod.title') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('AboutCastopod.title') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="<?= route_to('update') ?>" method="POST">
    <?= csrf_field() ?>
    <button type="submit" name="action" value="database" class="inline-flex items-center px-4 py-2 text-lg font-semibold transition-colors rounded-full shadow group gap-x-2 bg-elevated hover:border-accent-hover focus:ring-accent border-3 border-subtle">
        <div class="relative">
            <?= icon('database-2-fill', [
                'class' => 'text-4xl text-accent-base',
            ]) ?>
            <?= icon('refresh-fill', [
                'class' => 'absolute bottom-0 right-0 rounded-full bg-elevated text-accent-base motion-safe:group-hover:animate-spin motion-safe:group-focus:animate-spin',
            ]) ?>
        </div>
        <?= lang('AboutCastopod.update_database') ?>
    </button>
</form>

<?php foreach ($info as $key => $value): ?>
<div class="px-4 py-5">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('AboutCastopod.' . $key) ?>
    </dt>
    <dd class="mt-1 text-sm leading-5">
        <?= $value ?>
    </dd>
</div>
<?php endforeach; ?>

<?= $this->endSection() ?>
