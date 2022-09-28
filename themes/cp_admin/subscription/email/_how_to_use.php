<h3><?= lang('Subscription.emails.how_to_use', [], $subscription->podcast->language_code) ?></h3>
<p><?= lang('Subscription.emails.two_ways', [], $subscription->podcast->language_code) ?></p>
<ol>
    <li><?= lang('Subscription.emails.import_into_app', [], $subscription->podcast->language_code) ?></li>
    <li><?= lang('Subscription.emails.go_to_website', [
        'podcastWebsite' => '<a href="' . url_to('podcast-episodes', esc($subscription->podcast->handle)) . '">' . $subscription->podcast->title . '</a>',
    ], $subscription->podcast->language_code, false) ?></li>
</ol>
