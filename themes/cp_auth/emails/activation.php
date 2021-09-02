<p>This is activation email for your account on <?= base_url() ?>.</p>

<p>To activate your account use this URL.</p>

<p><a href="<?= base_url('activate-account') .
    '?token=' .
    $hash ?>">Activate account</a>.</p>

<br>

<p>If you did not registered on this website, you can safely ignore this email.</p>
