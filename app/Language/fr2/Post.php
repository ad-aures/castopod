<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Publication de {actorDisplayName}",
    'back_to_actor_posts' => 'Retour aux publications de {actor}',
    'actor_shared' => '{actor} a partagé',
    'reply_to' => 'Répondre à @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Écrivez votre message…',
        'episode_message_placeholder' => 'Écrivez votre message pour l’épisode…',
        'episode_url_placeholder' => 'URL de l’épisode',
        'reply_to_placeholder' => 'Répondre à @{actorUsername}',
        'submit' => 'Envoyer ',
        'submit_reply' => 'Répondre',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favori}
        other {# favoris}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# partage}
        other {# partages}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# réponse}
        other {# réponses}
    }',
    'expand' => 'Étendre la publication',
    'block_actor' => 'Bloquer l’utilisateur @{actorUsername}',
    'block_domain' => 'Bloquer le domaine @{actorDomain}',
    'delete' => 'Supprimer la publication',
];
