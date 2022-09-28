<ul>
    <li><?= lang('Subscription.emails.token', ['<strong>' . $token . '</strong>'], $subscription->podcast->language_code, false) ?> </li>
    <li><?= lang('Subscription.emails.unique_feed_link', ['<a href="' . $subscription->podcast->feedUrl . '?token=' . $token . '">' . $subscription->podcast->feedUrl . '?token=' . $token . '</a>'], $subscription->podcast->language_code, false) ?> </li>
</ul>
