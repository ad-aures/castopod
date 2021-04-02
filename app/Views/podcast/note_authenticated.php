<?= $this->extend('podcast/_layout_authenticated') ?>

<?= $this->section('meta-tags') ?>
    <title><?= lang('Note.title', [
        'actorDisplayName' => $note->actor->display_name,
    ]) ?></title>
    <meta name="description" content="<?= $note->message ?>"/>
    <meta property="og:title" content="<?= lang('Note.title', [
        'actorDisplayName' => $note->actor->display_name,
    ]) ?>"/>
    <meta property="og:locale" content="<?= service(
        'request',
    )->getLocale() ?>" />
    <meta property="og:site_name" content="<?= $note->actor->display_name ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:image" content="<?= $note->actor->avatar_image_url ?>" />
    <meta property="og:description" content="<?= $note->message ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl px-6 mx-auto">
    <nav class="py-3">
        <a href="<?= route_to('podcast-activity', $podcast->name) ?>"
        class="inline-flex items-center px-4 py-2 text-sm"><?= icon(
            'arrow-left',
            'mr-2 text-lg',
        ) .
            lang('Note.back_to_actor_notes', [
                'actor' => $note->actor->display_name,
            ]) ?></a>
    </nav>
    <div class="pb-12">
        <?= $this->include(
            'podcast/_partials/note_with_replies_authenticated',
        ) ?>
    </div>
</div>

<?= $this->endSection()
?>
