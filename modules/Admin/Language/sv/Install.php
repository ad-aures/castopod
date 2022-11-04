<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Manuell konfiguration',
    'manual_config_subtitle' =>
        'Skapa en \'.env\' fil med dina inställningar och uppdatera sidan för att fortsätta installationen.',
    'form' => [
        'instance_config' => 'Konfiguration av instans',
        'hostname' => 'Servernamn',
        'media_base_url' => 'Bas-URL för media',
        'media_base_url_hint' =>
            'Om du använder en CDN och/eller en extern analystjänst kan du ställa in dem här.',
        'admin_gateway' => 'Admin gateway',
        'admin_gateway_hint' =>
            'Rutten för att komma åt adminområdet (t.ex. https://example.com/cp-admin). Det är som standard inställt som cp-admin, vi rekommenderar att du ändrar det av säkerhetsskäl.',
        'auth_gateway' => 'Auth gateway',
        'auth_gateway_hint' =>
            'Rutten för att komma åt autentiseringssidorna (t.ex. https://example.com/cp-auth). Den är som standard inställd som cp-auth, vi rekommenderar att du ändrar den av säkerhetsskäl.',
        'database_config' => 'Databas konfiguration',
        'database_config_hint' =>
            'Castopod måste ansluta till din MySQL (eller MariaDB) databas. Om du inte har dessa nödvändiga uppgifter, kontakta din serveradministratör.',
        'db_hostname' => 'Databasens värdnamn',
        'db_name' => 'Databasnamn',
        'db_username' => 'Användarnamn till databasen',
        'db_password' => 'Databasens lösenord',
        'db_prefix' => 'Databas prefix',
        'db_prefix_hint' =>
            "Prefixet för Castopod tabellnamn, lämna som om du inte vet vad det betyder.",
        'cache_config' => 'Cache-konfiguration',
        'cache_config_hint' =>
            'Välj önskad cachehanterare. Lämna det som standardvärde om du inte har någon aning om vad det innebär.',
        'cache_handler' => 'Cache handler',
        'cacheHandlerOptions' => [
            'file' => 'Fil',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Nästa',
        'submit' => 'Slutför installationen',
        'create_superadmin' => 'Skapa ditt superadministratörskonto',
        'email' => 'Epost',
        'username' => 'Användarnamn',
        'password' => 'Lösenord',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Ditt superadministratörskonto har skapats. Logga in för att starta podcasting!',
        'databaseConnectError' =>
            'Castopod kunde inte ansluta till din databas. Redigera din databaskonfiguration och försök igen.',
        'writeError' =>
            "Kunde inte skapa/skriva `.env`-filen. Du måste skapa den manuellt genom att följa filmallen `.env.exempel` i Castopod-paketet.",
    ],
];
