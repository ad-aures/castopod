<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => 'O Podcast contém episódios premium',
    'episode_is_premium' => 'Episódio é premium, somente disponível para assinantes premium',
    'unlock_episode' => 'Este episódio é apenas para assinantes premium. Clique para desbloqueá-lo!',
    'banner_unlock' => 'Este podcast contém episódios premium, somente disponível para assinantes premium.',
    'banner_lock' => 'O Podcast desbloqueado, aproveite os episódios premium!',
    'subscribe' => 'Inscrever-se',
    'lock' => 'Bloquear',
    'unlock' => 'Desbloquear',
    'unlock_form' => [
        'title' => 'Conteúdo premium',
        'subtitle' => 'Este podcast contém episódios premium bloqueados! Você tem a chave para desbloqueá-los?',
        'token' => 'Digite sua chave',
        'token_hint' => 'Se você se inscreveu no {podcastTitle}, você pode copiar a chave que foi enviada por email e colá-la aqui.',
        'submit' => 'Desbloquear todos os episódios!',
        'call_to_action' => 'Desbloquear todos os episódios de {podcastTitle}:',
        'subscribe_cta' => 'Inscreva-se agora!',
    ],
    'messages' => [
        'unlockSuccess' => 'Podcast foi desbloqueado com sucesso! Aproveite os episódios premium!',
        'unlockBadAttempt' => 'Sua chave parece não estar funcionando…',
        'lockSuccess' => 'Podcast foi trancado com sucesso!',
    ],
];
