<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Fediverse.blocked_actors') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Fediverse.blocked_actors') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<form action="<?= route_to('fediverse-attempt-block-actor') ?>" method="POST" class="flex flex-col max-w-md">
    <Forms.Field name="handle" label="<?= lang('Fediverse.block_lists_form.handle') ?>" hintText="<?= lang('Fediverse.block_lists_form.handle_hint') ?>" />
    <Button variant="primary" type="submit" class="self-end"><?= lang('Fediverse.block_lists_form.submit') ?></Button>
</form>

<?= data_table(
    [
        [
            'header' => lang('Fediverse.list.actor'),
            'cell' => function ($blockedActor) {
                return $blockedActor->username;
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($blockedActor) {
                return '<form action="' .
                    route_to('fediverse-attempt-unblock-actor') .
                    '" method="POST">' .
                    '<input name="actor_id" type="hidden" value="' .
                    $blockedActor->id .
                    '" />' .
                    csrf_field() .
                    button(
                        lang('Fediverse.list.unblock'),
                        route_to(
                            'fediverse-unblock-actor',
                            $blockedActor->username,
                        ),
                        [
                            'variant' => 'info',
                            'size' => 'small',
                        ],
                        [
                            'class' => 'mr-2',
                            'type' => 'submit',
                        ],
                    ) .
                    '</form>';
            },
        ],
    ],
    $blockedActors,
) ?>


<?= $this->endSection() ?>
