<?= $this->extend('../cp_admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Subscription.podcast_subscriptions') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Subscription.podcast_subscriptions') ?>
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('subscription-create', $podcast->id) ?>" variant="primary" iconLeft="add"><?= lang('Subscription.add') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form method="POST" action="<?= route_to('subscription-link-save', $podcast->id) ?>" class="flex flex-col items-start max-w-sm gap-y-1">
    <?= csrf_field() ?>
    <Forms.Field
        class="w-full"
        type="url"
        name="subscription_link"
        label="<?= esc(lang('Subscription.form_link_add.link')) ?>"
        hint="<?= esc(lang('Subscription.form_link_add.link_hint')) ?>"
        placeholder="https://…"
        value="<?= service('settings')
        ->get('Subscription.link', 'podcast:' . $podcast->id) ?>" />
    <Button variant="primary" type="submit"><?= lang('Subscription.form_link_add.submit') ?></Button>
</form>

<hr class="my-6 border-subtle">

<?= data_table(
    [
        [
            'header' => lang('Subscription.list.number'),
            'cell'   => function ($subscription) {
                return '#' . $subscription->id;
            },
        ],
        [
            'header' => lang('Subscription.list.email'),
            'cell'   => function ($subscription) {
                return esc($subscription->email);
            },
        ],
        [
            'header' => lang('Subscription.list.expiration_date'),
            'cell'   => function ($subscription) {
                return $subscription->expires_at ? local_date($subscription->expires_at) : lang('Subscription.list.unlimited');
            },
        ],
        [
            'header' => lang('Subscription.list.downloads'),
            'cell'   => function ($subscription) {
                return $subscription->downloads_last_3_months;
            },
        ],
        [
            'header' => lang('Subscription.list.status'),
            'cell'   => function ($subscription) {
                $statusMapping = [
                    'active'    => 'success',
                    'suspended' => 'warning',
                    'expired'   => 'default',
                ];

                return '<Pill variant="' . $statusMapping[$subscription->status] . '" class="lowercase">' . lang('Subscription.status.' . $subscription->status) . '</Pill>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($subscription, $podcast) {
                $items = [
                    [
                        'type'  => 'link',
                        'title' => lang('Subscription.view'),
                        'uri'   => route_to('subscription-view', $podcast->id, $subscription->id),
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('Subscription.edit'),
                        'uri'   => route_to('subscription-edit', $podcast->id, $subscription->id),
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('Subscription.regenerate_token'),
                        'uri'   => route_to('subscription-regenerate-token', $podcast->id, $subscription->id),
                    ],
                    [
                        'type' => 'separator',
                    ],
                    [
                        'type'  => 'link',
                        'title' => lang('Subscription.delete'),
                        'uri'   => route_to('subscription-delete', $podcast->id, $subscription->id),
                        'class' => 'font-semibold text-red-600',
                    ],
                ];

                if ($subscription->status === 'suspended') {
                    $suspendAction = [[
                        'type'  => 'link',
                        'title' => lang('Subscription.resume'),
                        'uri'   => route_to('subscription-resume', $podcast->id, $subscription->id),
                    ]];
                } else {
                    $suspendAction = [[
                        'type'  => 'link',
                        'title' => lang('Subscription.suspend'),
                        'uri'   => route_to('subscription-suspend', $podcast->id, $subscription->id),
                    ]];
                }

                array_splice($items, 3, 0, $suspendAction);

                return '<button id="more-dropdown-' . $subscription->id . '" type="button" class="inline-flex items-center p-1 rounded-full focus:ring-accent" data-dropdown="button" data-dropdown-target="more-dropdown-' . $subscription->id . '-menu" aria-haspopup="true" aria-expanded="false">' .
                    icon('more') .
                    '</button>' .
                    '<DropdownMenu id="more-dropdown-' . $subscription->id . '-menu" labelledby="more-dropdown-' . $subscription->id . '" offsetY="-24" items="' . esc(json_encode($items)) . '" />';
            },
        ],
    ],
    $podcast->subscriptions,
    '',
    $podcast,
) ?>

<?= $this->endSection() ?>
