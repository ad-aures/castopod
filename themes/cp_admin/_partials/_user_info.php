<div class="px-4 py-5">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('User.form.email') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5">
    <?= $user->email ?>
    </dd>
</div>
<div class="px-4 py-5">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('User.form.username') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5">
    <?= $user->username ?>
    </dd>
</div>
<div class="px-4 py-5">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('User.form.roles') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5">
    <?= implode(', ', $user->roles) ?>
    </dd>
</div>
<div class="px-4 py-5">
    <dt class="text-sm font-medium leading-5 text-skin-muted">
    <?= lang('User.form.permissions') ?>
    </dt>
    <dd class="max-w-xl mt-1 text-sm leading-5">
    <?= implode(', ', $user->permissions) ?>
    </dd>
</div>
