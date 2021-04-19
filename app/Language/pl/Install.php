<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Ręczna konfiguracja',
    'manual_config_subtitle' =>
        'Utwórz plik `.env` z własnymi ustawieniami i odśwież stronę, aby kontynuować instalację.',
    'form' => [
        'instance_config' => 'Kondiguracja instancji',
        'hostname' => 'Nazwa hosta',
        'media_base_url' => 'Bazowy URL mediów',
        'media_base_url_hint' =>
            'Jeżeli korzystasz z CDN-a i/lub zewnętrznej usługi analitycznej, możesz je ustawić tutaj.',
        'admin_gateway' => 'Bramka administratora',
        'admin_gateway_hint' =>
            'Adres pozwalający na dostęp do strefy administracyjnej (np. https://example.com/cp-admin). Domyślnie jest ustawiony na cp-admin, ale zalecamy go zmienić z przyczyn bezpieczeństwa.',
        'auth_gateway' => 'Bramka autoryzacji',
        'auth_gateway_hint' =>
            'Adres pozwalający na dostęp do stron uwierzytelniania (np. https://example.com/cp-auth). Domyślnie jest ustawiony na cp-admin, ale zalecamy go zmienić z przyczyn bezpieczeństwa.',
        'database_config' => 'Konfiguracja bazy danych',
        'database_config_hint' =>
            'Castopod wymaga połączenia z bazą danych MySQL (lub MariaDB). Jeżeli nie masz wymaganych informacji, skontaktuj się z administratorem serwera.',
        'db_hostname' => 'Nazwa hosta bazy danych',
        'db_name' => 'Nazwa bazy danych',
        'db_username' => 'Nazwa użytkownika bazy danych',
        'db_password' => 'Hasło bazy danych',
        'db_prefix' => 'Prefiks bazy danych',
        'db_prefix_hint' =>
            'Prefiks nazw tabeli Castopod, pozostaw obecny, jeżeli nie wiesz co to znaczy.',
        'cache_config' => 'Konfiguracja pamięci podręcznej',
        'cache_config_hint' =>
            'Wybierz preferowaną metodę obsługę pamięci podręcznej. Pozostaw domyślną wartość, jeżeli nie wiesz co to znaczy.',
        'cache_handler' => 'Obsługa pamięci podręcznej',
        'cacheHandlerOptions' => [
            'file' => 'Plik',
            'redis' => 'Redis',
            'memcached' => 'Memcached',
        ],
        'next' => 'Dalej',
        'submit' => 'Zakończ instalację',
        'create_superadmin' => 'Utwórz konto super administratora',
        'email' => 'Adres e-mail',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Twoje konto super administratora zostało pomyślnie utworzone. Zaloguj się, aby rozpocząć podcastowanie!',
        'databaseConnectError' =>
            'Castopod nie mógł połączyć się z bazą danych. Edytuj konfigurację bazy danych i spróbuj ponownie.',
        'writeError' =>
            'Nie udało się utworzyć pliku `.env`. Musisz utworzyć go ręcznie tak, jak w pliku `.env.example` w pakiecie Castopod.',
    ],
];
