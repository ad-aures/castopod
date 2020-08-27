<header class="<?= $class ?>">
    <div class="w-64">
        <a href="<?= route_to(
            'admin'
        ) ?>" class="inline-flex items-center text-xl">
            <?= svg('logo-castopod', 'h-10 mr-2') ?>
            Admin
        </a>
    </div>
    <?= render_breadcrumb() ?>
    <div class="relative ml-auto" data-toggle="dropdown">
        <button type="button" class="inline-flex items-center px-2 py-1 outline-none focus:shadow-outline" id="my-accountDropdown" data-popper="button" aria-haspopup="true" aria-expanded="false">
            Hey <?= user()->username ?>
            <?= icon('caret-down', 'ml-2') ?>
        </button>
        <nav class="absolute z-10 flex-col hidden py-2 text-black whitespace-no-wrap bg-white border rounded shadow" aria-labelledby="my-accountDropdown" data-popper="menu" data-popper-placement="bottom-end">
                <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                    'my-account'
                ) ?>">My Account</a>
                <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                    'change-password'
                ) ?>">Change password</a>
                <a class="px-4 py-1 hover:bg-gray-100" href="<?= route_to(
                    'logout'
                ) ?>">Logout</a>
        </nav>
    </div>
</header>