<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('Fediverse.blocked_domains') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('Fediverse.blocked_domains') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= form_open(route_to('fediverse-attempt-block-domain'), [
    'method' => 'post',
    'class' => 'flex flex-col max-w-md mb-8',
]) ?>

<?= form_label(
    lang('Fediverse.block_lists_form.domain'),
    'blocked_users',
    [],
) ?>
<?= form_input(
    [
        'id' => 'domain',
        'name' => 'domain',
        'class' => 'form-input mb-4',
        'type' => 'text',
    ],
    old('domain', ''),
) ?>

<?= button(
    lang('Fediverse.block_lists_form.submit'),
    '',
    ['variant' => 'primary'],
    ['type' => 'submit', 'class' => 'self-end'],
) ?>

<?= form_close() ?>

<?= data_table(
    [
        [
            'header' => lang('Fediverse.list.actor'),
            'cell' => function ($blockedDomain) {
                return $blockedDomain->name;
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($blockedDomain) {
                return '<form action="' .
                    route_to('fediverse-attempt-unblock-domain') .
                    '" method="POST">' .
                    '<input name="domain" type="hidden" value="' .
                    $blockedDomain->name .
                    '" />' .
                    csrf_field() .
                    button(
                        lang('Fediverse.list.unblock'),
                        route_to(
                            'fediverse-unblock-domain',
                            $blockedDomain->name,
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
    $blockedDomains,
) ?>

<?= $this->endSection() ?>
