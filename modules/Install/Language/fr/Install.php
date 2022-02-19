<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Installeur Castopod',
    'manual_config' => 'Configuration manuelle',
    'manual_config_subtitle' =>
        'Créez un fichier `.env` qui contient tous vos paramètres puis rafraichissez la page pour continuer l’installation.',
    'form' => [
        'instance_config' => 'Paramètres de l’instance',
        'hostname' => 'Nom d’hôte',
        'media_base_url' => 'Adresse racine des médias',
        'media_base_url_hint' =>
            'Si vous utilisez un CDN et/ou un service de mesure d’audience externe, vous pouvez les définir ici.',
        'admin_gateway' => 'Adresse d’administration',
        'admin_gateway_hint' =>
            'Le chemin pour accéder à l’administration (par exemple https://example.com/cp-admin). Il est défini par défaut à cp-admin, nous vous recommandons de le changer par mesure de sécurité.',
        'auth_gateway' => 'Adresse d’authentification',
        'auth_gateway_hint' =>
            'Le chemin des pages d’authentication (par exemple https://example.fr/cp-auth). Il est défini par défaut à cp-auth, nous vous recommandons de le changer par mesure de sécurité.',
        'database_config' => 'Paramètres de base de données',
        'database_config_hint' =>
            'Castopod doit se connecter à votre base de données MySQL (ou MariaDB). Si vous ne disposez pas de ces informations, merci de contacter l’administrateur du serveur.',
        'db_hostname' => 'Nom d’hôte (ou IP) de la base de données',
        'db_name' => 'Nom de la base de données',
        'db_username' => 'Utilisateur de base de données',
        'db_password' => 'Mot de passe de base de données',
        'db_prefix' => 'Préfixe des tables',
        'db_prefix_hint' =>
            'Le préfixe des noms de tables de Castopod, laissez la valeur par défaut si vous ne savez pas de quoi il s’agit.',
        'cache_config' => 'Paramètres de cache',
        'cache_config_hint' =>
            'Sélectionnez votre gestionnaire de cache préféré. Laissez la valeur par défaut si vous ne savez pas de quoi il s’agit.',
        'cache_handler' => 'Gestionnaire de cache',
        'cacheHandlerOptions' => [
            'file' => 'Fichiers',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Suivant',
        'submit' => 'Terminer l’installation',
        'create_superadmin' => 'Créer un compte super-utilisateur',
        'email' => 'E-mail',
        'username' => 'Identifiant',
        'password' => 'Mot de passe',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Le compte super-utilisateur a bien été créé. Connectez-vous et commencez à podcaster !',
        'databaseConnectError' =>
            'Castopod n’a pas pu se connecter à la base de données. Modifier les paramètres de base de données et essayer à nouveau.',
        'writeError' =>
            'Impossible de créer/écrire le fichier `.env`. Créez manuellement un fichier `.env` en copiant le modèle `.env.example` fourni avec Castopod.',
    ],
];
