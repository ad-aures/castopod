<?= $this->extend('episode/_layout-preview') ?>

<?= $this->section('content') ?>

<div class="flex flex-col gap-y-2">
    <?php foreach ($episode->comments as $comment): ?>
        <?= view('episode/_partials/comment', [
    'comment'         => $comment,
            'podcast' => $podcast,
]) ?>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>