<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'Ruta de navegació',
    config(Admin::class)
        ->gateway => 'Inici',
    'podcasts' => 'podcasts',
    'episodes' => 'episodis',
    'subscriptions' => 'subscripcions',
    'contributors' => 'col·laboradors',
    'pages' => 'pàgines',
    'settings' => 'preferències',
    'theme' => 'tema',
    'about' => 'quant a',
    'add' => 'afegir',
    'new' => 'nova',
    'edit' => 'editar',
    'persons' => 'persones',
    'publish' => 'publicar',
    'publish-edit' => 'editar la publicació',
    'publish-date-edit' => 'edita la data de publicació',
    'unpublish' => 'desfer la publicació',
    'delete' => 'eliminar',
    'remove' => 'suprimeix',
    'fediverse' => 'Fediverse',
    'blocked-actors' => 'comptes bloquejats',
    'blocked-domains' => 'dominis bloquejats',
    'users' => 'usuaris',
    'my-account' => 'el meu compte',
    'change-password' => 'canviar la contrasenya',
    'imports' => 'imports',
    'platforms' => 'plataformes',
    'social' => 'xarxes socials',
    'funding' => 'financiació',
    'analytics' => 'estadístiques',
    'locations' => 'ubicacions',
    'webpages' => 'pàgines web',
    'unique-listeners' => 'oients únics',
    'players' => 'reproductors',
    'listening-time' => 'temps d\'escolta',
    'time-periods' => 'períodes de temps',
    'soundbites' => 'fragments d\'àudio',
    'video-clips' => 'vídeoclips',
    'embed' => 'reproductor incrustable',
    'notifications' => 'notificacions',
    'suspend' => 'suspèn',
];
