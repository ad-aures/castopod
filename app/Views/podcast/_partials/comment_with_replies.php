<?= $this->include('podcast/_partials/comment') ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r comment-replies rounded-b-xl">

<div class="px-6 pt-8 pb-4 bg-gray-50">
<?= anchor_popup(
    route_to('comment-remote-action', $podcast->handle, $comment->id, 'reply'),
    lang('comment.reply_to', ['actorUsername' => $comment->actor->username]),
    [
        'class' =>
            'text-center justify-center font-semibold rounded-full shadow relative z-10 px-4 py-2 w-full bg-rose-600 text-white inline-flex items-center hover:bg-rose-700',
        'width' => 420,
        'height' => 620,
    ],
) ?>
</div>


<?php foreach ($comment->replies as $reply): ?>
    <?= view('podcast/_partials/comment', ['comment' => $reply]) ?>
<?php endforeach; ?>

</div>
