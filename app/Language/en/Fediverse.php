<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'your_handle' => 'Your Fediverse handle',
    'your_handle_hint' => 'Enter the @username@domain you want to act from.',
    'follow' => [
        'label' => 'Follow',
        'title' => 'Follow {actorDisplayName}',
        'subtitle' => 'You are going to follow:',
        'accountNotFound' => 'The account could not be found.',
        'remoteFollowNotAllowed' => 'Seems like the account server does not allow remote follows…',
        'submit' => 'Proceed to follow',
    ],
    'favourite' => [
        'title' => "Favourite {actorDisplayName}'s post",
        'subtitle' => 'You are going to favourite:',
        'submit' => 'Proceed to favourite',
    ],
    'reblog' => [
        'title' => "Share {actorDisplayName}'s post",
        'subtitle' => 'You are going to share:',
        'submit' => 'Proceed to share',
    ],
    'reply' => [
        'title' => "Reply to {actorDisplayName}'s post",
        'subtitle' => 'You are going to reply to:',
        'submit' => 'Proceed to reply',
    ],
];
