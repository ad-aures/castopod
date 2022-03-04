<?php declare(strict_types=1);

if (can_user_interact()): ?>
    <footer>
        <form action="<?= route_to('post-attempt-action', esc(interact_as_actor()->username), $reply->id) ?>" method="POST" class="flex items-start gap-x-6">
            <?= csrf_field() ?>
            <?= anchor(
    route_to('post', esc($podcast->handle), $reply->id),
    icon('chat', 'text-lg mr-1 opacity-40') . $reply->replies_count,
    [
        'class' => 'inline-flex items-center hover:underline text-sm',
        'title' => lang('Post.replies', [
            'numberOfReplies' => $reply->replies_count,
        ]),
    ],
) ?>
            <button type="submit" name="action" value="reblog" class="inline-flex items-center text-sm hover:underline" title="<?= lang(
    'Post.reblogs',
    [
        'numberOfReblogs' => $reply->reblogs_count,
    ],
) ?>"><?= icon('repeat', 'text-lg mr-1 opacity-40') .
            $reply->reblogs_count ?></button>
                <button type="submit" name="action" value="favourite" class="inline-flex items-center text-sm hover:underline" title="<?= lang(
                'Post.favourites',
                [
                    'numberOfFavourites' => $reply->favourites_count,
                ],
            ) ?>"><?= icon('heart', 'text-lg mr-1 opacity-40') .
            $reply->favourites_count ?></button>
                <button id="<?= $reply->id .
                    '-more-dropdown' ?>" type="button" class="text-xl text-skin-muted focus:ring-accent" data-dropdown="button" data-dropdown-target="<?= $reply->id .
            '-more-dropdown-menu' ?>" aria-label="<?= lang(
                'Common.more',
            ) ?>" aria-haspopup="true" aria-expanded="false"><?= icon('more') ?>
                </button>
        </form>
        <nav id="<?= $reply->id .
            '-more-dropdown-menu' ?>" class="flex flex-col py-2 text-sm rounded-lg shadow border-3 border-subtle bg-elevated" aria-labelledby="<?= $reply->id .
        '-more-dropdown' ?>" data-dropdown="menu" data-dropdown-placement="bottom">
            <?= anchor(
            route_to('post', esc($podcast->handle), $reply->id),
            lang('Post.expand'),
            [
                'class' => 'px-4 py-1 hover:bg-highlight',
            ],
        ) ?>
            <form action="<?= route_to(
            'post-attempt-block-actor',
            esc(interact_as_actor()
                ->username),
            $reply->id,
        ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 text-left hover:bg-highlight"><?= lang(
            'Post.block_actor',
            [
                'actorUsername' => esc($reply->actor->username),
            ],
        ) ?></button>
            </form>
            <form action="<?= route_to(
            'post-attempt-block-domain',
            esc(interact_as_actor()
                ->username),
            $reply->id,
        ) ?>" method="POST">
                <?= csrf_field() ?>
                <button class="w-full px-4 py-1 text-left hover:bg-highlight"><?= lang(
            'Post.block_domain',
            [
                'actorDomain' => esc($reply->actor->domain),
            ],
        ) ?></button>
            </form>
            <?php if ($reply->actor->is_local): ?>
                <hr class="my-2 border-subtle" />
                <form action="<?= route_to(
            'post-attempt-delete',
            esc($reply->actor->username),
            $reply->id,
        ) ?>" method="POST">
                    <?= csrf_field() ?>
                    <button class="w-full px-4 py-1 font-semibold text-left text-red-600 hover:bg-highlight"><?= lang(
            'Post.delete',
        ) ?></button>
                </form>
            <?php endif; ?>
        </nav>
    </footer>
<?php else: ?>
    <footer class="flex gap-x-6">
        <?= anchor(
            route_to('post', esc($podcast->handle), $reply->id),
            icon('chat', 'text-lg mr-1 opacity-40') . $reply->replies_count,
            [
                'class' => 'inline-flex items-center hover:underline text-sm',
                'title' => lang('Post.replies', [
                    'numberOfReplies' => $reply->replies_count,
                ]),
            ],
        ) ?>
        <?= anchor_popup(
            route_to('post-remote-action', esc($podcast->handle), $reply->id, 'reblog'),
            icon('repeat', 'text-lg mr-1 opacity-40') . $reply->reblogs_count,
            [
                'class' => 'inline-flex items-center hover:underline text-sm',
                'width' => 420,
                'height' => 620,
                'title' => lang('Post.reblogs', [
                    'numberOfReblogs' => $reply->reblogs_count,
                ]),
            ],
        ) ?>
        <?= anchor_popup(
            route_to('post-remote-action', esc($podcast->handle), $reply->id, 'favourite'),
            icon('heart', 'text-lg mr-1 opacity-40') . $reply->favourites_count,
            [
                'class' => 'inline-flex items-center hover:underline text-sm',
                'width' => 420,
                'height' => 620,
                'title' => lang('Post.favourites', [
                    'numberOfFavourites' => $reply->favourites_count,
                ]),
            ],
        ) ?>
    </footer>
<?php endif; ?>
