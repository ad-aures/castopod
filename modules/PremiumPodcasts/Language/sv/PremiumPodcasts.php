<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => 'Podcast innehåller premium avsnitt',
    'episode_is_premium' => 'Avsnitt är premium, endast tillgängligt för premium-prenumeranter',
    'unlock_episode' => 'Denna episod är endast för premiumprenumeranter. Klicka för att låsa upp den!',
    'banner_unlock' => 'Denna podcast innehåller premiumavsnitt som endast är tillgängliga för premiumprenumeranter.',
    'banner_lock' => 'Podcast är olåst, njut av premiumavsnitt!',
    'subscribe' => 'Prenumerera',
    'lock' => 'Lås',
    'unlock' => 'Lås upp',
    'unlock_form' => [
        'title' => 'Premium-innehåll',
        'subtitle' => 'Denna podcast innehåller låsta premium-avsnitt! Har du nyckeln för att låsa upp dem?',
        'token' => 'Ange din nyckel',
        'token_hint' => 'Om du prenumererar på {podcastTitle} kan du kopiera nyckeln som skickades till dig via e-post och klistra in den här.',
        'submit' => 'Lås upp alla avsnitt!',
        'call_to_action' => 'Lås upp alla avsnitt av {podcastTitle}:',
        'subscribe_cta' => 'Prenumerera nu!',
    ],
    'messages' => [
        'unlockSuccess' => 'Podcast har låsts upp! Njut av premiumavsnitt!',
        'unlockBadAttempt' => 'Din nyckel verkar inte fungera…',
        'lockSuccess' => 'Podcast har låsts!',
    ],
];
