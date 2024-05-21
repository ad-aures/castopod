<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Manuelt oppsett',
    'manual_config_subtitle' =>
        'Lag ei `.env`-fil med innstillingane dine og oppdater sida for å halda fram installasjonen.',
    'form' => [
        'instance_config' => 'Oppsett for nettstaden',
        'hostname' => 'Vertsnamn',
        'media_base_url' => 'Mediabase-URL',
        'media_base_url_hint' =>
            'Viss du bruker eit leveringsnettverk (CDN) og/eller ei ekstern analysetenest, kan du skriva dei inn her.',
        'admin_gateway' => 'Innfallsport for styrar',
        'admin_gateway_hint' =>
            'Ruta for å koma til styringsområdet (td. https://eksempel.no/cp-admin). Standardvalet er cp-admin, me tilrår at du endrar det av omsyn til tryggleiken.',
        'auth_gateway' => 'Innfallsport for autentisering',
        'auth_gateway_hint' =>
            'Ruta for å koma til autentiseringssidene (td. https://eksempel.no/cp-auth). Standardvalet er cp-auth, me tilrår at du endrar det av omsyn til tryggleiken.',
        'database_config' => 'Databaseoppsett',
        'database_config_hint' =>
            'Castopod treng å kopla seg til MySQL (eller MariaDB)-databasen din. Viss du ikkje har opplysingane som trengst, må du kontakta systemansvarleg.',
        'db_hostname' => 'Databasevertsnamn',
        'db_name' => 'Databasenamn',
        'db_username' => 'Databasebrukarnamn',
        'db_password' => 'Databasepassord',
        'db_prefix' => 'Databaseprefiks',
        'db_prefix_hint' =>
            "Prefikset til Castopod-tabellane. La det stå om du ikkje veit kva det tyder.",
        'cache_config' => 'Mellomlagringsoppsett',
        'cache_config_hint' =>
            'Vel korleis du vil handtera mellomlageret. La stå som det er om du ikkje veit kva det tyder.',
        'cache_handler' => 'Mellomlagerhandtering',
        'cacheHandlerOptions' => [
            'file' => 'Fil',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Neste',
        'submit' => 'Fullfør installeringa',
        'create_superadmin' => 'Lag superstyrar-konto',
        'email' => 'Epost',
        'username' => 'Brukarnamn',
        'password' => 'Passord',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Superstyrar-kontoen din er oppretta. Logg inn for å byrja med podkasting!',
        'databaseConnectError' =>
            'Castopod greidde ikkje å kopla til databasen din. Sjå gjennom databaseoppsettet og prøv ein gong til.',
        'writeError' =>
            "Greidde ikkje laga eller skriva til `.env`-fila. Du må laga ho manuelt ved å fylgja `.env.example`-filmalen i Castopod-pakka.",
    ],
];
