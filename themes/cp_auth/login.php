<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
    <?= lang('Auth.loginTitle') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('login'), [
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('Auth.emailOrUsername'), 'login') ?>
<?= form_input([
    'id' => 'login',
    'name' => 'login',
    'class' => 'form-input mb-4',
    'required' => 'required',
]) ?>

<?= form_label(lang('Auth.password'), 'password') ?>
<?= form_input([
    'id' => 'password',
    'name' => 'password',
    'class' => 'form-input mb-4',
    'type' => 'password',
    'required' => 'required',
]) ?>


<?= button(
    lang('Auth.loginAction'),
    '',
    [
        'variant' => 'primary',
    ],
    [
        'type' => 'submit',
        'class' => 'self-end',
    ],
) ?>

<?= form_close() ?>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<div class="flex flex-col items-center py-4 text-sm text-center">
    <?php if ($config->allowRegistration): ?>
        <a class="underline hover:no-underline" href="<?= route_to(
    'register',
) ?>"><?= lang('Auth.needAnAccount') ?></a>
    <?php endif; ?>
    <a class="underline hover:no-underline" href="<?= route_to(
    'forgot',
) ?>"><?= lang('Auth.forgotYourPassword') ?></a>
</div>

<?= $this->endSection() ?>
