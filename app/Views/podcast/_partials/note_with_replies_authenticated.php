<?= $this->include('podcast/_partials/note_authenticated') ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r note-replies rounded-b-xl">
<?= form_open(
    route_to('note-attempt-action', interact_as_actor()->username, $note->id),
    [
        'class' => 'bg-gray-50 flex px-6 pt-8 pb-4',
    ],
) ?>
<img src="<?= interact_as_actor()
    ->avatar_image_url ?>" alt="<?= interact_as_actor()
    ->display_name ?>" class="w-12 h-12 mr-4 rounded-full ring-gray-50 ring-2" />
<div class="flex flex-col flex-1">
<?= form_textarea(
    [
        'id' => 'message',
        'name' => 'message',
        'class' => 'form-textarea mb-4 w-full',
        'required' => 'required',
        'placeholder' => lang('Note.form.reply_to_placeholder', [
            'actorUsername' => $note->actor->username,
        ]),
    ],
    old('message', '', false),
    [
        'rows' => 1,
    ],
) ?>
<?= button(
    lang('Note.form.submit_reply'),
    '',
    ['variant' => 'primary', 'size' => 'small'],
    [
        'type' => 'submit',
        'class' => 'self-end',
        'name' => 'action',
        'value' => 'reply',
    ],
) ?>
</div>
<?= form_close() ?>

<?php if ($note->has_replies): ?>
    <?php foreach ($note->replies as $reply): ?>
        <?= view('podcast/_partials/reply_authenticated', [
            'reply' => $reply,
        ]) ?>
    <?php endforeach; ?>
<?php endif; ?>
</div>
