<footer class="px-6 py-3">
    <form action="<?= route_to(
        'note-attempt-action',
        interact_as_actor()->username,
        $note->id,
    ) ?>" method="POST" class="flex justify-around">
        <?= csrf_field() ?>
        <?= anchor(
            route_to('note', $podcast->name, $note->id),
            icon('chat', 'text-2xl mr-1 text-gray-400') . $note->replies_count,
            [
                'class' => 'inline-flex items-center hover:underline',
                'title' => lang('Note.replies', [
                    'numberOfReplies' => $note->replies_count,
                ]),
            ],
        ) ?>
        <button type="submit" name="action" value="reblog" class="inline-flex items-center hover:underline" title="<?= lang(
            'Note.reblogs',
            [
                'numberOfReblogs' => $note->reblogs_count,
            ],
        ) ?>"><?= icon('repeat', 'text-2xl mr-1 text-gray-400') .
    $note->reblogs_count ?></button>
        <button type="submit" name="action" value="favourite" class="inline-flex items-center hover:underline" title="<?= lang(
            'Note.favourites',
            [
                'numberOfFavourites' => $note->favourites_count,
            ],
        ) ?>"><?= icon('heart', 'text-2xl mr-1 text-gray-400') .
    $note->favourites_count ?></button>
        <button id="<?= $note->id .
            '-more-dropdown' ?>" type="button" class="px-2 py-1 text-2xl text-gray-500 outline-none focus:ring" data-dropdown="button" data-dropdown-target="<?= $note->id .
    '-more-dropdown-menu' ?>" aria-label="<?= lang(
    'Common.more',
) ?>" aria-haspopup="true" aria-expanded="false"><?= icon('more') ?>
        </button>
    </form>
    <nav id="<?= $note->id .
        '-more-dropdown-menu' ?>" class="flex flex-col py-2 text-sm bg-white border rounded-lg shadow" aria-labelledby="<?= $note->id .
    '-more-dropdown' ?>" data-dropdown="menu" data-dropdown-placement="bottom">
        <?= anchor(
            route_to('note', $podcast->name, $note->id),
            lang('Note.expand'),
            [
                'class' => 'px-4 py-1 hover:bg-gray-100',
            ],
        ) ?>
        <form action="<?= route_to(
            'note-attempt-block-actor',
            interact_as_actor()->username,
            $note->id,
        ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
                'Note.block_actor',
                [
                    'actorUsername' => $note->actor->username,
                ],
            ) ?></button>
        </form>
        <form action="<?= route_to(
            'note-attempt-block-domain',
            interact_as_actor()->username,
            $note->id,
        ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
                'Note.block_domain',
                [
                    'actorDomain' => $note->actor->domain,
                ],
            ) ?></button>
        </form>
        <?php if ($note->actor->is_local): ?>
            <hr class="my-2" />
            <form action="<?= route_to(
                'note-attempt-delete',
                $note->actor->username,
                $note->id,
            ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 font-semibold text-left text-red-600 hover:bg-gray-100"><?= lang(
                    'Note.delete',
                ) ?></button>
            </form>
        <?php endif; ?>
    </nav>
</footer>
