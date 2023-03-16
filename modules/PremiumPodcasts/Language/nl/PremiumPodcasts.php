<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => 'Podcast bevat premium afleveringen',
    'episode_is_premium' => 'Aflevering is premium, alleen beschikbaar voor premium abonnees',
    'unlock_episode' => 'Deze aflevering is alleen voor premium abonnees. Klik om te ontgrendelen!',
    'banner_unlock' => 'Deze podcast bevat premium afleveringen, alleen beschikbaar voor premium abonnees.',
    'banner_lock' => 'Podcast is ontgrendeld, geniet van de premium afleveringen!',
    'subscribe' => 'Abonneren',
    'lock' => 'Vergrendel',
    'unlock' => 'Ontgrendel',
    'unlock_form' => [
        'title' => 'Premium inhoud',
        'subtitle' => 'Deze podcast bevat vergrendelde premium afleveringen! Heb je de sleutel om ze te ontgrendelen?',
        'token' => 'Voer jouw sleutel in',
        'token_hint' => 'Als je geabonneerd bent op {podcastTitle}, kun je de sleutel die naar je verzonden is via e-mail kopiëren en deze hier plakken.',
        'submit' => 'Ontgrendel alle afleveringen!',
        'call_to_action' => 'Ontgrendel alle afleveringen van {podcastTitle}:',
        'subscribe_cta' => 'Nu abonneren!',
    ],
    'messages' => [
        'unlockSuccess' => 'Podcast is succesvol ontgrendeld! Geniet van de premium afleveringen!',
        'unlockBadAttempt' => 'Jouw sleutel lijkt niet te werken…',
        'lockSuccess' => 'Podcast is succesvol vergrendeld!',
    ],
];
