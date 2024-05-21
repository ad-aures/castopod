<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Instalator Castopoda',
    'manual_config' => 'Ručna konfiguracija',
    'manual_config_subtitle' =>
        'Napravite `.env` datoteku sa vašim podešavanjima i osvežite stranicu da bi ste nastavili instalaciju.',
    'form' => [
        'instance_config' => 'Konfiguracija instance',
        'hostname' => 'Ime domaćina',
        'media_base_url' => 'URL medijske baze',
        'media_base_url_hint' =>
            'Ako koristite CDN i/ili eksternu uslugu za analitiku, možete ih postaviti ovde.',
        'admin_gateway' => 'Administratorski izlaz',
        'admin_gateway_hint' =>
            'Ruta za pristup kontrolnoj tabli administratora (eg. https://example.com/cp-admin).Podrazumevano je podešena na cp-admin, preporučujemo da je promenite iz sigurnosnih razloga.',
        'auth_gateway' => 'Auth izlaz',
        'auth_gateway_hint' =>
            'Ruta za pristup stranicama za potvrdu identiteta (eg. https://example.com/cp-auth).Podrazumevano je podešena na cp-auth, preporučujemo da je promenite iz sigurnosnih razloga.',
        'database_config' => 'Konfiguracija baze podataka',
        'database_config_hint' =>
            'Castopod mora da se poveže za vašom MySQL (ili MariaDB) bazom. Ukoliko ne posedujete potrebne informacije, molimo vas kontaktirajte administratora vašeg servera.',
        'db_hostname' => 'Ime hosta baze podataka',
        'db_name' => 'Ime baze podataka',
        'db_username' => 'Korisničko ime baze podataka',
        'db_password' => 'Lozinka baze podataka',
        'db_prefix' => 'Prefiks baze',
        'db_prefix_hint' =>
            "Prefiks imena tabela Castopod-a, ne diraj ako ne znaš šta znači.",
        'cache_config' => 'Konfiguracija keša',
        'cache_config_hint' =>
            'Izaberite željeni obrađivač keša. Ostavite je kao podrazumevanu vrednost ako nemate pojma šta to znači.',
        'cache_handler' => 'Obrađivač keša',
        'cacheHandlerOptions' => [
            'file' => 'Datoteka',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Sledeće',
        'submit' => 'Završi instalaciju',
        'create_superadmin' => 'Kreiraj svoj nalog super administratora',
        'email' => 'E-pošta',
        'username' => 'Korisničko ime',
        'password' => 'Lozinka',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Vaš nalog superadmina je uspešno kreiran. Prijavite se da biste započeli podkasting!',
        'databaseConnectError' =>
            'Castopod nije mogao da se poveže sa vašom bazom podataka. Uredite konfiguraciju baze podataka i pokušajte ponovo.',
        'writeError' =>
            "Nije moguće kreirati/upisati datoteku `.env`. Morate je kreirati ručno prateći šablon datoteke `.env.example` u Castopod-ovom paketu.",
    ],
];
