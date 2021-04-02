<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('Fediverse.blocked_actors') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Fediverse.blocked_actors') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('fediverse-attempt-block-actor'), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md mb-8',
]) ?>

<?= form_label(
    lang('Fediverse.block_lists_form.handle'),
    'blocked_users',
    [],
    lang('Fediverse.block_lists_form.handle_hint'),
) ?>
<?= form_input(
    [
        'id' => 'handle',
        'name' => 'handle',
        'class' => 'form-input mb-4',
        'type' => 'text',
    ],
    old('handle', ''),
) ?>

<?= button(
    lang('Fediverse.block_lists_form.submit'),
    null,
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>


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
                        ['variant' => 'info', 'size' => 'small'],
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
