<?php

declare(strict_types=1);

namespace Config;

use App\Entities\Actor;
use App\Entities\Post;
use App\Models\EpisodeModel;
use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;
use Modules\Auth\Entities\User;

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

        ob_start(static fn ($buffer) => $buffer);
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
 * Fediverse events
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
 * @param Post $post
 */
Events::on('on_post_add', function ($post): void {
    $isReply = $post->in_reply_to_id !== null;

    if ($isReply) {
        $post = $post->reply_to_post;
    }

    if ($post->episode_id !== null) {
        if ($isReply) {
            model(EpisodeModel::class, false)->builder()
                ->where('id', $post->episode_id)
                ->increment('comments_count');
        } else {
            model(EpisodeModel::class, false)->builder()
                ->where('id', $post->episode_id)
                ->increment('posts_count');
        }
    }

    if ($post->actor->is_podcast) {
        // Removing all of the podcast pages is a bit overkill, but works to avoid caching bugs
        // same for other events below
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
    }
});

/**
 * @param Post $post
 */
Events::on('on_post_remove', function ($post): void {
    if ($post->in_reply_to_id !== null) {
        Events::trigger('on_post_remove', $post->reply_to_post);
    }

    if ($episodeId = $post->episode_id) {
        model(EpisodeModel::class, false)->builder()
            ->where('id', $episodeId)
            ->decrement('posts_count');
    }

    if ($post->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_post#{$post->id}*");
});

/**
 * @param Actor $actor
 * @param Post $post
 */
Events::on('on_post_reblog', function ($actor, $post): void {
    if ($post->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
    }

    if ($actor->is_podcast) {
        cache()->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_post#{$post->id}*");

    if ($post->in_reply_to_id !== null) {
        cache()->deleteMatching("page_post#{$post->in_reply_to_id}");
    }
});

/**
 * @param Post $reblogPost
 */
Events::on('on_post_undo_reblog', function ($reblogPost): void {
    $post = $reblogPost->reblog_of_post;

    if ($post->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_post#{$post->id}*");
    cache()
        ->deleteMatching("page_post#{$reblogPost->id}*");

    if ($post->in_reply_to_id !== null) {
        cache()->deleteMatching("page_post#{$post->in_reply_to_id}");
    }

    if ($reblogPost->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$reblogPost->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$reblogPost->actor->podcast->id}*");
    }
});

/**
 * @param Post $reply
 */
Events::on('on_post_reply', function ($reply): void {
    $post = $reply->reply_to_post;

    if ($post->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_post#{$post->id}*");
});

/**
 * @param Post $reply
 */
Events::on('on_reply_remove', function ($reply): void {
    $post = $reply->reply_to_post;

    if ($post->actor->is_podcast) {
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_post#{$post->id}*");
    cache()
        ->deleteMatching("page_post#{$reply->id}*");
});

/**
 * @param Actor $actor
 * @param Post $post
 */
Events::on('on_post_favourite', function ($actor, $post): void {
    if ($post->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_post#{$post->id}*");

    if ($post->in_reply_to_id !== null) {
        cache()->deleteMatching("page_post#{$post->in_reply_to_id}*");
    }

    if ($actor->is_podcast) {
        cache()->deleteMatching("podcast#{$actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$actor->podcast->id}*");
    }
});

/**
 * @param Actor $actor
 * @param Post $post
 */
Events::on('on_post_undo_favourite', function ($actor, $post): void {
    if ($post->actor->is_podcast) {
        cache()
            ->deleteMatching("podcast#{$post->actor->podcast->id}*");
        cache()
            ->deleteMatching("page_podcast#{$post->actor->podcast->id}*");
    }

    cache()
        ->deleteMatching("page_post#{$post->id}*");

    if ($post->in_reply_to_id !== null) {
        cache()->deleteMatching("page_post#{$post->in_reply_to_id}*");
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
        ->deleteMatching('page_post*');
});

Events::on('on_unblock_actor', function (int $actorId): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_post*');
});

Events::on('on_block_domain', function (string $domainName): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_post*');
});

Events::on('on_unblock_domain', function (string $domainName): void {
    cache()->deleteMatching('page_podcast*');
    cache()
        ->deleteMatching('podcast*');
    cache()
        ->deleteMatching('page_post*');
});
