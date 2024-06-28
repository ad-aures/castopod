<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => 'Podcast zawiera odcinki premium',
    'episode_is_premium' => 'Ten odcinek premium jest dostępny tylko dla subskrybentów',
    'unlock_episode' => 'Ten odcinek jest tylko dla subskrybentów premium. Kliknij, aby go odblokować!',
    'banner_unlock' => 'Ten podcast zawiera odcinki premium, dostępne tylko dla subskrybentów premium.',
    'banner_lock' => 'Podcast został odblokowany, ciesz się odcinkami premium!',
    'subscribe' => 'Subskrybuj',
    'lock' => 'Zablokuj',
    'unlock' => 'Odblokuj',
    'unlock_form' => [
        'title' => 'Zawartość premium',
        'subtitle' => 'Ten podcast zawiera zablokowane odcinki premium! Czy masz klucz do ich odblokowania?',
        'token' => 'Wprowadź swój klucz',
        'token_hint' => 'Jeśli subskrybujesz {podcastTitle}, możesz skopiować klucz wysłany do Ciebie mailem i wkleić go tutaj.',
        'submit' => 'Odblokuj wszystkie odcinki!',
        'call_to_action' => 'Odblokuj wszystkie odcinki {podcastTitle}:',
        'subscribe_cta' => 'Subskrybuj teraz!',
    ],
    'messages' => [
        'unlockSuccess' => 'Podcast został pomyślnie odblokowany! Ciesz się odcinkami premium!',
        'unlockBadAttempt' => 'Twój klucz nie działa…',
        'lockSuccess' => 'Podcast został pomyślnie zablokowany!',
    ],
];
