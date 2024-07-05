<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'installed' => 'Plugins installed',
    'about' => 'About',
    'website' => 'Website',
    'repository' => 'Code repository',
    'authors' => 'Authors',
    'author_email' => 'Email {authorName}',
    'author_homepage' => '{authorName} homepage',
    'declaredHooks' => 'Declared hooks',
    'settings' => 'Settings',
    'settingsTitle' => '{type, select,
        podcast {{pluginTitle} podcast settings}
        episode {{pluginTitle} episode settings}
        other {{pluginTitle} general settings}
    }',
    'view' => 'View',
    'activate' => 'Activate',
    'deactivate' => 'Deactivate',
    'active' => 'Active',
    'inactive' => 'Inactive',
    'invalid' => 'Invalid',
    'incompatible' => 'Incompatible',
    'incompatible_hint' => 'Plugin requires Castopod v{minCastopodVersion} minimum.',
    'uninstall' => 'Uninstall',
    'keywords' => [
        'podcasting20' => 'Podcasting 2.0',
        'seo' => 'SEO',
        'analytics' => 'Analytics',
        'accessibility' => 'Accessibility',
    ],
    'noDescription' => 'No description',
    'noReadme' => 'No README file found.',
    'messages' => [
        'saveSettingsSuccess' => '{pluginTitle} settings were successfully saved!',
    ],
    'errors' => [
        'manifestError' => 'Plugin manifest has errors',
        'manifestMissing' => 'Plugin manifest "{manifestPath}" is missing.',
        'manifestJsonInvalid' => 'Plugin manifest "{manifestPath}" is not a valid JSON.',
    ],
];
