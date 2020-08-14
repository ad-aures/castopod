<?= helper('form') ?>
<?= $this->extend($config->viewLayout) ?>

<?= $this->section('title') ?>
	<?= lang('Auth.register') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('register'), ['class' => 'flex flex-col']) ?>
<?= csrf_field() ?>

<?= form_label(lang('Auth.email'), 'email') ?>
<?= form_input([
    'id' => 'email',
    'name' => 'email',
    'class' => 'form-input',
    'value' => old('email'),
    'type' => 'email',
    'required' => 'required',
    'aria-describedby' => 'emailHelp',
]) ?>
<small id="emailHelp" class="mb-4 text-gray-700">
    <?= lang('Auth.weNeverShare') ?>
</small>

<?= form_label(lang('Auth.username'), 'username') ?>
<?= form_input([
    'id' => 'username',
    'name' => 'username',
    'class' => 'form-input mb-4',
    'value' => old('username'),
    'required' => 'required',
]) ?>

<?= form_label(lang('Auth.password'), 'password') ?>
<?= form_input([
    'id' => 'password',
    'name' => 'password',
    'class' => 'form-input mb-4',
    'type' => 'password',
    'required' => 'required',
    'autocomplete' => 'new-password',
]) ?>

<?= form_button([
    'content' => lang('Auth.register'),
    'class' => 'px-4 py-2 ml-auto border',
    'type' => 'submit',
]) ?>

<?= form_close() ?>

<?= $this->endSection() ?>


<?= $this->section('footer') ?>

<p class="py-4 text-sm text-center">
    <?= lang(
        'Auth.alreadyRegistered'
    ) ?> <a class="underline hover:no-underline" href="<?= route_to(
     'login'
 ) ?>"><?= lang('Auth.signIn') ?></a>
</p>

<?= $this->endSection() ?>
