<?= lang('Subscription.emails.greeting', [], $subscription->podcast->language_code) ?><br/><br/>

<?= lang('Subscription.emails.suspended', [
    'podcastTitle' => '<strong>' . $subscription->podcast->title . '</strong>',
], $subscription->podcast->language_code, false) ?><br/><br/>

<?php if ($subscription->status_message): ?>
    <?= lang('Subscription.emails.suspended_reason', ['<br /><br /><code>' . nl2br($subscription->status_message) . '</code>'], $subscription->podcast->language_code, false) ?>
<?php endif; ?>

<?= $this->include('subscription/email/_footer') ?>
