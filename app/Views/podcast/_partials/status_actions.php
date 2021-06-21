<footer class="flex justify-around px-6 py-3">
    <?= anchor(
        route_to('status', $podcast->name, $status->id),
        icon('chat', 'text-2xl mr-1 text-gray-400') . $status->replies_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'title' => lang('Status.replies', [
                'numberOfReplies' => $status->replies_count,
            ]),
        ],
    ) ?>
    <?= anchor_popup(
        route_to('status-remote-action', $podcast->name, $status->id, 'reblog'),
        icon('repeat', 'text-2xl mr-1 text-gray-400') . $status->reblogs_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Status.reblogs', [
                'numberOfReblogs' => $status->reblogs_count,
            ]),
        ],
    ) ?>
    <?= anchor_popup(
        route_to('status-remote-action', $podcast->name, $status->id, 'favourite'),
        icon('heart', 'text-2xl mr-1 text-gray-400') . $status->favourites_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Status.favourites', [
                'numberOfFavourites' => $status->favourites_count,
            ]),
        ],
    ) ?>
</footer>
