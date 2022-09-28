<?= lang('Subscription.emails.greeting', [], $subscription->podcast->language_code) ?><br/><br/>

<?= lang('Subscription.emails.reset_token', [
    'podcastTitle' => '<strong>' . $subscription->podcast->title . '</strong>',
], $subscription->podcast->language_code, false) ?><br/><br/>

<?= lang('Subscription.emails.reset_token_title', [], $subscription->podcast->language_code) ?>

<?= $this->include('subscription/email/_credentials_list') ?>

<?= $this->include('subscription/email/_how_to_use') ?>

<?= $this->include('subscription/email/_footer') ?>
