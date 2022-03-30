<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'your_handle' => 'Handle',
    'your_handle_hint' => 'Enter the @username@domain you want to act from.',
    'follow' => [
        'label' => 'Folge',
        'title' => 'Folge {actorDisplayName}',
        'subtitle' => 'Sie werden folgen:',
        'accountNotFound' => 'Das Konto wurde nicht gefunden.',
        'remoteFollowNotAllowed' => 'Seems like the account server does not allow remote follows…',
        'submit' => 'Weiter zum Folgen',
    ],
    'favourite' => [
        'title' => "{actorDisplayName}'s Beitrag favorisieren",
        'subtitle' => 'Sie werden favorisieren:',
        'submit' => 'Weiter zum Favorisieren',
    ],
    'reblog' => [
        'title' => "{actorDisplayName}'s Beitrag teilen",
        'subtitle' => 'You are going to share:',
        'submit' => 'Weiter zum Teilen',
    ],
    'reply' => [
        'title' => "Auf {actorDisplayName}'s Beitrag antworten",
        'subtitle' => 'You are going to reply to:',
        'submit' => 'Weiter zum Antworten',
    ],
];
