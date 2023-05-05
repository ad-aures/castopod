<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Castopod installatie',
    'manual_config' => 'Handmatige configuratie',
    'manual_config_subtitle' =>
        'Maak een `.env` bestand aan met je instellingen en vernieuw de pagina om door te gaan met de installatie.',
    'form' => [
        'instance_config' => 'Instantie configuratie',
        'hostname' => 'Hostnaam',
        'media_base_url' => 'Media basis-URL',
        'media_base_url_hint' =>
            'Als u een CDN en/of een externe statistiekenservice gebruikt, kunt u ze hier instellen.',
        'admin_gateway' => 'Admin pad',
        'admin_gateway_hint' =>
            'De route naar toegang tot de admin omgeving (bijv. https://example.com/cp-admin). Het is standaard ingesteld als cp-admin, we raden je aan om het te wijzigen om veiligheidsredenen.',
        'auth_gateway' => 'Authenticatie pad',
        'auth_gateway_hint' =>
            'De route voor toegang tot de authenticatiepagina\'s (bijv. https://example.com/cp-auth). Deze is standaard ingesteld als cp-auth, wij raden u aan deze om veiligheidsredenen te wijzigen.',
        'database_config' => 'Databaseconfiguratie',
        'database_config_hint' =>
            'Castopod moet verbinding maken met uw MySQL (of MariaDB) database. Als u niet over de benodigde informatie beschikt, neem dan contact op met uw serverbeheerder.',
        'db_hostname' => 'Database hostnaam',
        'db_name' => 'Databasenaam',
        'db_username' => 'Database gebruikersnaam',
        'db_password' => 'Database wachtwoord',
        'db_prefix' => 'Database voorvoegsel',
        'db_prefix_hint' =>
            "Het voorvoegsel van de Castopod tabelnamen. Laat leeg indien je niet weet wat dit betekent.",
        'cache_config' => 'Cache-configuratie',
        'cache_config_hint' =>
            'Kies je gewenste cache-handler. Laat deze standaard waarde achter als je geen idee hebt wat het betekent.',
        'cache_handler' => 'Cache handler',
        'cacheHandlerOptions' => [
            'file' => 'Bestandsysteem',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Volgende',
        'submit' => 'Installatie voltooien',
        'create_superadmin' => 'Maak uw Super Admin account aan',
        'email' => 'E-mail',
        'username' => 'Gebruikersnaam',
        'password' => 'Wachtwoord',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Uw superadmin account is aangemaakt. Log in om met podcasten te starten!',
        'databaseConnectError' =>
            'Castopod kon geen verbinding maken met uw database. Bewerk uw databaseconfiguratie en probeer het opnieuw.',
        'writeError' =>
            "Kon het `.env` bestand niet maken/schrijven. Je moet het handmatig aanmaken door het meegeleverde voorbeeld `.env.example` bestand te kopiëren en aan te passen.",
    ],
];
