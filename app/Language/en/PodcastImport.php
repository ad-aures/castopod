<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'legal_dislaimer_title' => 'Legal Disclaimer',
    'legal_dislaimer_content' =>
        'Make sure you own the rights for this podcast before importing it.<br/>Copying and broadcasting a podcast without the proper rights is piracy and is liable to prosecution.',
    'warning_title' => 'Warning',
    'warning_content' =>
        'This procedure may take a long time.<br/>The current version does not show any progress while it runs. You will not see anything updated until it is done.<br/>In case of timeout error, increase max_execution_time value.',
    'old_podcast_section_title' => 'The podcast to import',
    'old_podcast_section_subtitle' => '',
    'imported_feed_url' => 'Feed URL',
    'imported_feed_url_hint' =>
        'The feed must be in `.xml` format. Make sure you are legally allowed to copy the podcast.',
    'new_podcast_section_title' => 'The new podcast',
    'new_podcast_section_subtitle' => '',
    'name' => 'Name',
    'name_hint' => 'Used for generating the podcast URL.',
    'advanced_params_section_title' => 'Advanced parameters',
    'advanced_params_section_subtitle' =>
        'Keep the default values if you have no idea of what the fields are for.',
    'slug_field' => [
        'label' => 'Which field should be used to calculate episode slug',
        'link' => '&lt;link&gt;',
        'title' => '&lt;title&gt;',
    ],
    'description_field' => [
        'label' => 'Source field used for episode description / show notes',
        'description' => '&lt;description&gt;',
        'summary' => '&lt;itunes:summary&gt;',
        'subtitle_summary' =>
            '&lt;itunes:subtitle&gt; + &lt;itunes:summary&gt;',
    ],
    'force_renumber' => 'Force episodes renumbering',
    'force_renumber_hint' =>
        'Use this if your podcast does not have episode numbers but wish to set them during import.',
    'season_number' => 'Season number',
    'season_number_hint' =>
        'Use this if your podcast does not have a season number but wish to set one during import. Leave blank otherwise.',
    'max_episodes' => 'Maximum number of episodes to import',
    'max_episodes_hint' => 'Leave blank to import all episodes',
    'submit' => 'Import podcast',
];
