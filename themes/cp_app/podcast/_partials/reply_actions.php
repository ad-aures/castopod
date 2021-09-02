<footer class="mt-2 space-x-6 text-sm">
    <?= anchor(
        route_to('post', $podcast->handle, $reply->id),
        icon('chat', 'text-xl mr-1 text-gray-400') . $reply->replies_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'title' => lang('Post.replies', [
                'numberOfReplies' => $reply->replies_count,
            ]),
        ],
    ) ?>
    <?= anchor_popup(
        route_to('post-remote-action', $podcast->handle, $reply->id, 'reblog'),
        icon('repeat', 'text-xl mr-1 text-gray-400') . $reply->reblogs_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Post.reblogs', [
                'numberOfReblogs' => $reply->reblogs_count,
            ]),
        ],
    ) ?>
    <?= anchor_popup(
        route_to('post-remote-action', $podcast->handle, $reply->id, 'favourite'),
        icon('heart', 'text-xl mr-1 text-gray-400') . $reply->favourites_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Post.favourites', [
                'numberOfFavourites' => $reply->favourites_count,
            ]),
        ],
    ) ?>
</footer>
