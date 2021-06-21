<?php

declare(strict_types=1);

namespace Config;

use App\Entities\Actor;
use App\Entities\Status;
use App\Entities\User;
use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

Events::on('pre_system', function () {
    // @phpstan-ignore-next-line
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(function ($buffer) {
            return $buffer;
        });
    }

    /*
     * --------------------------------------------------------------------
     * Debug Toolbar Listeners.
     * --------------------------------------------------------------------
     * If you delete, they will no longer be collected.
     *
     * @phpstan-ignore-next-line
     */
    if (CI_DEBUG && ! is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        Services::toolbar()->respond();
    }
});

Events::on('login', function (User $user): void {
    helper('auth');

    // set interact_as_actor_id value
    $userPodcasts = $user->podcasts;
    if ($userPodcasts = $user->podcasts) {
        set_interact_as_actor($userPodcasts[0]->actor_id);
    }
});

Events::on('logout', function (User $user): void {
    helper('auth');

    // remove user's interact_as_actor session
    remove_interact_as_actor();
});

/*
 * --------------------------------------------------------------------
 * ActivityPub events
 * --------------------------------------------------------------------
 */
/**
 * @param Actor $actor
 * @param Actor $targetActor
 */
Events::on('on_follow', function ($actor, $targetActor): void {
    if ($actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }

    if ($targetActor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$targetActor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$targetActor->podcast->id}*");
    }
});

/**
 * @param Actor $actor
 * @param Actor $targetActor
 */
Events::on('on_undo_follow', function ($actor, $targetActor): void {
    if ($actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }

    if ($targetActor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$targetActor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$targetActor->podcast->id}*");
    }
});

/**
 * @param Status $status
 */
Events::on('on_status_add', function ($status): void {
    if ($status->in_reply_to_id !== null) {
        $status = $status->reply_to_status;
    }

    if ($status->episode_id) {
        model('EpisodeModel')
            ->where('id', $status->episode_id)
            ->increment('statuses_total');
    }

    if ($status->actor->is_podcast) {
        // Removing all of the podcast pages is a bit overkill, but works to avoid caching bugs
        // same for other events below
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
    }
});

/**
 * @param Status $status
 */
Events::on('on_status_remove', function ($status): void {
    if ($status->in_reply_to_id !== null) {
        Events::trigger('on_status_remove', $status->reply_to_status);
    }

    if ($episodeId = $status->episode_id) {
        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('statuses_total', 1 + $status->reblogs_count);

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('reblogs_total', $status->reblogs_count);

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('favourites_total', $status->favourites_count);
    }

    if ($status->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_status#{$status->id}*");
});

/**
 * @param Actor $actor
 * @param Status $status
 */
Events::on('on_status_reblog', function ($actor, $status): void {
    if ($episodeId = $status->episode_id) {
        model('EpisodeModel')
            ->where('id', $episodeId)
            ->increment('reblogs_total');

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->increment('statuses_total');
    }

    if ($status->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
    }

    if ($actor->is_podcast) {
        cache()->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_status#{$status->id}*");

    if ($status->in_reply_to_id !== null) {
        cache()->deleteMatching("page_status#{$status->in_reply_to_id}");
    }
});

/**
 * @param Status $reblogStatus
 */
Events::on('on_status_undo_reblog', function ($reblogStatus): void {
    $status = $reblogStatus->reblog_of_status;
    if ($episodeId = $status->episode_id) {
        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('reblogs_total');

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('statuses_total');
    }

    if ($status->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_status#{$status->id}*");
    cache()
        ->deleteMatching("page_status#{$reblogStatus->id}*");

    if ($status->in_reply_to_id !== null) {
        cache()->deleteMatching("page_status#{$status->in_reply_to_id}");
    }

    if ($reblogStatus->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$reblogStatus->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$reblogStatus->actor->podcast->id}*");
    }
});

/**
 * @param Status $reply
 */
Events::on('on_status_reply', function ($reply): void {
    $status = $reply->reply_to_status;

    if ($status->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_status#{$status->id}*");
});

/**
 * @param Status $reply
 */
Events::on('on_reply_remove', function ($reply): void {
    $status = $reply->reply_to_status;

    if ($status->actor->is_podcast) {
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_status#{$status->id}*");
    cache()
        ->deleteMatching("page_status#{$reply->id}*");
});

/**
 * @param Actor $actor
 * @param Status $status
 */
Events::on('on_status_favourite', function ($actor, $status): void {
    if ($status->episode_id) {
        model('EpisodeModel')
            ->where('id', $status->episode_id)
            ->increment('favourites_total');
    }

    if ($status->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_status#{$status->id}*");

    if ($status->in_reply_to_id !== null) {
        cache()->deleteMatching("page_status#{$status->in_reply_to_id}*");
    }

    if ($actor->is_podcast) {
        cache()->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }
});

/**
 * @param Actor $actor
 * @param Status $status
 */
Events::on('on_status_undo_favourite', function ($actor, $status): void {
    if ($status->episode_id) {
        model('EpisodeModel')
            ->where('id', $status->episode_id)
            ->decrement('favourites_total');
    }

    if ($status->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$status->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$status->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_status#{$status->id}*");

    if ($status->in_reply_to_id !== null) {
        cache()->deleteMatching("page_status#{$status->in_reply_to_id}*");
    }

    if ($actor->is_podcast) {
        cache()->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }
});

Events::on('on_block_actor', function (int $actorId): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_status*');
});

Events::on('on_unblock_actor', function (int $actorId): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_status*');
});

Events::on('on_block_domain', function (string $domainName): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_status*');
});

Events::on('on_unblock_domain', function (string $domainName): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_status*');
});
