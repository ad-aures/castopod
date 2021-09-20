<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.all_users') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.all_users') ?> (<?= count($users) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('user-create') ?>" variant="accent" iconLeft="user-add"><?= lang('User.create') ?></Button>
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
                    '<IconButton uri="' . route_to('user-edit', $user->id) . '" glyph="edit" variant="info">' . lang('User.edit_roles', [
                        'username' => $user->username,
                    ]) . '</IconButton>';
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
                return '<Button uri="' . route_to('user-force_pass_reset', $user->id) . '" variant="secondary" size="small">' . lang('User.forcePassReset') . '</Button>' .
                '<Button uri="' . route_to($user->isBanned() ? 'user-unban' : 'user-ban', $user->id) . '" variant="warning" size="small">' . lang('User.' . ($user->isBanned() ? 'unban' : 'ban')) . '</Button>' .
                '<Button uri="' . route_to('user-delete', $user->id) . '" variant="danger" size="small">' . lang('User.delete') . '</Button>';
            },
        ],
    ],
    $users,
) ?>

<?= $this->endSection() ?>
