<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.email2FATitle') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container p-5 d-flex justify-content-center">
    <div class="shadow-sm card col-12 col-md-5">
        <div class="card-body">
            <h5 class="mb-5 card-title"><?= lang('Auth.email2FATitle') ?></h5>

            <p><?= lang('Auth.confirmEmailAddress') ?></p>

            <?php if (session('error')) : ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif ?>

            <form action="<?= url_to('auth-action-handle') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="mb-2">
                    <input type="email" class="form-control" name="email"
                        inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>"
                        <?php /** @var \CodeIgniter\Shield\Entities\User $user */ ?>
                        value="<?= old('email', $user->email) ?>" required />
                </div>

                <div class="m-3 mx-auto d-grid col-8">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.send') ?></button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
