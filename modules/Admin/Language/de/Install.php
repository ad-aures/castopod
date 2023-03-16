<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Manuelle Konfiguration',
    'manual_config_subtitle' =>
        '`.env`-Datei mit deinen Einstellungen erstellen und die Seite aktualisieren, um mit der Installation fortzufahren.',
    'form' => [
        'instance_config' => 'Instanzinformationen',
        'hostname' => 'Hostname',
        'media_base_url' => 'Medien-Basis-URL',
        'media_base_url_hint' =>
            'Um optional CDN und/oder einen externen Analysedienst verwenden zu können, müssen die Daten eingegeben werden.',
        'admin_gateway' => 'Admin-Gateway',
        'admin_gateway_hint' =>
            'Der Pfad zum Zugriff auf den Admin-Bereich (z.B. https://example.com/cp-admin). Standardmäßig als cp-admin festgelegt. Wir empfehlen, sie aus Sicherheitsgründen zu ändern.',
        'auth_gateway' => 'Auth-Gateway',
        'auth_gateway_hint' =>
            'Der Pfad zum Zugriff auf die Authentifizierungsseiten (z. B. https://example.com/cp-auth). Standardmäßig als cp-auth gesetzt. Wir empfehlen, sie aus Sicherheitsgründen zu ändern.',
        'database_config' => 'Datenbankkonfiguration',
        'database_config_hint' =>
            'Castopod muss sich mit der MySQL-Datenbank (oder MariaDB) verbinden. Wenn diese erforderlichen Informationen nicht verfügbar sind, wenden Sie sich bitte an Ihren Serveradministrator.',
        'db_hostname' => 'Datenbank Hostname',
        'db_name' => 'Datenbankname',
        'db_username' => 'Datenbankbenutzername',
        'db_password' => 'Datenbankpasswort',
        'db_prefix' => 'Tabellenpräfix',
        'db_prefix_hint' =>
            "Das Präfix der Castopod-Tabellennamen. Nicht anpassen, wenn du nicht weißt, was damit gemeint ist.",
        'cache_config' => 'Cachekonfiguration',
        'cache_config_hint' =>
            'Wählen Sie Ihren bevorzugten Cache-Handler. Standardwert verwenden, wenn Sie nicht wissen, was damit gemeint ist.',
        'cache_handler' => 'Cache-Handler',
        'cacheHandlerOptions' => [
            'file' => 'Datei',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Weiter',
        'submit' => 'Installation abschließen',
        'create_superadmin' => 'Superadmin Konto erstellen',
        'email' => 'E-Mail',
        'username' => 'Benutzername',
        'password' => 'Passwort',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Superadmin-Account wurde erfolgreich erstellt. Anmelden, um loszulegen!',
        'databaseConnectError' =>
            'Castopod konnte keine Verbindung zur Datenbank herstellen. Datenbankkonfiguration bearbeiten und erneut versuchen.',
        'writeError' =>
            "Konnte die `.env`-Datei nicht erstellen/schreiben. Sie muss manuell erstellt werden, indem dem `.env.example` Template im Castopod Paket gefolgt wird.",
    ],
];
