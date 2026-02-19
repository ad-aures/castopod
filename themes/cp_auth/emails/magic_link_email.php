<p>
    <?= lang('Auth.login') ?><br />
    <a href="<?= url_to('verify-magic-link') ?>?token=<?= $token ?>">
        <?= url_to('verify-magic-link') ?>?token=<?= $token ?>
    </a>
</p>
