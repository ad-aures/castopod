<div class="sticky top-0 left-0 z-50 flex items-center justify-between w-full h-12 px-4 text-white border-b shadow bg-pine-800 border-pine-900">
        <?= anchor(
    route_to('admin'),
    'castopod' . svg('castopod-logo-base', 'h-5 ml-1'),
    [
        'class' =>
            'text-2xl inline-flex items-baseline font-bold font-display',
    ],
) ?>
        <?php if (user()->podcasts !== []): ?>
            <button type="button" class="inline-flex items-center px-6 py-2 mt-auto font-semibold outline-none focus:ring" id="interact-as-dropdown" data-dropdown="button" data-dropdown-target="interact-as-dropdown-menu" aria-haspopup="true" aria-expanded="false">
                <img src="<?= interact_as_actor()
            ->avatar_image_url ?>" class="w-8 h-8 mr-2 rounded-full" />
                <?= '@' . interact_as_actor()->username ?>
                <?= icon('caret-down', 'ml-auto') ?>
            </button>
            <nav id="interact-as-dropdown-menu" class="absolute z-50 flex flex-col py-2 text-black whitespace-no-wrap bg-white border rounded shadow" aria-labelledby="my-accountDropdown" data-dropdown="menu" data-dropdown-placement="bottom-end">
                <span class="px-4 text-xs tracking-wider text-gray-700 uppercase"><?= lang(
                'Admin.choose_interact',
            ) ?></span>
                <form action="<?= route_to(
                'interact-as-actor',
            ) ?>" method="POST" class="flex flex-col">
                    <?= csrf_field() ?>
                    <?php foreach (user()->podcasts as $userPodcast): ?>
                        <button class="inline-flex items-center w-full px-4 py-1 hover:bg-gray-100" id="<?= "interact-as-actor-{$userPodcast->id}" ?>" name="actor_id" value="<?= $userPodcast->actor_id ?>">
                            <span class="inline-flex items-center flex-1">
                                <img src="<?= $userPodcast->image
                        ->thumbnail_url ?>" class="w-8 h-8 mr-2 rounded-full" /><?= $userPodcast->title ?>
                                <?php if (
                                    interact_as_actor()
                                        ->id ===
                                    $userPodcast->actor_id
                                ): ?>
                            </span>
                            <?= icon(
                                    'check',
                                    'ml-4 bg-pine-800 text-white rounded-full',
                                ) ?>
                        <?php endif; ?>
                        </button>
                    <?php endforeach; ?>
                </form>
            </nav>
        <?php endif; ?>
    </div>