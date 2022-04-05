<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s Beitrag",
    'back_to_actor_posts' => "Zurück zu {actor}'s Beiträge",
    'actor_shared' => '{actor} teilte',
    'reply_to' => 'Antorten auf @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Scheibe eine Nachricht…',
        'episode_message_placeholder' => 'Schreibe eine Nachricht für die Folge…',
        'episode_url_placeholder' => 'URL der Folge',
        'reply_to_placeholder' => 'Antworten auf @{actorUsername}',
        'submit' => 'Senden',
        'submit_reply' => 'Antwort senden',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# Favorit}
        other {# Favoriten}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# mal geteilt}
        other {# mal geteilt}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# Antwort}
        other {# Antworten}
    }',
    'expand' => 'Mehr anzeigen',
    'block_actor' => '@{actorUsername} blockieren',
    'block_domain' => 'Domain @{actorDomain} blockieren',
    'delete' => 'Beitrag löschen',
];
