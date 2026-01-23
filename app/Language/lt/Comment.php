<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} pakomentavo „{episodeTitle}“",
    'back_to_comments' => 'Grįžti į komentarus',
    'form' => [
        'episode_message_placeholder' => 'Parašyti komentarą…',
        'reply_to_placeholder' => 'Atsakyti @{actorUsername}',
        'submit' => 'Siųsti',
        'submit_reply' => 'Atsakyti',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# patiktukas}
        few {# patiktukai}
        other {# patiktukų}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# atsakymas}
        few {# atsakymai}
        other {# atsakymų}
    }',
    'like' => 'Patinka',
    'reply' => 'Atsakyti',
    'view_replies' => 'Rodyti atsakymus ({numberOfReplies})',
    'block_actor' => 'Blokuoti naudotoją @{actorUsername}',
    'block_domain' => 'Blokuoti domeną @{actorDomain}',
    'delete' => 'Šalinti komentarą',
];
