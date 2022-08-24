<p>Someone requested a password reset at this email address for <?= base_url() ?>.</p>

<p>To reset the password use this code or URL and follow the instructions.</p>

<p>Your Code: <?= $hash ?></p>

<p>Visit the <a href="<?= url_to('reset-password') .
    '?token=' .
    $hash ?>">Reset Form</a>.</p>

<br>

<p>If you did not request a password reset, you can safely ignore this email.</p>
