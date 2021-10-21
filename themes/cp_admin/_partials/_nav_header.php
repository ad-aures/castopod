<header class="sticky top-0 z-50 flex items-center justify-between h-10 text-white border-b col-span-full bg-pine-800 border-pine-900">
    <div class="inline-flex items-center h-full">
        <a href="<?= route_to(
    'admin',
) ?>" class="inline-flex items-center h-full px-2 border-r border-pine-900 focus:ring-inset focus:ring-castopod">
            <?= (isset($podcast) ? icon('arrow-left', 'mr-2') : '') . svg('castopod-logo-base', 'h-6') ?>
        </a>
        <a href="<?= route_to(
    'home',
) ?>" class="inline-flex items-center h-full px-6 text-sm font-semibold hover:underline focus:ring-inset focus:ring-castopod">
                <?= lang('AdminNavigation.go_to_website') ?>
                <?= icon('external-link', 'ml-1 opacity-60') ?>
        </a>
    </div>
    <button
        type="button"
        class="inline-flex items-center h-full px-3 text-sm font-semibold focus:ring-inset focus:ring-castopod gap-x-2"
        id="my-account-dropdown"
        data-dropdown="button"
        data-dropdown-target="my-account-dropdown-menu"
        aria-haspopup="true"
        aria-expanded="false"><div class="relative mr-1">
            <?= icon('account-circle', 'text-3xl opacity-60') ?>
            <?= user()
                ->podcasts === [] ? '' : '<img src="' . interact_as_actor()->avatar_image_url . '" class="absolute bottom-0 w-4 h-4 border rounded-full -right-1 border-pine-800" />' ?>
        </div>
        <?= user()->username ?>
        <?= icon('caret-down', 'ml-auto text-2xl') ?></button>
    <?php
        $interactButtons = '';
        foreach (user()->podcasts as $userPodcast) {
            $checkMark = interact_as_actor_id() === $userPodcast->actor_id ? icon('check', 'ml-2 bg-pine-800 text-white rounded-full') : '';

            $interactButtons .= <<<CODE_SAMPLE
                <button class="inline-flex items-center w-full px-4 py-1 hover:bg-gray-100" id="interact-as-actor-{$userPodcast->id}" name="actor_id" value="{$userPodcast->actor_id}">
                    <span class="inline-flex items-center flex-1 text-sm"><img src="{$userPodcast->image->thumbnail_url}" class="w-6 h-6 mr-2 rounded-full" />{$userPodcast->title}{$checkMark}</span>
                </button>
            CODE_SAMPLE;
        }

        $interactAsText = lang('Admin.choose_interact');
        $route = route_to('interact-as-actor');
        $csrfField = csrf_field();

        $menuItems = [
            [
                'type' => 'link',
                'title' => lang('AdminNavigation.account.my-account'),
                'uri' => route_to('my-account'),
            ],
            [
                'type' => 'link',
                'title' => lang('AdminNavigation.account.change-password'),
                'uri' => route_to('change-password'),
            ],
            [
                'type' => 'separator',
            ],
            [
                'type' => 'link',
                'title' => lang('AdminNavigation.account.logout'),
                'uri' => route_to('logout'),
            ],
        ];

        if (user()->podcasts !== []) {
            $menuItems = array_merge([
                [
                    'type' => 'html',
                    'content' => esc(<<<CODE_SAMPLE
                        <nav class="flex flex-col py-2 text-black whitespace-no-wrap">
                            <span class="px-4 mb-2 text-xs font-semibold tracking-wider text-gray-500 uppercase">{$interactAsText}</span>
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