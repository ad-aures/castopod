<footer class="px-6 py-3">
    <form action="<?= route_to(
        'status-attempt-action',
        interact_as_actor()->username,
        $status->id,
    ) ?>" method="POST" class="flex justify-around">
        <?= csrf_field() ?>
        <?= anchor(
            route_to('status', $podcast->handle, $status->id),
            icon('chat', 'text-2xl mr-1 text-gray-400') . $status->replies_count,
            [
                'class' => 'inline-flex items-center hover:underline',
                'title' => lang('Status.replies', [
                    'numberOfReplies' => $status->replies_count,
                ]),
            ],
        ) ?>
        <button type="submit" name="action" value="reblog" class="inline-flex items-center hover:underline" title="<?= lang(
            'Status.reblogs',
            [
                'numberOfReblogs' => $status->reblogs_count,
            ],
        ) ?>"><?= icon('repeat', 'text-2xl mr-1 text-gray-400') .
    $status->reblogs_count ?></button>
        <button type="submit" name="action" value="favourite" class="inline-flex items-center hover:underline" title="<?= lang(
            'Status.favourites',
            [
                'numberOfFavourites' => $status->favourites_count,
            ],
        ) ?>"><?= icon('heart', 'text-2xl mr-1 text-gray-400') .
    $status->favourites_count ?></button>
        <button id="<?= $status->id .
            '-more-dropdown' ?>" type="button" class="px-2 py-1 text-2xl text-gray-500 outline-none focus:ring" data-dropdown="button" data-dropdown-target="<?= $status->id .
    '-more-dropdown-menu' ?>" aria-label="<?= lang(
    'Common.more',
) ?>" aria-haspopup="true" aria-expanded="false"><?= icon('more') ?>
        </button>
    </form>
    <nav id="<?= $status->id .
        '-more-dropdown-menu' ?>" class="flex flex-col py-2 text-sm bg-white border rounded-lg shadow" aria-labelledby="<?= $status->id .
    '-more-dropdown' ?>" data-dropdown="menu" data-dropdown-placement="bottom">
        <?= anchor(
            route_to('status', $podcast->handle, $status->id),
            lang('Status.expand'),
            [
                'class' => 'px-4 py-1 hover:bg-gray-100',
            ],
        ) ?>
        <form action="<?= route_to(
            'status-attempt-block-actor',
            interact_as_actor()->username,
            $status->id,
        ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
                'Status.block_actor',
                [
                    'actorUsername' => $status->actor->username,
                ],
            ) ?></button>
        </form>
        <form action="<?= route_to(
            'status-attempt-block-domain',
            interact_as_actor()->username,
            $status->id,
        ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
                'Status.block_domain',
                [
                    'actorDomain' => $status->actor->domain,
                ],
            ) ?></button>
        </form>
        <?php if ($status->actor->is_local): ?>
            <hr class="my-2" />
            <form action="<?= route_to(
                'status-attempt-delete',
                $status->actor->username,
                $status->id,
            ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 font-semibold text-left text-red-600 hover:bg-gray-100"><?= lang(
                    'Status.delete',
                ) ?></button>
            </form>
        <?php endif; ?>
    </nav>
</footer>
