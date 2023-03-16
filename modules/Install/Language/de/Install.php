<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Castopod-Installer',
    'manual_config' => 'Manuelle Konfiguration',
    'manual_config_subtitle' =>
        'Erstelle eine `.env`-Datei mit deinen Einstellungen und aktualisiere die Seite, um die Installation fortzusetzen.',
    'form' => [
        'instance_config' => 'Instance-Konfiguration',
        'hostname' => 'Hostname',
        'media_base_url' => 'Medien-Basis-URL',
        'media_base_url_hint' =>
            'Wenn du einen CDN und/oder einen externen Analysedienst verwendest, kannst du diesen hier festlegen.',
        'admin_gateway' => 'Admin-Gateway',
        'admin_gateway_hint' =>
            'Der Pfad zum Zugriff auf den Admin-Bereich (z.B. https://example.com/cp-admin), wird standardmäßig als "cp-admin" festgelegt. Wir empfehlen, sie aus Sicherheitsgründen zu ändern.',
        'auth_gateway' => 'Auth-Gateway',
        'auth_gateway_hint' =>
            'Der Pfad zum Zugriff auf die Authentifizierungsseiten (z. B. https://example.com/cp-auth), wird standardmäßig als "cp-auth" gesetzt. Wir empfehlen, sie aus Sicherheitsgründen zu ändern.',
        'database_config' => 'Datenbankkonfiguration',
        'database_config_hint' =>
            'Castopod muss sich mit der MySQL-Datenbank (oder MariaDB) verbinden. Wenn diese erforderlichen Informationen nicht verfügbar sind, wende dich bitte an deinen Serveradministrator.',
        'db_hostname' => 'Datenbank Hostname',
        'db_name' => 'Datenbankname',
        'db_username' => 'Datenbank-Benutzername',
        'db_password' => 'Datenbank-Passwort',
        'db_prefix' => 'Datenbankpräfix',
        'db_prefix_hint' =>
            "Das Präfix der Castopod-Tabellennamen. Nicht anpassen, wenn nicht klar ist was damit gemeint ist.",
        'cache_config' => 'Cache-Konfiguration',
        'cache_config_hint' =>
            'Wähle deinen bevorzugten Cache-Handler. Belasse den Standardwert, wenn du keine Ahnung hast, was er bedeutet.',
        'cache_handler' => 'Cache-Handler',
        'cacheHandlerOptions' => [
            'file' => 'Datei',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Weiter',
        'submit' => 'Installation abschließen',
        'create_superadmin' => 'Erstelle deinen Superadmin-Account',
        'email' => 'E-Mail',
        'username' => 'Benutzername',
        'password' => 'Passwort',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Dein Superadmin-Account wurde erfolgreich erstellt. Melde dich an, um mit dem Podcasting zu starten!',
        'databaseConnectError' =>
            'Castopod konnte keine Verbindung zur Datenbank herstellen. Bearbeite die Datenbankkonfiguration und versuche es erneut.',
        'writeError' =>
            "Konnte die `.env`-Datei nicht erstellen/schreiben. Du musst sie manuell erstellen, indem du dem `.env.example` Template im Castopod Paket folgst.",
    ],
];
