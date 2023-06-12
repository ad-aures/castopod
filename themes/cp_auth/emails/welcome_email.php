<p>
    <?= lang('Auth.emailWelcomeMailBody', [
    'domain'            => current_domain(),
        'numberOfHours' => setting('Auth.welcomeLinkLifetime') / 3600,
]) ?><br /><br />

    <a href="<?= url_to('verify-magic-link') ?>?token=<?= $token ?>">
        <?= lang('Auth.login') ?>
    </a>
</p>
