<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => 'Podcast contains premium episodes',
    'episode_is_premium' => 'Episode is premium, only available to premium subscribers',
    'unlock_episode' => 'This episode is for premium subscribers only. Click to unlock it!',
    'banner_unlock' => 'This podcast contains premium episodes, only available to premium subscribers.',
    'banner_lock' => 'Podcast is unlocked, enjoy the premium episodes!',
    'subscribe' => 'Subscribe',
    'lock' => 'Lock',
    'unlock' => 'Unlock',
    'unlock_form' => [
        'title' => 'Premium content',
        'subtitle' => 'This podcast contains locked premium episodes! Do you have the key to unlock them?',
        'token' => 'Enter your key',
        'token_hint' => 'If you are subscribed to {podcastTitle}, you may copy the key that was sent to you via email and paste it here.',
        'submit' => 'Unlock all episodes!',
        'call_to_action' => 'Unlock all episodes of {podcastTitle}:',
        'subscribe_cta' => 'Subscribe now!',
    ],
    'messages' => [
        'unlockSuccess' => 'Podcast was successfully unlocked! Enjoy the premium episodes!',
        'unlockBadAttempt' => 'Your key does not seem to be working…',
        'lockSuccess' => 'Podcast was successfully locked!',
    ],
];
