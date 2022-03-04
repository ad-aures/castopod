<?= $this->extend('episode/_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-2xl px-6 mx-auto">
    <nav class="mb-2">
        <a href="<?= route_to('episode', esc($podcast->handle), esc($episode->slug)) ?>"
        class="inline-flex items-center px-4 py-2 text-sm focus:ring-accent"><?= icon(
    'arrow-left',
    'mr-2 text-lg',
) . lang('Comment.back_to_comments') ?></a>
    </nav>
    <div class="pb-12">
        <?= $this->include('episode/_partials/comment_with_replies') ?>
    </div>
</div>

<?= $this->endSection()
?>
