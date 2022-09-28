<?= lang('Subscription.emails.greeting', [], $subscription->podcast->language_code) ?><br/><br/>

<?php if ($subscription->expires_at): ?>
    <?php
        $formatter = new IntlDateFormatter($subscription->podcast->language_code, IntlDateFormatter::LONG, IntlDateFormatter::LONG);
        $translatedDate = $subscription->expires_at->toLocalizedString($formatter->getPattern());
    ?>
    <?= lang('Subscription.emails.edited_expires', [
        'podcastTitle' => '<strong>' . $subscription->podcast->title . '</strong>',
        'expiresAt' => '<strong>' . $translatedDate . '</strong>',
    ], $subscription->podcast->language_code, false) ?>
<?php else: ?>
    <?= lang('Subscription.emails.edited_never_expires', [
        'podcastTitle' => '<strong>' . $subscription->podcast->title . '</strong>',
    ], $subscription->podcast->language_code, false) ?>
<?php endif; ?>

<?= $this->include('subscription/email/_footer') ?>
