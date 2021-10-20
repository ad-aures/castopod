<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Platforms',
    'home_url' => 'Go to {platformName} website',
    'submit_url' => 'Submit your podcast on {platformName}',
    'visible' => 'Display in podcast homepage?',
    'on_embed' => 'Display on embeddable player?',
    'remove' => 'Remove {platformName}',
    'submit' => 'Save',
    'messages' => [
        'updateSuccess' => 'Platform links have been successfully updated!',
        'removeLinkSuccess' => 'The platform link has been removed.',
        'removeLinkError' =>
            'The platform link could not be removed. Try again.',
    ],
    'description' => [
        'podcasting' => 'The podcast ID on this platform',
        'social' => 'The podcast account ID on this platform',
        'funding' => 'Call to action message',
    ],
];
