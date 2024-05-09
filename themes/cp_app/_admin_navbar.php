<?php declare(strict_types=1);

$userPodcasts = get_podcasts_user_can_interact_with(auth()->user()); ?>

<div class="sticky top-0 left-0 z-50 flex items-center justify-between w-full h-10 text-white border-b bg-navigation border-navigation">
        <div class="inline-flex items-center h-full">
            <a href="<?= route_to('home') ?>" class="inline-flex items-center h-full px-2 border-r border-navigation">
                    <?= svg('castopod-logo-base', 'h-6') ?>
            </a>
            <a href="<?= route_to('admin') ?>" class="inline-flex items-center h-full px-2 text-sm font-semibold sm:px-6 hover:underline" title="<?= lang('Navigation.go_to_admin') ?>">
                <span class="hidden sm:block"><?= lang('Navigation.go_to_admin') ?></span>
                <?= icon('external-link-fill', [
                    'class' => 'sm:ml-1 text-xl sm:text-base sm:opacity-60',
                ]) ?>
            </a>
        </div>

        <div class="inline-flex items-center h-full">
            <button type="button" class="relative h-full px-2" id="notifications-dropdown" data-dropdown="button" data-dropdown-target="notifications-dropdown-menu" aria-haspopup="true" aria-expanded="false" title="<?= lang('Notifications.title') ?>" data-tooltip="bottom">
                <?= icon('notification-2-fill', [
                    'class' => 'text-2xl opacity-80',
                ]) ?>
                <?php if (($actorIdsWithUnreadNotifications = get_actor_ids_with_unread_notifications(auth()->user())) !== []): ?>
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border border-navigation-bg"></span>
                <?php endif ?>
            </button>
            <?php
                $notificationsTitle = lang('Notifications.title');

$items = [
    [
        'type'    => 'html',
        'content' => esc(<<<HTML
                            <span class="px-4 my-2 text-xs font-semibold tracking-wider uppercase text-skin-muted">{$notificationsTitle}</span>
                            HTML),
    ],
];

if ($userPodcasts !== []) {
    foreach ($userPodcasts as $userPodcast) {
        $userPodcastTitle = esc($userPodcast->title);

        $unreadNotificationDotDisplayClass = in_array($userPodcast->actor_id, $actorIdsWithUnreadNotifications, true) ? '' : 'hidden';

        $items[] = [
            'type'  => 'link',
            'title' => <<<HTML
                                <div class="inline-flex items-center flex-1 text-sm align-middle">
                                    <div class="relative">
                                        <img src="{$userPodcast->cover->tiny_url}" class="w-6 h-6 mr-2 rounded-full" loading="lazy" />
                                        <span class="absolute top-0 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border border-background-elevated {$unreadNotificationDotDisplayClass}"></span>
                                    </div>
                                    <span class="max-w-xs truncate">{$userPodcastTitle}</span>
                                </div>
                            HTML
            ,
            'uri' => route_to('notification-list', $userPodcast->id),
        ];
    }
} else {
    $noNotificationsText = lang('Notifications.no_notifications');
    $items[] = [
        'type'    => 'html',
        'content' => esc(<<<HTML
                            <span class="mx-4 my-2 text-sm italic text-center text-skin-muted">{$noNotificationsText}</span>
                        HTML),
    ];
}
?>
            <x-DropdownMenu id="notifications-dropdown-menu" labelledby="notifications-dropdown" items="<?= esc(json_encode($items)) ?>" placement="bottom-end"/>

            <button
                type="button"
                class="inline-flex items-center h-full px-3 text-sm font-semibold gap-x-2"
                id="my-account-dropdown"
                data-dropdown="button"
                data-dropdown-target="my-account-dropdown-menu"
                aria-haspopup="true"
                aria-expanded="false">
                <div class="relative mr-1">
                    <?= icon('account-circle-fill', [
                        'class' => 'text-3xl opacity-60',
                    ]) ?>
                    <?php if (can_user_interact()): ?>
                        <?= auth()
                        ->user()
                        ->podcasts === [] ? '' : '<img src="' . interact_as_actor()->avatar_image_url . '" class="absolute bottom-0 w-4 h-4 border rounded-full -right-1 border-navigation-bg" loading="lazy" />' ?>
                    <?php endif; ?>
                </div>
                <?= esc(auth()->user()->username) ?>
                <?= icon('arrow-drop-down-fill', [
                    'class' => 'ml-auto text-2xl',
                ]) ?></button>
        <?php
$interactButtons = '';
foreach ($userPodcasts as $userPodcast) {
    if (can_podcast(auth()->user(), $userPodcast->id, 'interact-as')) {
        $checkMark = interact_as_actor_id() === $userPodcast->actor_id ? icon('check-fill', [
            'class' => 'ml-2 bg-accent-base text-accent-contrast rounded-full',
        ]) : '';
        $userPodcastTitle = esc($userPodcast->title);

        $interactButtons .= <<<HTML
                       <button class="inline-flex items-center w-full px-4 py-1 hover:bg-highlight" id="interact-as-actor-{$userPodcast->id}" name="actor_id" value="{$userPodcast->actor_id}">
                            <div class="inline-flex items-center flex-1 text-sm"><img src="{$userPodcast->cover->tiny_url}" class="w-6 h-6 mr-2 rounded-full" loading="lazy" /><span class="max-w-xs truncate">{$userPodcastTitle}</span>{$checkMark}</div>
                       </button>
                    HTML;
    }
}

$interactAsText = lang('Common.choose_interact');
$interactAsRoute = route_to('interact-as-actor');
$csrfField = csrf_field();

$menuItems = [
    [
        'type'  => 'link',
        'title' => lang('Navigation.account.my-account'),
        'uri'   => route_to('my-account'),
    ],
    [
        'type'  => 'link',
        'title' => lang('Navigation.account.change-password'),
        'uri'   => route_to('change-password'),
    ],
    [
        'type' => 'separator',
    ],
    [
        'type'  => 'link',
        'title' => lang('Navigation.account.logout'),
        'uri'   => route_to('logout'),
    ],
];

if ($userPodcasts !== []) {
    $menuItems = array_merge([
        [
            'type'    => 'html',
            'content' => esc(<<<HTML
                            <nav class="flex flex-col py-2 whitespace-nowrap">
                                <span class="px-4 mb-2 text-xs font-semibold tracking-wider uppercase text-skin-muted">{$interactAsText}</span>
                                <form action="{$interactAsRoute}" method="POST" class="flex flex-col">
                                    {$csrfField}
                                    {$interactButtons}
                                </form>
                            </nav>
                        HTML),
        ],
        [
            'type' => 'separator',
        ],
    ], $menuItems);
}
?>
        <x-DropdownMenu id="my-account-dropdown-menu" labelledby="my-account-dropdown" items="<?= esc(json_encode($menuItems)) ?>" />
    </div>
</div>