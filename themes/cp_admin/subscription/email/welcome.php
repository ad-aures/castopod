<?= lang('Subscription.emails.greeting', [], $subscription->podcast->language_code) ?><br/><br/>

<?= lang('Subscription.emails.welcome', [
    'podcastTitle' => '<strong>' . $subscription->podcast->title . '</strong>',
], $subscription->podcast->language_code, false) ?><br/><br/>

<?= lang('Subscription.emails.welcome_token_title', [], $subscription->podcast->language_code) ?>

<?= $this->include('subscription/email/_credentials_list') ?>

<?php if ($subscription->expires_at): ?>
    <?php
        $formatter = new IntlDateFormatter($subscription->podcast->language_code, IntlDateFormatter::LONG, IntlDateFormatter::LONG);
    $translatedDate = $subscription->expires_at->toLocalizedString($formatter->getPattern());
    ?>
    <?= lang('Subscription.emails.welcome_expires', ['<strong>' . $translatedDate . '</strong>'], $subscription->podcast->language_code, false) ?>
<?php else: ?>
    <?= lang('Subscription.emails.welcome_never_expires', [], $subscription->podcast->language_code) ?>
<?php endif; ?>

<?= $this->include('subscription/email/_how_to_use') ?>

<?= $this->include('subscription/email/_footer') ?>
