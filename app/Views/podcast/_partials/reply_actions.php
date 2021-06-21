<footer class="mt-2 space-x-6 text-sm">
    <?= anchor(
        route_to('status', $podcast->name, $reply->id),
        icon('chat', 'text-xl mr-1 text-gray-400') . $reply->replies_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'title' => lang('Status.replies', [
                'numberOfReplies' => $reply->replies_count,
            ]),
        ],
    ) ?>
    <?= anchor_popup(
        route_to('status-remote-action', $podcast->name, $reply->id, 'reblog'),
        icon('repeat', 'text-xl mr-1 text-gray-400') . $reply->reblogs_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Status.reblogs', [
                'numberOfReblogs' => $reply->reblogs_count,
            ]),
        ],
    ) ?>
    <?= anchor_popup(
        route_to('status-remote-action', $podcast->name, $reply->id, 'favourite'),
        icon('heart', 'text-xl mr-1 text-gray-400') . $reply->favourites_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Status.favourites', [
                'numberOfFavourites' => $reply->favourites_count,
            ]),
        ],
    ) ?>
</footer>
