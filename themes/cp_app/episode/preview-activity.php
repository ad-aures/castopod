<?= $this->extend('episode/_layout-preview') ?>

<?= $this->section('content') ?>

<div class="flex flex-col gap-y-4">
    <?php foreach ($episode->posts as $key => $post): ?>
        <?= view('post/_partials/card', [
    'index'           => $key,
            'post'    => $post,
            'podcast' => $podcast,
]) ?>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
