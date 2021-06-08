<?php

declare(strict_types=1);

namespace Config;

use App\Entities\Actor;
use App\Entities\Note;
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
 * @param Note $note
 */
Events::on('on_note_add', function ($note): void {
    if ($note->is_reply) {
        $note = $note->reply_to_note;
    }

    if ($note->episode_id) {
        model('EpisodeModel')
            ->where('id', $note->episode_id)
            ->increment('notes_total');
    }

    if ($note->actor->is_podcast) {
        // Removing all of the podcast pages is a bit overkill, but works to avoid caching bugs
        // same for other events below
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
    }
});

/**
 * @param Note $note
 */
Events::on('on_note_remove', function ($note): void {
    if ($note->is_reply) {
        Events::trigger('on_note_remove', $note->reply_to_note);
    }

    if ($episodeId = $note->episode_id) {
        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('notes_total', 1 + $note->reblogs_count);

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('reblogs_total', $note->reblogs_count);

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('favourites_total', $note->favourites_count);
    }

    if ($note->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_note#{$note->id}*");
});

/**
 * @param Actor $actor
 * @param Note $note
 */
Events::on('on_note_reblog', function ($actor, $note): void {
    if ($episodeId = $note->episode_id) {
        model('EpisodeModel')
            ->where('id', $episodeId)
            ->increment('reblogs_total');

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->increment('notes_total');
    }

    if ($note->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
    }

    if ($actor->is_podcast) {
        cache()->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_note#{$note->id}*");

    if ($note->is_reply) {
        cache()->deleteMatching("page_note#{$note->in_reply_to_id}");
    }
});

/**
 * @param Note $reblogNote
 */
Events::on('on_note_undo_reblog', function ($reblogNote): void {
    $note = $reblogNote->reblog_of_note;
    if ($episodeId = $note->episode_id) {
        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('reblogs_total');

        model('EpisodeModel')
            ->where('id', $episodeId)
            ->decrement('notes_total');
    }

    if ($note->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_note#{$note->id}*");
    cache()
        ->deleteMatching("page_note#{$reblogNote->id}*");

    if ($note->is_reply) {
        cache()->deleteMatching("page_note#{$note->in_reply_to_id}");
    }

    if ($reblogNote->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$reblogNote->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$reblogNote->actor->podcast->id}*");
    }
});

/**
 * @param Note $reply
 */
Events::on('on_note_reply', function ($reply): void {
    $note = $reply->reply_to_note;

    if ($note->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_note#{$note->id}*");
});

/**
 * @param Note $reply
 */
Events::on('on_reply_remove', function ($reply): void {
    $note = $reply->reply_to_note;

    if ($note->actor->is_podcast) {
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_note#{$note->id}*");
    cache()
        ->deleteMatching("page_note#{$reply->id}*");
});

/**
 * @param Actor $actor
 * @param Note $note
 */
Events::on('on_note_favourite', function ($actor, $note): void {
    if ($note->episode_id) {
        model('EpisodeModel')
            ->where('id', $note->episode_id)
            ->increment('favourites_total');
    }

    if ($note->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_note#{$note->id}*");

    if ($note->is_reply) {
        cache()->deleteMatching("page_note#{$note->in_reply_to_id}*");
    }

    if ($actor->is_podcast) {
        cache()->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }
});

/**
 * @param Actor $actor
 * @param Note $note
 */
Events::on('on_note_undo_favourite', function ($actor, $note): void {
    if ($note->episode_id) {
        model('EpisodeModel')
            ->where('id', $note->episode_id)
            ->decrement('favourites_total');
    }

    if ($note->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$note->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$note->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_note#{$note->id}*");

    if ($note->is_reply) {
        cache()->deleteMatching("page_note#{$note->in_reply_to_id}*");
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
        ->deleteMatching('page_note*');
});

Events::on('on_unblock_actor', function (int $actorId): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_note*');
});

Events::on('on_block_domain', function (string $domainName): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_note*');
});

Events::on('on_unblock_domain', function (string $domainName): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_note*');
});
