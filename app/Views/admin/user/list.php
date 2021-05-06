<?= $this->extend('admin/_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.all_users') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.all_users') ?> (<?= count($users) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?= button(lang('User.create'), route_to('user-create'), [
    'variant' => 'accent',
    'iconLeft' => 'user-add',
]) ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('User.list.user'),
            'cell' => function ($user) {
                return '<div class="flex flex-col">' .
                    $user->username .
                    '<span class="text-sm text-gray-600">' .
                    $user->email .
                    '</span></div>';
            },
        ],
        [
            'header' => lang('User.list.roles'),
            'cell' => function ($user) {
                return implode(',', $user->roles) .
                    icon_button(
                        'edit',
                        lang('User.edit_roles', [
                            'username' => $user->username,
                        ]),
                        route_to('user-edit', $user->id),
                        ['variant' => 'info'],
                        ['class' => 'ml-2'],
                    );
            },
        ],
        [
            'header' => lang('User.list.banned'),
            'cell' => function ($user) {
                return $user->isBanned()
                    ? lang('Common.yes')
                    : lang('Common.no');
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell' => function ($user) {
                return button(
                    lang('User.forcePassReset'),
                    route_to('user-force_pass_reset', $user->id),
                    [
                        'variant' => 'secondary',
                        'size' => 'small',
                    ],
                    ['class' => 'mr-2'],
                ) .
                    button(
                        lang('User.' . ($user->isBanned() ? 'unban' : 'ban')),
                        route_to(
                            $user->isBanned() ? 'user-unban' : 'user-ban',
                            $user->id,
                        ),
                        ['variant' => 'warning', 'size' => 'small'],
                        ['class' => 'mr-2'],
                    ) .
                    button(
                        lang('User.delete'),
                        route_to('user-delete', $user->id),
                        ['variant' => 'danger', 'size' => 'small'],
                    );
            },
        ],
    ],
    $users,
) ?>

<?= $this->endSection() ?>
