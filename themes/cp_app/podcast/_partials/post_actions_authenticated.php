<footer class="px-6 py-3">
    <form action="<?= route_to(
    'post-attempt-action',
    interact_as_actor()
        ->username,
    $post->id,
) ?>" method="POST" class="flex justify-around">
        <?= csrf_field() ?>
        <?= anchor(
    route_to('post', $podcast->handle, $post->id),
    icon('chat', 'text-2xl mr-1 text-gray-400') . $post->replies_count,
    [
        'class' => 'inline-flex items-center hover:underline',
        'title' => lang('Post.replies', [
            'numberOfReplies' => $post->replies_count,
        ]),
    ],
) ?>
        <button type="submit" name="action" value="reblog" class="inline-flex items-center hover:underline" title="<?= lang(
    'Post.reblogs',
    [
        'numberOfReblogs' => $post->reblogs_count,
    ],
) ?>"><?= icon('repeat', 'text-2xl mr-1 text-gray-400') .
    $post->reblogs_count ?></button>
        <button type="submit" name="action" value="favourite" class="inline-flex items-center hover:underline" title="<?= lang(
        'Post.favourites',
        [
            'numberOfFavourites' => $post->favourites_count,
        ],
    ) ?>"><?= icon('heart', 'text-2xl mr-1 text-gray-400') .
    $post->favourites_count ?></button>
        <button id="<?= $post->id .
            '-more-dropdown' ?>" type="button" class="px-2 py-1 text-2xl text-gray-500 outline-none focus:ring" data-dropdown="button" data-dropdown-target="<?= $post->id .
    '-more-dropdown-menu' ?>" aria-label="<?= lang(
        'Common.more',
    ) ?>" aria-haspopup="true" aria-expanded="false"><?= icon('more') ?>
        </button>
    </form>
    <nav id="<?= $post->id .
        '-more-dropdown-menu' ?>" class="flex flex-col py-2 text-sm bg-white border rounded-lg shadow" aria-labelledby="<?= $post->id .
    '-more-dropdown' ?>" data-dropdown="menu" data-dropdown-placement="bottom">
        <?= anchor(
        route_to('post', $podcast->handle, $post->id),
        lang('Post.expand'),
        [
            'class' => 'px-4 py-1 hover:bg-gray-100',
        ],
    ) ?>
        <form action="<?= route_to(
        'post-attempt-block-actor',
        interact_as_actor()
            ->username,
        $post->id,
    ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
        'Post.block_actor',
        [
            'actorUsername' => $post->actor->username,
        ],
    ) ?></button>
        </form>
        <form action="<?= route_to(
        'post-attempt-block-domain',
        interact_as_actor()
            ->username,
        $post->id,
    ) ?>" method="POST">
            <?= csrf_field() ?>
            <button class="w-full px-4 py-1 text-left hover:bg-gray-100"><?= lang(
        'Post.block_domain',
        [
            'actorDomain' => $post->actor->domain,
        ],
    ) ?></button>
        </form>
        <?php if ($post->actor->is_local): ?>
            <hr class="my-2" />
            <form action="<?= route_to(
        'post-attempt-delete',
        $post->actor->username,
        $post->id,
    ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 font-semibold text-left text-red-600 hover:bg-gray-100"><?= lang(
        'Post.delete',
    ) ?></button>
            </form>
        <?php endif; ?>
    </nav>
</footer>
