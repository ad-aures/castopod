<footer class="flex justify-around px-6 py-3">
    <?php if (can_user_interact()): ?>
        <form action="<?= route_to('post-attempt-action', esc(interact_as_actor()->username), $post->id) ?>" method="POST" class="flex justify-around w-full">
            <?= csrf_field() ?>
            <?= anchor(
    route_to('post', esc($podcast->handle), $post->id),
    icon('chat', 'text-2xl mr-1 opacity-40') . $post->replies_count,
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
) ?>"><?= icon('repeat', 'text-2xl mr-1 opacity-40') .
        $post->reblogs_count ?></button>
            <button type="submit" name="action" value="favourite" class="inline-flex items-center hover:underline" title="<?= lang(
            'Post.favourites',
            [
                'numberOfFavourites' => $post->favourites_count,
            ],
        ) ?>"><?= icon('heart', 'text-2xl mr-1 opacity-40') .
        $post->favourites_count ?></button>
            <button id="<?= $post->id .
                '-more-dropdown' ?>" type="button" class="px-2 py-1 text-2xl text-skin-muted focus:ring-accent" data-dropdown="button" data-dropdown-target="<?= $post->id .
        '-more-dropdown-menu' ?>" aria-label="<?= lang(
            'Common.more',
        ) ?>" aria-haspopup="true" aria-expanded="false"><?= icon('more') ?>
            </button>
        </form>
        <nav id="<?= $post->id .
            '-more-dropdown-menu' ?>" class="flex flex-col py-2 text-sm rounded-lg shadow border-3 border-subtle bg-elevated" aria-labelledby="<?= $post->id .
        '-more-dropdown' ?>" data-dropdown="menu" data-dropdown-placement="bottom">
            <?= anchor(
            route_to('post', esc($podcast->handle), $post->id),
            lang('Post.expand'),
            [
                'class' => 'px-4 py-1 hover:bg-highlight',
            ],
        ) ?>
            <form action="<?= route_to(
            'post-attempt-block-actor',
            esc(interact_as_actor()
                ->username),
            $post->id,
        ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 text-left hover:bg-highlight"><?= lang(
            'Post.block_actor',
            [
                'actorUsername' => esc($post->actor->username),
            ],
        ) ?></button>
            </form>
            <form action="<?= route_to(
            'post-attempt-block-domain',
            esc(interact_as_actor()
                ->username),
            $post->id,
        ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 text-left hover:bg-highlight"><?= lang(
            'Post.block_domain',
            [
                'actorDomain' => esc($post->actor->domain),
            ],
        ) ?></button>
            </form>
            <?php if ($post->actor->is_local): ?>
                <hr class="my-2 border-subtle" />
                <form action="<?= route_to(
            'post-attempt-delete',
            esc($post->actor->username),
            $post->id,
        ) ?>" method="POST">
                    <?= csrf_field() ?>
                    <button class="w-full px-4 py-1 font-semibold text-left text-red-600 hover:bg-highlight"><?= lang(
            'Post.delete',
        ) ?></button>
                </form>
            <?php endif; ?>
        </nav>
    <?php else: ?>
    <?= anchor(
            route_to('post', esc($podcast->handle), $post->id),
            icon('chat', 'text-2xl mr-1 opacity-40') . $post->replies_count,
            [
                'class' => 'inline-flex items-center hover:underline',
                'title' => lang('Post.replies', [
                    'numberOfReplies' => $post->replies_count,
                ]),
            ],
        ) ?>
    <?= anchor_popup(
            route_to('post-remote-action', esc($podcast->handle), $post->id, 'reblog'),
            icon('repeat', 'text-2xl mr-1 opacity-40') . $post->reblogs_count,
            [
                'class' => 'inline-flex items-center hover:underline',
                'width' => 420,
                'height' => 620,
                'title' => lang('Post.reblogs', [
                    'numberOfReblogs' => $post->reblogs_count,
                ]),
            ],
        ) ?>
    <?= anchor_popup(
            route_to('post-remote-action', esc($podcast->handle), $post->id, 'favourite'),
            icon('heart', 'text-2xl mr-1 opacity-40') . $post->favourites_count,
            [
                'class' => 'inline-flex items-center hover:underline',
                'width' => 420,
                'height' => 620,
                'title' => lang('Post.favourites', [
                    'numberOfFavourites' => $post->favourites_count,
                ]),
            ],
        ) ?>
    <?php endif; ?>
</footer>
