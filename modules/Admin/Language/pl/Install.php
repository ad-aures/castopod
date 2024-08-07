<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Konfiguracja ręczna',
    'manual_config_subtitle' =>
        'Stwórz plik `.env` ze swoimi ustawieniami i odśwież stronę, aby kontynuować instalację.',
    'form' => [
        'instance_config' => 'Konfiguracja instancji',
        'hostname' => 'Nazwa hosta',
        'media_base_url' => 'Bazowy URL mediów',
        'media_base_url_hint' =>
            'Jeśli korzystasz z CDNa i/lub zewnętrznej usługi analitycznej, możesz ustawić je tutaj.',
        'admin_gateway' => 'Strona administracyjna',
        'admin_gateway_hint' =>
            'Droga dostępu do obszaru administracyjnego (np. https://example.com/cp-admin). Domyślnie jest ustawiona jako cp-admin, ale ze względów bezpieczeństwa zalecamy zmianę tej nazwy.',
        'auth_gateway' => 'Strona uwierzytelniania',
        'auth_gateway_hint' =>
            'Dostęp do stron uwierzytelniających (np. https://example.com/cp-auth). Domyślnie jest ustawiony jako cp-auth, ale ze względów bezpieczeństwa zalecamy zmianę tej nazwy.',
        'database_config' => 'Konfiguracja bazy danych',
        'database_config_hint' =>
            'Castopod musi połączyć się z bazą danych MySQL (lub MariaDB). Jeśli nie masz tych wymaganych informacji, skontaktuj się z administratorem serwera.',
        'db_hostname' => 'Nazwa hosta bazy danych',
        'db_name' => 'Nazwa bazy danych',
        'db_username' => 'Nazwa użytkownika bazy danych',
        'db_password' => 'Hasło bazy danych',
        'db_prefix' => 'Prefiks bazy danych',
        'db_prefix_hint' =>
            "Prefiks nazw tabel Castopod — pozostaw bez zmian, jeśli nie wiesz, co to znaczy.",
        'cache_config' => 'Konfiguracja pamięci podręcznej',
        'cache_config_hint' =>
            'Wybierz preferowany mechanizm pamięci podręcznej. Zostaw domyślną wartość, jeśli nie masz pojęcia, co to znaczy.',
        'cache_handler' => 'Mechanizm pamięci podręcznej',
        'cacheHandlerOptions' => [
            'file' => 'Plik',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Dalej',
        'submit' => 'Zakończ instalację',
        'create_superadmin' => 'Utwórz swoje konto superadministratora',
        'email' => 'Email',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Twoje konto superadministratora zostało pomyślnie utworzone. Zaloguj się, aby rozpocząć podcastowanie!',
        'databaseConnectError' =>
            'Castopod nie mógł połączyć się z Twoją bazą danych. Edytuj konfigurację bazy danych i spróbuj ponownie.',
        'writeError' =>
            "Nie można utworzyć/zapisać pliku `.env`. Musisz go utworzyć ręcznie, postępując zgodnie z szablonem `.env.example` w pakiecie Castopod.",
    ],
];
