<header class="sticky top-0 z-[60] flex items-center h-10 text-white border-b col-span-full bg-navigation border-navigation">
    <button type="button"
        data-sidebar-toggler="toggler"
        class="h-full pr-1 text-xl md:hidden focus:ring-accent focus:ring-inset" aria-label="<?= lang('Navigation.toggle_sidebar') ?>"><?= icon('menu') ?></button>
    <div class="inline-flex items-center h-full">
        <a href="<?= route_to(
    'admin',
) ?>" class="inline-flex items-center h-full px-2 border-r border-navigation focus:ring-inset focus:ring-accent">
            <?= (isset($podcast) ? icon('arrow-left', 'mr-2') : '') . svg('castopod-logo-base', 'h-6') ?>
        </a>
        <a href="<?= route_to(
    'home',
) ?>" class="inline-flex items-center h-full px-6 text-sm font-semibold hover:underline focus:ring-inset focus:ring-accent">
                <?= lang('Navigation.go_to_website') ?>
                <?= icon('external-link', 'ml-1 opacity-60') ?>
        </a>
    </div>
    <button
        type="button"
        class="inline-flex items-center h-full px-3 ml-auto text-sm font-semibold focus:ring-inset focus:ring-accent gap-x-2"
        id="my-account-dropdown"
        data-dropdown="button"
        data-dropdown-target="my-account-dropdown-menu"
        aria-haspopup="true"
        aria-expanded="false"><div class="relative mr-1">
            <?= icon('account-circle', 'text-3xl opacity-60') ?>
            <?= user()
                ->podcasts === [] ? '' : '<img src="' . interact_as_actor()->avatar_image_url . '" class="absolute bottom-0 w-4 h-4 border rounded-full -right-1 border-navigation-bg" />' ?>
        </div>
        <?= user()->username ?>
        <?= icon('caret-down', 'ml-auto text-2xl') ?></button>
    <?php
        $interactButtons = '';
        foreach (user()->podcasts as $userPodcast) {
            $checkMark = interact_as_actor_id() === $userPodcast->actor_id ? icon('check', 'ml-2 bg-accent-base text-accent-contrast rounded-full') : '';

            $interactButtons .= <<<CODE_SAMPLE
                <button class="inline-flex items-center w-full px-4 py-1 hover:bg-highlight" id="interact-as-actor-{$userPodcast->id}" name="actor_id" value="{$userPodcast->actor_id}">
                    <div class="inline-flex items-center flex-1 text-sm"><img src="{$userPodcast->cover->tiny_url}" class="w-6 h-6 mr-2 rounded-full" /><span class="truncate">{$userPodcast->title}</span>{$checkMark}</div>
                </button>
            CODE_SAMPLE;
        }

        $interactAsText = lang('Admin.choose_interact');
        $route = route_to('interact-as-actor');
        $csrfField = csrf_field();

        $menuItems = [
            [
                'type' => 'link',
                'title' => lang('Navigation.account.my-account'),
                'uri' => route_to('my-account'),
            ],
            [
                'type' => 'link',
                'title' => lang('Navigation.account.change-password'),
                'uri' => route_to('change-password'),
            ],
            [
                'type' => 'separator',
            ],
            [
                'type' => 'link',
                'title' => lang('Navigation.account.logout'),
                'uri' => route_to('logout'),
            ],
        ];

        if (user()->podcasts !== []) {
            $menuItems = array_merge([
                [
                    'type' => 'html',
                    'content' => esc(<<<CODE_SAMPLE
                        <nav class="flex flex-col py-2 whitespace-no-wrap">
                            <span class="px-4 mb-2 text-xs font-semibold tracking-wider uppercase text-skin-muted">{$interactAsText}</span>
                            <form action="{$route}" method="POST" class="flex flex-col">
                                {$csrfField}
                                {$interactButtons}
                            </form>
                        </nav>
                    CODE_SAMPLE),
                ],
                [
                    'type' => 'separator',
                ],
            ], $menuItems);
        }
    ?>
    <DropdownMenu id="my-account-dropdown-menu" labelledby="my-account-dropdown" items="<?= esc(json_encode($menuItems)) ?>" />
</header>