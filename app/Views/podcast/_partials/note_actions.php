<footer class="flex justify-around px-6 py-3">
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
    <?= anchor_popup(
        route_to('note-remote-action', $podcast->name, $note->id, 'reblog'),
        icon('repeat', 'text-2xl mr-1 text-gray-400') . $note->reblogs_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Note.reblogs', [
                'numberOfReblogs' => $note->reblogs_count,
            ]),
        ],
    ) ?>
    <?= anchor_popup(
        route_to('note-remote-action', $podcast->name, $note->id, 'favourite'),
        icon('heart', 'text-2xl mr-1 text-gray-400') . $note->favourites_count,
        [
            'class' => 'inline-flex items-center hover:underline',
            'width' => 420,
            'height' => 620,
            'title' => lang('Note.favourites', [
                'numberOfFavourites' => $note->favourites_count,
            ]),
        ],
    ) ?>
</footer>
