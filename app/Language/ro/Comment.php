<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Comentariul lui {actorDisplayName} pentru {episodeTitle}",
    'back_to_comments' => 'Înapoi la comentarii',
    'form' => [
        'episode_message_placeholder' => 'Scrieți un comentariu…',
        'reply_to_placeholder' => 'Răspundeți lui @{actorUsername}',
        'submit' => 'Trimiteți',
        'submit_reply' => 'Răspundeți',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# apreciere}
        other {# aprecieri}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# răspuns}
        few {# răspunsuri}
        other {# răspunsuri}
    }',
    'like' => 'Apreciază',
    'reply' => 'Răspundeți',
    'view_replies' => 'Vizualizați răspunsurile ({numberOfReplies})',
    'block_actor' => 'Blocați utilizatorul @{actorUsername}',
    'block_domain' => 'Blocați domeniul @{actorDomain}',
    'delete' => 'Ștergeți comentariul',
];
