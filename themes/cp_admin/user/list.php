<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.all_users') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.all_users') ?> (<?= count($users) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<Button uri="<?= route_to('user-create') ?>" variant="primary" iconLeft="user-add"><?= lang('User.create') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('User.list.user'),
            'cell' => function ($user) {
                return '<div class="flex flex-col">' .
                    esc($user->username) .
                    '<span class="text-sm text-skin-muted">' .
                    $user->email .
                    '</span></div>';
            },
        ],
        [
            'header' => lang('User.list.roles'),
            'cell' => function ($user) {
                if ($user->isOwner) {
                    return 'owner, ' . implode(',', $user->roles);
                }

                return implode(',', $user->roles) . '<IconButton uri="' . route_to('user-edit', $user->id) . '" glyph="edit" variant="info">' . lang('User.edit_roles', [
                    'username' => esc($user->username),
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
                return '<button id="more-dropdown-' . $user->id . '" type="button" class="inline-flex items-center p-1 focus:ring-accent" data-dropdown="button" data-dropdown-target="more-dropdown-' . $user->id . '-menu" aria-haspopup="true" aria-expanded="false">' . icon('more') . '</button>' .
                '<DropdownMenu id="more-dropdown-' . $user->id . '-menu" labelledby="more-dropdown-' . $user->id . '" items="' . esc(json_encode([
                    [
                        'type' => 'link',
                        'title' => lang('User.forcePassReset'),
                        'uri' => route_to('user-force_pass_reset', $user->id),
                    ],
                    [
                        'type' => 'link',
                        'title' => lang('User.' . ($user->isBanned() ? 'unban' : 'ban')),
                        'uri' => route_to($user->isBanned() ? 'user-unban' : 'user-ban', $user->id),
                    ],
                    [
                        'type' => 'separator',
                    ],
                    [
                        'type' => 'link',
                        'title' => lang('User.delete'),
                        'uri' => route_to('user-delete', $user->id),
                        'class' => 'font-semibold text-red-600',
                    ],

                ])) . '" />';
            },
        ],
    ],
    $users,
) ?>

<?= $this->endSection() ?>
