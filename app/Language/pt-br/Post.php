<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Publicação de {actorDisplayName}",
    'back_to_actor_posts' => 'Voltar para publicações de {actor}',
    'actor_shared' => '{actor} compartilhou',
    'reply_to' => 'Responder a @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Escreva uma mensagem…',
        'episode_message_placeholder' => 'Escreva uma mensagem para o episódio…',
        'episode_url_placeholder' => 'URL do episódio',
        'reply_to_placeholder' => 'Responder a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Responder',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favorito}
        other {# favoritos}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# compartilhamento}
        other {# compartilhamentos}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# resposta}
        other {# respostas}
    }',
    'expand' => 'Expandir publicação',
    'block_actor' => 'Bloquear usuário @{actorUsername}',
    'block_domain' => 'Bloquear domínio @{actorDomain}',
    'delete' => 'Excluir publicação',
];
