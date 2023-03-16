<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Configuration manuelle',
    'manual_config_subtitle' =>
        'Créez un fichier `.env` qui contient tous vos paramètres puis rafraîchissez la page pour continuer l’installation.',
    'form' => [
        'instance_config' => 'Paramètres de l’instance',
        'hostname' => 'Nom d’hôte',
        'media_base_url' => 'Adresse racine des médias',
        'media_base_url_hint' =>
            'Si vous utilisez un CDN et/ou un service de mesure d’audience externe, vous pouvez les définir ici.',
        'admin_gateway' => 'Adresse d’administration',
        'admin_gateway_hint' =>
            'Chemin pour accéder à l’administration (par exemple https://example.com/cp-admin). Il est défini par défaut à cp-admin, nous vous recommandons de le changer par mesure de sécurité.',
        'auth_gateway' => 'Adresse d’authentification',
        'auth_gateway_hint' =>
            'Le chemin des pages d’authentication (par exemple https://example.fr/cp-auth). Il est défini par défaut à cp-auth, nous vous recommandons de le changer par mesure de sécurité.',
        'database_config' => 'Paramètres de la base de données',
        'database_config_hint' =>
            'Castopod doit se connecter à votre base de données MySQL (ou MariaDB). Si vous ne disposez pas de ces informations, merci de contacter l’administrateur du serveur.',
        'db_hostname' => 'Nom d’hôte (ou IP) de la base de données',
        'db_name' => 'Nom de la base de données',
        'db_username' => 'Utilisateur de la base de données',
        'db_password' => 'Mot de passe de la base de données',
        'db_prefix' => 'Préfixe des tables',
        'db_prefix_hint' =>
            "Le préfixe des noms de tables de Castopod, laissez la valeur par défaut si vous ne savez pas de quoi il s’agit.",
        'cache_config' => 'Paramètres du cache',
        'cache_config_hint' =>
            'Sélectionnez votre gestionnaire de cache préféré. Laissez la valeur par défaut si vous ne savez pas de quoi il s’agit.',
        'cache_handler' => 'Gestionnaire de cache',
        'cacheHandlerOptions' => [
            'file' => 'Fichier',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Suivant',
        'submit' => 'Terminer l’installation',
        'create_superadmin' => 'Create your superadmin account',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Your superadmin account has been created successfully. Login to start podcasting!',
        'databaseConnectError' =>
            'Castopod could not connect to your database. Edit your database configuration and try again.',
        'writeError' =>
            "Couldn't create/write the `.env` file. You must create it manually by following the `.env.example` file template in the Castopod package.",
    ],
];
