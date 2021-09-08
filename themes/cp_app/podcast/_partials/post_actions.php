<footer class="flex justify-around px-6 py-3">
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
    <?= anchor_popup(
    route_to('post-remote-action', $podcast->handle, $post->id, 'reblog'),
    icon('repeat', 'text-2xl mr-1 text-gray-400') . $post->reblogs_count,
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
    route_to('post-remote-action', $podcast->handle, $post->id, 'favourite'),
    icon('heart', 'text-2xl mr-1 text-gray-400') . $post->favourites_count,
    [
        'class' => 'inline-flex items-center hover:underline',
        'width' => 420,
        'height' => 620,
        'title' => lang('Post.favourites', [
            'numberOfFavourites' => $post->favourites_count,
        ]),
    ],
) ?>
</footer>
