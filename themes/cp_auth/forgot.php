<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.forgotPassword') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<p class="mb-4 text-gray-600"><?= lang('Auth.enterEmailForInstructions') ?></p>

<?= form_open(route_to('forgot'), [
    'class' => 'flex flex-col',
]) ?>
<?= csrf_field() ?>

<?= form_label(lang('Auth.emailAddress'), 'email') ?>
<?= form_input([
    'id' => 'email',
    'name' => 'email',
    'class' => 'form-input mb-4',
    'type' => 'email',
    'required' => 'required',
]) ?>

<?= button(
    lang('Auth.sendInstructions'),
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
