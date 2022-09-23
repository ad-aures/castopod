<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Configuración manual',
    'manual_config_subtitle' =>
        'Crear un ficheiro `.env` cos teus axustes e actualizar a páxina para continuar coa instalación.',
    'form' => [
        'instance_config' => 'Configuración da instancia',
        'hostname' => 'Servidor',
        'media_base_url' => 'URL base do multimedia',
        'media_base_url_hint' =>
            'Se usas unha CDN e/ou un servizo externo de análise, debes indicalo aquí.',
        'admin_gateway' => 'Pasarela de administración',
        'admin_gateway_hint' =>
            'A ruta para acceder á área de administración (ex. https://exemplo.com/cp-admin). Por defecto establécese cp-admin, recomendámosche cambialo por razóns de seguridade.',
        'auth_gateway' => 'Pasarela de autenticación',
        'auth_gateway_hint' =>
            'A ruta para acceder á páxina de autenticación (ex. https://exemplo.com/cp-auth). Por defecto establécese como cp-auth, pero recomendámosche cambialo por razóns de seguridade.',
        'database_config' => 'Configuración da base de datos',
        'database_config_hint' =>
            'Castopod precisa conectar coa túa base de datos MySQL (ou MariaDB). Se non tes esta información, contacta coa administración do teu servidor.',
        'db_hostname' => 'Servidor da base de datos',
        'db_name' => 'Nome da base de datos',
        'db_username' => 'Usuaria da base de datos',
        'db_password' => 'Contrasinal da base de datos',
        'db_prefix' => 'Prefix da base de datos',
        'db_prefix_hint' =>
            "O prefix dos nomes das táboas Castopod, déixao como está se non sabes o significa.",
        'cache_config' => 'Configuración da caché',
        'cache_config_hint' =>
            'Elixe o xestor da caché preferido. Deixa o valor por defecto se non sabes o que significa.',
        'cache_handler' => 'Xestor da cache',
        'cacheHandlerOptions' => [
            'file' => 'Ficheiro',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Seguinte',
        'submit' => 'Rematar instalación',
        'create_superadmin' => 'Crea a conta de superadministración',
        'email' => 'Email',
        'username' => 'Identificador',
        'password' => 'Contrasinal',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'A conta de superadministración creouse correctamente. Accede para comezar a publicar!',
        'databaseConnectError' =>
            'Castopod non pode conectar coa base de datos. Edita a configuración da base de datos e inténtao outra vez.',
        'writeError' =>
            "Non se puido crear/escribir o ficheiro `.env`. Tes que crealo manualmente seguindo o modelo `.env.example` incluído no paquete Castopod.",
    ],
];
