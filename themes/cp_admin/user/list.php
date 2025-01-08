<?= $this->extend('_layout') ?>

<?= $this->section('title') ?>
<?= lang('User.all_users') ?>
<?= $this->endSection() ?>

<?= $this->section('pageTitle') ?>
<?= lang('User.all_users') ?> (<?= count($users) ?>)
<?= $this->endSection() ?>

<?= $this->section('headerRight') ?>
<?php // @icon("user-add-fill")?>
<Button uri="<?= route_to('user-create') ?>" variant="primary" iconLeft="user-add-fill"><?= lang('User.create') ?></Button>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?= data_table(
    [
        [
            'header' => lang('User.list.user'),
            'cell'   => function ($user) {
                return '<div class="flex flex-col">' .
                    esc($user->username) .
                    '<span class="text-sm text-skin-muted">' .
                    $user->email .
                    '</span></div>';
            },
        ],
        [
            'header' => lang('User.list.role'),
            'cell'   => function ($user) {
                $role = get_group_info(get_instance_group($user))['title'];

                if ((bool) $user->is_owner) {
                    $role = '<div class="inline-flex items-center"><span class="mr-2 focus:ring-accent" tabindex="0" data-tooltip="bottom" title="' . lang('Auth.instance_groups.owner.title') . '">' . icon('shield-user-fill') . '</span>' . $role . '</div>';
                }

                // @icon("pencil-fill")
                return $role . '<IconButton uri="' . route_to('user-edit', $user->id) . '" glyph="pencil-fill" variant="info">' . lang('User.edit_role', [
                    'username' => esc($user->username),
                ]) . '</IconButton>';
            },
        ],
        [
            'header' => lang('Common.actions'),
            'cell'   => function ($user) {
                return '<button id="more-dropdown-' . $user->id . '" type="button" class="inline-flex items-center p-1 focus:ring-accent" data-dropdown="button" data-dropdown-target="more-dropdown-' . $user->id . '-menu" aria-haspopup="true" aria-expanded="false">' . icon('more-2-fill') . '</button>' .
                '<DropdownMenu id="more-dropdown-' . $user->id . '-menu" labelledby="more-dropdown-' . $user->id . '" items="' . esc(json_encode([
                    [
                        'type'  => 'link',
                        'title' => lang('User.delete'),
                        'uri'   => route_to('user-delete', $user->id),
                        'class' => 'font-semibold text-red-600',
                    ],
                ])) . '" />';
            },
        ],
    ],
    $users,
) ?>

<?= $this->endSection() ?>
