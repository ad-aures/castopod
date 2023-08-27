<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'ruta de navegación',
    config(Admin::class)
        ->gateway => 'Inicio',
    'podcasts' => 'podcasts',
    'episodes' => 'episodios',
    'subscriptions' => 'suscripciones',
    'contributors' => 'colaboradores',
    'pages' => 'páginas',
    'settings' => 'configuración',
    'theme' => 'tema',
    'about' => 'acerca de',
    'add' => 'añadir',
    'new' => 'nuevo',
    'edit' => 'editar',
    'persons' => 'personas',
    'publish' => 'publicar',
    'publish-edit' => 'editar publicación',
    'publish-date-edit' => 'editar fecha de publicación',
    'unpublish' => 'anular publicación',
    'delete' => 'borrar',
    'remove' => 'eliminar',
    'fediverse' => 'fediverso',
    'blocked-actors' => 'actores bloqueado',
    'blocked-domains' => 'dominios bloqueados',
    'users' => 'usuarios',
    'my-account' => 'mi cuenta',
    'change-password' => 'cambiar contraseña',
    'imports' => 'imports',
    'platforms' => 'plataformas',
    'social' => 'redes sociales',
    'funding' => 'financiación | fondos',
    'analytics' => 'estadísticas',
    'locations' => 'ubicaciones',
    'webpages' => 'páginas web',
    'unique-listeners' => 'oyentes únicos',
    'players' => 'reproductores',
    'listening-time' => 'tiempo de escucha',
    'time-periods' => 'periodos de tiempo',
    'soundbites' => 'fragmentos de sonido',
    'video-clips' => 'clips de vídeo',
    'embed' => 'reproductor embebido',
    'notifications' => 'notificaciones',
    'suspend' => 'suspender',
];
