<p>
    <?= lang('Auth.emailWelcomeMailBody', [
    'domain'            => current_domain(),
        'numberOfHours' => setting('Auth.welcomeLinkLifetime') / 3600,
]) ?><br /><br />

    <?= lang('Auth.login') ?><br />
    <a href="<?= url_to('verify-magic-link') ?>?token=<?= $token ?>">
        <?= url_to('verify-magic-link') ?>?token=<?= $token ?>
    </a>
</p>
