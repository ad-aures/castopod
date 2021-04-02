<?= $this->include('podcast/_partials/note') ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r note-replies rounded-b-xl">

<div class="px-6 pt-8 pb-4 bg-gray-50">
<?= anchor_popup(
    route_to('note-remote-action', $podcast->name, $note->id, 'reply'),
    lang('Note.reply_to', ['actorUsername' => $note->actor->username]),
    [
        'class' =>
            'text-center justify-center font-semibold rounded-full shadow relative z-10 px-4 py-2 w-full bg-rose-600 text-white inline-flex items-center hover:bg-rose-700',
        'width' => 420,
        'height' => 620,
    ],
) ?>
</div>


<?php foreach ($note->replies as $reply): ?>
    <?= view('podcast/_partials/reply', ['reply' => $reply]) ?>
<?php endforeach; ?>
</div>
