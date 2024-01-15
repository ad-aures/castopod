<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Arventennoù hollek',
    'instance' => [
        'title' => 'Istañs',
        'site_icon' => 'Arlun al lec\'hienn',
        'site_icon_delete' => 'Dilemel arlun al lec\'hienn',
        'site_icon_hint' => 'Site icons are what you see on your browser tabs, bookmarks bar, and when you add a website as a shortcut on mobile devices.',
        'site_icon_helper' => 'An arlun a rankfe bezañ ur c\'harrez ha 512px e vent da nebeutañ.',
        'site_name' => 'Titl al lec\'hienn',
        'site_description' => 'Deskrivadur al lec\'hienn',
        'submit' => 'Enrollañ',
        'editSuccess' => 'Instance has been updated successfully!',
        'deleteIconSuccess' => 'Site icon has been remove successfully!',
    ],
    'images' => [
        'title' => 'Skeudennoù',
        'subtitle' => 'Here you can regenerate all images based on the originals that were uploaded. To be used if you find that some images are missing. This task may take a while.',
        'regenerate' => 'Azgenel ar skeudennoù',
        'regenerationSuccess' => 'All images have been regenerated successfully!',
    ],
    'housekeeping' => [
        'title' => 'Kempenn',
        'subtitle' => 'Runs various housekeeping tasks. Use this feature if you ever encounter issues with media files or data integrity. These tasks may take a while.',
        'reset_counts' => 'Reset counts',
        'reset_counts_helper' => 'This option will recalculate and reset all data counts (number of followers, posts, comments, …).',
        'rewrite_media' => 'Rewrite media metadata',
        'rewrite_media_helper' => 'This option will delete all superfluous media files and recreate them (images, audio files, transcripts, chapters, …)',
        'rename_episodes_files' => 'Rename episode audio files',
        'rename_episodes_files_hint' => 'This option will rename all episodes audio files to a random string of characters. Use this if one of your private episodes link was leaked as this will effectively hide it.',
        'clear_cache' => 'Clear all cache',
        'clear_cache_helper' => 'This option will flush redis cache or writable/cache files.',
        'run' => 'Run housekeeping',
        'runSuccess' => 'Housekeeping has been run successfully!',
    ],
    'theme' => [
        'title' => 'Neuz',
        'accent_section_title' => 'Liv kentañ',
        'accent_section_subtitle' => 'Choose the color to determine the look and feel of all public pages.',
        'pine' => 'Pine',
        'crimson' => 'Crimson',
        'amber' => 'Amber',
        'lake' => 'Lake',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyx',
        'submit' => 'Enrollañ',
        'setInstanceThemeSuccess' => 'Cheñchet eo bet an neuz gant berzh!',
    ],
];
