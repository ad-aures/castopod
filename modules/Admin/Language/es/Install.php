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
        'Crea un archivo `.env` con tus ajustes y actualiza la página para continuar la instalación.',
    'form' => [
        'instance_config' => 'Configuración de instancia',
        'hostname' => 'Nombre de host',
        'media_base_url' => 'URL del reproductor de medios',
        'media_base_url_hint' =>
            'Si utiliza un CDN y/o un servicio de análisis externo, puede establecerlo aquí.',
        'admin_gateway' => 'Pasarela de administración',
        'admin_gateway_hint' =>
            'La ruta para acceder al área de administración (por ejemplo, https://example.com/cp-admin). Se establece por defecto como cp-admin, le recomendamos que lo cambie por razones de seguridad.',
        'auth_gateway' => 'Pasarela de autenticación',
        'auth_gateway_hint' =>
            'La ruta para acceder al área de administración (por ejemplo, https://example.com/cp-auth). Se establece por defecto como cp-admin, le recomendamos que lo cambie por razones de seguridad.',
        'database_config' => 'Configuración de la base de datos',
        'database_config_hint' =>
            'Castopod necesita conectarse a su base de datos MySQL (o MariaDB). Si no tiene esta información requerida, póngase en contacto con el administrador de su servidor.',
        'db_hostname' => 'Nombre de host de la base de datos',
        'db_name' => 'Nombre de la base de datos',
        'db_username' => 'Usuario la de base de datos',
        'db_password' => 'Contraseña de la base de datos',
        'db_prefix' => 'Prefijo de la base de datos',
        'db_prefix_hint' =>
            "El prefijo de los nombres de la tabla de Castopod, déjalo como aparece si no sabes lo que significa.",
        'cache_config' => 'Configuración de caché',
        'cache_config_hint' =>
            'Elija su gestor de caché preferido. Déjelo como el valor predeterminado si no tiene ni idea de lo que significa.',
        'cache_handler' => 'Gestor de cache',
        'cacheHandlerOptions' => [
            'file' => 'Archivo',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Siguiente',
        'submit' => 'Finalizar la instalación',
        'create_superadmin' => 'Crear la cuenta de administración',
        'email' => 'Correo electrónico',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Tu cuenta de superadmin se ha creado correctamente. ¡Inicia sesión para empezar a hacer podcasting!',
        'databaseConnectError' =>
            'Castopod no pudo conectarse a su base de datos. Edite la configuración de la base de datos y vuelva a intentarlo.',
        'writeError' =>
            "No se pudo crear/escribir el archivo `.env`. Debes crearlo manualmente siguiendo la plantilla de archivo `.env.example` en el paquete Castopod.",
    ],
];
