<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
    <?= lang('Auth.resetYourPassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<p class="mb-4"><?= lang('Auth.enterCodeEmailPassword') ?></p>

<?= form_open(route_to('reset-password'), ['class' => 'flex flex-col']) ?>
<?= csrf_field() ?>

<?= form_label(lang('Auth.token'), 'token') ?>
<?= form_input([
    'id' => 'token',
    'name' => 'token',
    'class' => 'form-input mb-4',
    'value' => old('token', $token ?? ''),
    'required' => 'required',
]) ?>

<?= form_label(lang('Auth.email'), 'email') ?>
<?= form_input([
    'id' => 'email',
    'name' => 'email',
    'class' => 'form-input mb-4',
    'value' => old('email'),
    'required' => 'required',
    'type' => 'email',
]) ?>

<?= form_label(lang('Auth.newPassword'), 'password') ?>
<?= form_input([
    'id' => 'password',
    'name' => 'password',
    'class' => 'form-input mb-4',
    'type' => 'password',
    'required' => 'required',
    'autocomplete' => 'new-password',
]) ?>

<?= form_button([
    'content' => lang('Auth.resetPassword'),
    'class' => 'px-4 py-2 ml-auto border',
    'type' => 'submit',
]) ?>

<?= form_close() ?>

<?= $this->endSection() ?>
