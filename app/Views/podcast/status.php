<?= $this->extend('podcast/_layout') ?>

<?= $this->section('meta-tags') ?>
    <title><?= lang('Status.title', [
        'actorDisplayName' => $status->actor->display_name,
    ]) ?></title>
    <meta name="description" content="<?= $status->message ?>"/>
    <meta property="og:title" content="<?= lang('Status.title', [
        'actorDisplayName' => $status->actor->display_name,
    ]) ?>"/>
    <meta property="og:locale" content="<?= service(
        'request',
    )->getLocale() ?>" />
    <meta property="og:site_name" content="<?= $status->actor->display_name ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:image" content="<?= $status->actor->avatar_image_url ?>" />
    <meta property="og:description" content="<?= $status->message ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-2xl px-6 mx-auto">
    <nav class="py-3">
        <a href="<?= route_to('podcast-activity', $podcast->handle) ?>"
        class="inline-flex items-center px-4 py-2 text-sm"><?= icon(
            'arrow-left',
            'mr-2 text-lg',
        ) .
            lang('Status.back_to_actor_statuses', [
                'actor' => $status->actor->display_name,
            ]) ?></a>
    </nav>
    <div class="pb-12">
        <?= $this->include('podcast/_partials/status_with_replies') ?>
    </div>
</div>

<?= $this->endSection()
?>
