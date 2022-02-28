<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Wpis {actorDisplayName}",
    'back_to_actor_posts' => 'Wróć do wpisów {actor}',
    'actor_shared' => '{actor} udostępnił',
    'reply_to' => 'Odpowiedz do @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Napisz wiadomość...',
        'episode_message_placeholder' => 'Napisz wiadomość do odcinka...',
        'episode_url_placeholder' => 'URL odcinka',
        'reply_to_placeholder' => 'Odpowiedz do @{actorUsername}',
        'submit' => 'Wyślij',
        'submit_reply' => 'Odpowiedz',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# ulubiony}
        other {Ulubionych: #}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# udostępnienie}
        other {Udostępnień: #}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# odpowiedź}
        other {Odpowiedzi: #}
    }',
    'expand' => 'Rozwiń wpis',
    'block_actor' => 'Zablokuj użytkownika @{actorUsername}',
    'block_domain' => 'Zablokuj domenę @{actorDomain}',
    'delete' => 'Usuń wpis',
];
