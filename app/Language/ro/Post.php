<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Postarea lui {actorDisplayName}",
    'back_to_actor_posts' => 'Înapoi la postările lui {actor}',
    'actor_shared' => '{actor} a distribuit',
    'reply_to' => 'Răspundeți lui @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Scrie un mesaj...',
        'episode_message_placeholder' => 'Scrie un mesaj pentru episodul…',
        'episode_url_placeholder' => 'URL episod',
        'reply_to_placeholder' => 'Răspundeți lui @{actorUsername}',
        'submit' => 'Trimiteți',
        'submit_reply' => 'Răspundeți',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favorit}
        other {# favoriți}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# distribuire}
        other {# distribuiri}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# răspuns}
        other {# răspunsuri}
    }',
    'expand' => 'Expandați postarea',
    'block_actor' => 'Blocați utilizatorul @{actorUsername}',
    'block_domain' => 'Blocați domeniul @{actorDomain}',
    'delete' => 'Șterge postarea',
];
