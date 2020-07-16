<aside class="w-64 px-4 py-6">
    <nav>
        <a class="block px-2 py-1 mb-4 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
            'admin'
        ) ?>">
            Dashboard
        </a>
        <div class="mb-4">
            <span class="mb-3 text-sm font-bold tracking-wide text-gray-600 uppercase lg:mb-2 lg:text-xs">Podcasts</span>
            <ul>
                <li>
                    <a class="block px-2 py-1 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
                        'my_podcasts'
                    ) ?>">My podcasts</a>
                </li>
                <li>
                    <a class="block px-2 py-1 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
                        'podcast_list'
                    ) ?>">All podcasts</a>
                </li>
                <li>
                    <a class="block px-2 py-1 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
                        'podcast_create'
                    ) ?>">New podcast</a>
                </li>
            </ul>
        </div>
        <div class="mb-4">
            <span class="mb-3 text-sm font-bold tracking-wide text-gray-600 uppercase lg:mb-2 lg:text-xs">Users</span>
            <ul>
                <li>
                    <a class="block px-2 py-1 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
                        'user_list'
                    ) ?>">All Users</a>
                </li>
                <li>
                    <a class="block px-2 py-1 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
                        'user_create'
                    ) ?>">New user</a>
                </li>
            </ul>
        </div>
        <div>
            <span class="mb-3 text-sm font-bold tracking-wide text-gray-600 uppercase lg:mb-2 lg:text-xs">My Account</span>
            <ul>
                <li>
                    <a class="block px-2 py-1 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
                        'myAccount'
                    ) ?>">Account info</a>
                </li>
                <li>
                    <a class="block px-2 py-1 -mx-2 text-gray-600 transition duration-200 ease-in-out hover:text-gray-900" href="<?= route_to(
                        'myAccount_change-password'
                    ) ?>">Change my password</a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
