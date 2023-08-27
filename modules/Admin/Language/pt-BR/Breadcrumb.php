<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'breadcrumb',
    config(Admin::class)
        ->gateway => 'Início',
    'podcasts' => 'podcasts',
    'episodes' => 'episódios',
    'subscriptions' => 'assinaturas',
    'contributors' => 'contribuidores',
    'pages' => 'páginas',
    'settings' => 'configurações',
    'theme' => 'tema',
    'about' => 'sobre',
    'add' => 'adicionar',
    'new' => 'novo',
    'edit' => 'editar',
    'persons' => 'pessoas',
    'publish' => 'publicar',
    'publish-edit' => 'editar publicação',
    'publish-date-edit' => 'editar data de publicação',
    'unpublish' => 'despublicar',
    'delete' => 'excluir',
    'remove' => 'remover',
    'fediverse' => 'fediverso',
    'blocked-actors' => 'atores bloqueados',
    'blocked-domains' => 'domínios bloqueados',
    'users' => 'usuários',
    'my-account' => 'minha conta',
    'change-password' => 'alterar senha',
    'imports' => 'importações',
    'platforms' => 'plataformas',
    'social' => 'redes sociais',
    'funding' => 'financiamento',
    'analytics' => 'estatísticas',
    'locations' => 'localizações',
    'webpages' => 'páginas da web',
    'unique-listeners' => 'ouvintes únicos',
    'players' => 'players',
    'listening-time' => 'tempo de escuta',
    'time-periods' => 'períodos de tempo',
    'soundbites' => 'clipes de áudio',
    'video-clips' => 'clipes de vídeo',
    'embed' => 'player incorporável',
    'notifications' => 'notificações',
    'suspend' => 'suspender',
];
