<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Commentaire de {actorDisplayName} pour {episodeTitle}",
    'back_to_comments' => 'Retour à la liste des commentaires',
    'form' => [
        'episode_message_placeholder' => 'Écrire un commentaire…',
        'reply_to_placeholder' => 'Répondre à @{actorUsername}',
        'submit' => 'Envoyer',
        'submit_reply' => 'Répondre',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# "j\'aime"}
        other {# "j\'aime"}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# réponse}
        other {# réponses}
    }',
    'like' => 'J’aime',
    'reply' => 'Répondre',
    'view_replies' => 'Voir les réponses ({numberOfReplies})',
    'block_actor' => 'Bloquer l’utilisateur @{actorUsername}',
    'block_domain' => 'Bloquer le domaine @{actorDomain}',
    'delete' => 'Supprimer le commentaire',
];
