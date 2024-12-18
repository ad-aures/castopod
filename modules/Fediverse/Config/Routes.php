<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/** @var RouteCollection $routes */

$routes->addPlaceholder('actorUsername', '[a-zA-Z0-9\_]{1,32}');
$routes->addPlaceholder(
    'uuid',
    '[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-4[0-9A-Fa-f]{3}-[89ABab][0-9A-Fa-f]{3}-[0-9A-Fa-f]{12}',
);
$routes->addPlaceholder('postAction', '\bfavourite|\breblog|\breply');

/**
 * Fediverse routes file
 */

$routes->group('', [
    'namespace' => 'Modules\Fediverse\Controllers',
], static function ($routes): void {
    // webfinger
    $routes->get('.well-known/webfinger', 'WebFingerController', [
        'as' => 'webfinger',
    ]);
    // nodeInfo2
    $routes->get('.well-known/x-nodeinfo2', 'NodeInfo2Controller', [
        'as' => 'nodeInfo2',
    ]);
    // Actor
    $routes->group('@(:actorUsername)', static function ($routes): void {
        // Actor
        $routes->get('/', 'ActorController::index/$1', [
            'as' => 'actor',
        ]);
        $routes->post('inbox', 'ActorController::inbox/$1', [
            'as'     => 'inbox',
            'filter' => 'fediverse:verify-activitystream,verify-blocks,verify-signature',
        ]);
        $routes->get('outbox', 'ActorController::outbox/$1', [
            'as'     => 'outbox',
            'filter' => 'fediverse:verify-activitystream',
        ]);
        $routes->get('followers', 'ActorController::followers/$1', [
            'as'     => 'followers',
            'filter' => 'fediverse::activity-stream',
        ]);
        $routes->post('follow', 'ActorController::followAction/$1', [
            'as' => 'attempt-follow',
        ]);
        $routes->get('activities/(:uuid)', 'ActorController::activity/$1/$2', [
            'as' => 'activity',
        ]);
    });
    // Post
    $routes->post('posts/create', 'PostController::createAction/$1', [
        'as' => 'post-attempt-create',
    ]);
    $routes->get('posts/(:uuid)', 'PostController::index/$1', [
        'as' => 'post',
    ]);
    $routes->get('posts/(:uuid)/replies', 'PostController::index/$1', [
        'as' => 'post-replies',
    ]);
    $routes->post(
        'posts/(:uuid)/remote/(:postAction)',
        'PostController::remoteActionAction/$1/$2/$3',
        [
            'as' => 'post-attempt-remote-action',
        ],
    );
    // Blocking actors and domains
    $routes->post(
        'fediverse-block-actor',
        'BlockController::blockActorAction',
        [
            'as' => 'fediverse-attempt-block-actor',
        ],
    );
    $routes->post(
        'fediverse-block-domain',
        'BlockController::blockDomainAction',
        [
            'as' => 'fediverse-attempt-block-domain',
        ],
    );
    $routes->post(
        'fediverse-unblock-actor',
        'BlockController::unblockActorAction',
        [
            'as' => 'fediverse-attempt-unblock-actor',
        ],
    );
    $routes->post(
        'fediverse-unblock-domain',
        'BlockController::unblockDomainAction',
        [
            'as' => 'fediverse-attempt-unblock-domain',
        ],
    );
    $routes->cli('scheduled-activities', 'SchedulerController::activity');
});
