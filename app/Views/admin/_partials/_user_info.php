<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    <?= lang('User.form.email') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    <?= $user->email ?>
    </dd>
</div>
<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    <?= lang('User.form.username') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    <?= $user->username ?>
    </dd>
</div>
<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    <?= lang('User.form.roles') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    [<?= implode(', ', $user->roles) ?>]
    </dd>
</div>
<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
    <dt class="text-sm font-medium leading-5 text-gray-500">
    <?= lang('User.form.permissions') ?>
    </dt>
    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
    [<?= implode(', ', $user->permissions) ?>]
    </dd>
</div>
