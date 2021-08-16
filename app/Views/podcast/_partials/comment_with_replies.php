<?= $this->include('podcast/_partials/comment_card') ?>
<div class="-mt-2 overflow-hidden border-b border-l border-r post-replies rounded-b-xl">

<?php foreach ($comment->replies as $reply): ?>
    <?= view('podcast/_partials/comment_reply', ['reply' => $reply]) ?>
<?php endforeach; ?>

</div>
