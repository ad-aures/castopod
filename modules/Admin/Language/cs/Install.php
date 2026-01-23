<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Ruční konfigurace',
    'manual_config_subtitle' =>
        'Vytvořte soubor `.env` s vaším nastavením a obnovte stránku pro pokračování instalace.',
    'form' => [
        'instance_config' => 'Konfigurace instance',
        'hostname' => 'Název hostitele',
        'media_base_url' => 'URL pro média',
        'media_base_url_hint' =>
            'Pokud používáte CDN a/nebo externí analytickou službu, můžete je nastavit zde.',
        'admin_gateway' => 'Administrační brána',
        'admin_gateway_hint' =>
            'Cesta pro přístup k administraci (např. https://example.com/cp-admin). Ve výchozím nastavení je nastaveno jako cp-admin, doporučujeme ji z bezpečnostních důvodů změnit.',
        'auth_gateway' => 'Ověřovací brána',
        'auth_gateway_hint' =>
            'Cesta pro přístup k ověřovacím stránkám (např. https://example.com/cp-auth). Ve výchozím nastavení je nastaveno jako cp-auth, doporučujeme ji z bezpečnostních důvodů změnit.',
        'database_config' => 'Konfigurace databáze',
        'database_config_hint' =>
            'Castopod se musí připojit k databázi MySQL (nebo MariaDB). Pokud nemáte tyto požadované informace, kontaktujte prosím správce serveru.',
        'db_hostname' => 'Název hostitele databáze',
        'db_name' => 'Název databáze',
        'db_username' => 'Uživatelské jméno databáze',
        'db_password' => 'Heslo k databázi',
        'db_prefix' => 'Předpona databáze',
        'db_prefix_hint' =>
            "Předpona Castopod tabulky, neměňte pokud nevíte, co to znamená.",
        'cache_config' => 'Nastavení mezipaměti',
        'cache_config_hint' =>
            'Vyberte preferovaného zpracovatele mezipaměti. Ponechte výchozí hodnotu, pokud nemáte přehled o tom, co to znamená.',
        'cache_handler' => 'Zpracovatel mezipaměti',
        'cacheHandlerOptions' => [
            'file' => 'Soubor',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Další',
        'submit' => 'Dokončit instalaci',
        'create_superadmin' => 'Vytvořte si svůj superadmin účet',
        'email' => 'Email',
        'username' => 'Uživatelské jméno',
        'password' => 'Heslo',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Váš superadmin účet byl úspěšně vytvořen. Přihlaste se a začněte s podcastem!',
        'databaseConnectError' =>
            'Castopod se nemohl připojit k databázi. Upravte konfiguraci databáze a zkuste to znovu.',
        'writeError' =>
            "Nelze vytvořit / zapsat soubor `.env`. Musíte jej vytvořit ručně podle šablony souboru `.env.example` v balíčku Castopod.",
    ],
];
