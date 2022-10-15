<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.email2FATitle') ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container p-5 d-flex justify-content-center">
    <div class="shadow-sm card col-12 col-md-5">
        <div class="card-body">
            <h5 class="mb-5 card-title"><?= lang('Auth.emailEnterCode') ?></h5>

            <p><?= lang('Auth.emailConfirmCode') ?></p>

            <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif ?>

            <form action="<?= url_to('auth-action-verify') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Code -->
                <div class="mb-2">
                    <input type="number" class="form-control" name="token" placeholder="000000"
                        inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" required />
                </div>

                <div class="m-3 mx-auto d-grid col-8">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.confirm') ?></button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
