<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Evezhiadenn {actorDisplayName} evit {episodeTitle}",
    'back_to_comments' => 'Distreiñ d\'an evezhiadennoù',
    'form' => [
        'episode_message_placeholder' => 'Skrivañ un evezhiadenn…',
        'reply_to_placeholder' => 'Respont da @{actorUsername}',
        'submit' => 'Kas',
        'submit_reply' => 'Respont',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# muiañ-karet}
        2 {# vuiañ-karet}
        22 {# vuiañ-karet}
        32 {# vuiañ-karet}
        42 {# vuiañ-karet}
        52 {# vuiañ-karet}
        62 {# vuiañ-karet}
        82 {# vuiañ-karet}
        other {# muiañ-karet}
    }',
    'replies' => '{numberOfReplies, plural,
        0 {respont ebet}
        one {# respont}
        other {# respont}
    }',
    'like' => 'Muiañ-karet',
    'reply' => 'Respont',
    'view_replies' => 'Gwelet an evezhiadennoù ({numberOfReplies})',
    'block_actor' => 'Stankañ an implijer·ez @{actorUsername}',
    'block_domain' => 'Stankañ @{actorDomain}',
    'delete' => 'Dilemel an evezhiadenn',
];
