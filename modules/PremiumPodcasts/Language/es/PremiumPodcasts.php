<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => 'Podcast contiene episodios premium',
    'episode_is_premium' => 'El episodio es premium, sólo disponible para los suscriptores premium',
    'unlock_episode' => 'Este episodio es sólo para suscriptores premium. ¡Haz clic para desbloquearlo!',
    'banner_unlock' => 'Este podcast contiene episodios premium, sólo disponible para los suscriptores premium.',
    'banner_lock' => 'Podcast desbloqueado, ¡disfruta de los episodios premium!',
    'subscribe' => 'Suscríbete',
    'lock' => 'Bloquear',
    'unlock' => 'Desbloquear',
    'unlock_form' => [
        'title' => 'Contenido premium',
        'subtitle' => '¡Este podcast contiene episodios premium bloqueados! ¿Tienes la clave para desbloquearlos?',
        'token' => 'Introduzca su clave',
        'token_hint' => 'Si está suscrito a {podcastTitle}, puede copiar la clave que le fue enviada por correo electrónico y pegarla aquí.',
        'submit' => '¡Desbloquea todos los episodios!',
        'call_to_action' => 'Desbloquea todos los episodios de {podcastTitle}:',
        'subscribe_cta' => '¡Suscríbete ahora!',
    ],
    'messages' => [
        'unlockSuccess' => '¡Podcast desbloqueado con éxito! ¡Disfruta de los episodios premium!',
        'unlockBadAttempt' => 'Parece que tu clave no está funcionando…',
        'lockSuccess' => 'El Podcast fue bloqueado con éxito!',
    ],
];
