<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'General settings',
    'instance' => [
        'title' => 'Instance',
        'site_icon' => 'Site icon',
        'site_icon_delete' => 'Delete site icon',
        'site_icon_hint' => 'Site icons are what you see on your browser tabs, bookmarks bar, and when you add a website as a shortcut on mobile devices.',
        'site_icon_helper' => 'Icon must be squared with at least 512px wide and tall.',
        'site_name' => 'Site name',
        'site_description' => 'Site description',
        'submit' => 'Save',
        'editSuccess' => 'Instance has been updated successfully!',
        'deleteIconSuccess' => 'Site icon has been remove successfully!',
    ],
    'images' => [
        'title' => 'Images',
        'subtitle' => 'Here you can regenerate all images based on the originals that were uploaded.',
        'regenerate' => 'Regenerate images',
        'regenerationSuccess' => 'All images have been regenerated successfully!',
    ],
    'housekeeping' => [
        'title' => 'Housekeeping',
        'subtitle' => 'Runs various housekeeping tasks, such as rewriting media files metadata (images, audio files, transcripts, chapters, …).',
        'run' => 'Run housekeeping',
        'runSuccess' => 'Housekeeping has been run successfully!',
    ],
    'theme' => [
        'title' => 'Theme',
        'accent_section_title' => 'Accent color',
        'accent_section_subtitle' => 'Choose the color to determine the look and feel of all public pages.',
        'pine' => 'Pine',
        'crimson' => 'Crimson',
        'amber' => 'Amber',
        'lake' => 'Lake',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyx',
        'submit' => 'Save',
        'setInstanceThemeSuccess' => 'Theme has been updated successfully!',
    ],
];
