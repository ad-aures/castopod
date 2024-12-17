<?= $this->extend('_layout') ?>

<?= $this->section('pageTitle') ?>
<?= lang('Fediverse.blocked_actors') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('fediverse-attempt-block-actor') ?>" method="POST" class="flex flex-col max-w-md">
    <?= csrf_field() ?>

    <x-Forms.Field
        name="handle"
        label="<?= esc(lang('Fediverse.block_lists_form.handle')) ?>"
        hint="<?= esc(lang('Fediverse.block_lists_form.handle_hint')) ?>"
        isRequired="true" />
    <x-Button variant="primary" type="submit" class="self-end"><?= lang('Fediverse.block_lists_form.submit') ?></x-Button>
</form>

<?= data_table(
    [
        [
            'header' => lang('Fediverse.list.actor'),
            'cell'   => function ($blockedActor) {
                return esc($blockedActor->username);
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($blockedActor) {
                return '<form action="' .
                    route_to('fediverse-attempt-unblock-actor') .
                    '" method="POST">' .
                    '<input name="actor_id" type="hidden" value="' .
                    $blockedActor->id .
                    '" />' .
                    csrf_field() .
                    '<x-Button uri="' . route_to('fediverse-unblock-actor', esc($blockedActor->username)) . '" variant="info" size="small" type="submit">' . lang('Fediverse.list.unblock') . '</x-Button>' .
                    '</form>';
            },
        ],
    ],
    $blockedActors,
    'mt-8'
) ?>


<?= $this->endSection() ?>
