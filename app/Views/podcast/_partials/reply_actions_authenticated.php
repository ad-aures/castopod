<footer class="mt-2 text-sm">
    <form action="<?= route_to(
        'note-attempt-action',
        interact_as_actor()->username,
        $reply->id,
    ) ?>" method="POST" class="flex items-start">
        <?= csrf_field() ?>
        <?= anchor(
            route_to('note', $podcast->name, $reply->id),
            icon('chat', 'text-xl mr-1 text-gray-400') . $reply->replies_count,
            [
                'class' => 'inline-flex items-center mr-6 hover:underline',
                'title' => lang('Note.replies', [
                    'numberOfReplies' => $reply->replies_count,
                ]),
            ],
        ) ?>
        <button type="submit" name="action" value="reblog" class="inline-flex items-center mr-6 hover:underline" title="<?= lang(
            'Note.reblogs',
            [
                'numberOfReblogs' => $reply->reblogs_count,
            ],
        ) ?>"><?= icon('repeat', 'text-xl mr-1 text-gray-400') .
    $reply->reblogs_count ?></button>
        <button type="submit" name="action" value="favourite" class="inline-flex items-center mr-6 hover:underline" title="<?= lang(
            'Note.favourites',
            [
                'numberOfFavourites' => $reply->favourites_count,
            ],
        ) ?>"><?= icon('heart', 'text-xl mr-1 text-gray-400') .
    $reply->favourites_count ?></button>
        <button id="<?= $reply->id .
            '-more-dropdown' ?>" type="button" class="text-xl text-gray-500 outline-none focus:ring" data-dropdown="button" data-dropdown-target="<?= $reply->id .
    '-more-dropdown-menu' ?>" aria-label="<?= lang(
    'Common.more',
) ?>" aria-haspopup="true" aria-expanded="false"><?= icon('more') ?>
        </button>
    </form>
    <nav id="<?= $reply->id .
        '-more-dropdown-menu' ?>" class="flex flex-col py-2 text-sm bg-white border rounded-lg shadow" aria-labelledby="<?= $reply->id .
    '-more-dropdown' ?>" data-dropdown="menu" data-dropdown-placement="bottom">
        <?= anchor(
            route_to('note', $podcast->name, $reply->id),
            lang('Note.expand'),
            [
                'class' => 'px-4 py-1 hover:bg-gray-100',
            ],
        ) ?>
        <form action="<?= route_to(
            'note-attempt-block-actor',
            interact_as_actor()->username,
            $reply->id,
        ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
                'Note.block_actor',
                [
                    'actorUsername' => $reply->actor->username,
                ],
            ) ?></button>
        </form>
        <form action="<?= route_to(
            'note-attempt-block-domain',
            interact_as_actor()->username,
            $reply->id,
        ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
                'Note.block_domain',
                [
                    'actorDomain' => $reply->actor->domain,
                ],
            ) ?></button>
        </form>
        <?php if ($reply->actor->is_local): ?>
            <hr class="my-2" />
            <form action="<?= route_to(
                'note-attempt-delete',
                $reply->actor->username,
                $reply->id,
            ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 font-semibold text-left text-red-600 hover:bg-gray-100"><?= lang(
                    'Note.delete',
                ) ?></button>
            </form>
        <?php endif; ?>
    </nav>
</footer>
