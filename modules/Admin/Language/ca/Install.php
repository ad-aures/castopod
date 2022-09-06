<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Configuració manual',
    'manual_config_subtitle' =>
        'Creeu un fitxer `.env` amb la vostra configuració i actualitzeu la pàgina per continuar amb la instal·lació.',
    'form' => [
        'instance_config' => 'Configuració de la instància',
        'hostname' => 'Nom del servidor (hostname)',
        'media_base_url' => 'URL de base pel multimèdia',
        'media_base_url_hint' =>
            'Si utilitzeu un CDN i/o un servei d\'anàlisi de tràfic extern, podeu configurar-los aquí.',
        'admin_gateway' => 'Configurar la porta d\'enllaç (gateway)',
        'admin_gateway_hint' =>
            'La ruta per accedir a l\'àrea d\'administració (p. ex., https://exemple.com/cp-admin). Està configurat per defecte com a cp-admin, us recomanem que el canvieu per motius de seguretat.',
        'auth_gateway' => 'Autenticació a la porta d\'enllaç',
        'auth_gateway_hint' =>
            'La ruta per accedir a les pàgines d\'autenticació (p. ex. https://exemple.com/cp-auth). Està configurada per defecte com a cp-auth, us recomanem que el canvieu per motius de seguretat.',
        'database_config' => 'Configuració de la Base de Dades',
        'database_config_hint' =>
            'Castopod s\'ha de connectar a la vostra base de dades MySQL (o MariaDB). Si no teniu aquesta informació necessària, poseu-vos en contacte amb l\'administrador del vostre servidor.',
        'db_hostname' => 'Nom del servidor (host) de la base de dades',
        'db_name' => 'Nom de la base de dades',
        'db_username' => 'Usuari de la base de dades',
        'db_password' => 'Contrasenya de la base de dades',
        'db_prefix' => 'Prefix de la base de dades',
        'db_prefix_hint' =>
            "El prefix emprat als noms de les taules de Castopod, deixeu-lo com està si no sabeu què significa.",
        'cache_config' => 'Configuració de la memòria cau',
        'cache_config_hint' =>
            'Trieu el vostre gestor de memòria cau preferit. Deixeu-lo com a valor predeterminat si no teniu ni idea del que significa.',
        'cache_handler' => 'Gestor de memòria cau',
        'cacheHandlerOptions' => [
            'file' => 'Fitxer',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Següent',
        'submit' => 'Finalitzar la instal·lació',
        'create_superadmin' => 'Crear el vostre compte de super-usuari',
        'email' => 'Correu electrònic',
        'username' => 'Nom de l\'usuari',
        'password' => 'Contrasenya',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'El vostre compte de superadministrador s\'ha creat correctament. Inicieu sessió per començar a fer podcasts!',
        'databaseConnectError' =>
            'Castopod no s\'ha pogut connectar a la vostra base de dades. Editeu la configuració de la vostra base de dades i torneu-ho a provar.',
        'writeError' =>
            "No s'ha pogut crear/escriure el fitxer `.env`. Heu de crear-lo manualment seguint la plantilla de fitxer `.env.example` del paquet Castopod.",
    ],
];
