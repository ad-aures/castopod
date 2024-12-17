<?= $this->extend('../cp_admin/_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.view', [
    esc($subscription->id),
]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $subscription->email ?>

<?= $this->endSection() ?>
