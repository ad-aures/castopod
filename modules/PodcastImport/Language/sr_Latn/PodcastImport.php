<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importing',
        'text' => '{podcastTitle} is currently being imported.',
        'cta' => 'See import status',
    ],
    'old_podcast_section_title' => 'The podcast to import',
    'old_podcast_legal_disclaimer_title' => 'Legal disclaimer',
    'old_podcast_legal_disclaimer' =>
        'Make sure you own the rights for this podcast before importing it. Copying and broadcasting a podcast without the proper rights is piracy and is liable to prosecution.',
    'imported_feed_url' => 'Feed URL',
    'imported_feed_url_hint' => 'The feed must be in xml or rss format.',
    'new_podcast_section_title' => 'The new podcast',
    'lock_import' =>
        'This feed is protected. You cannot import it. If you are the owner, unlock it on the origin platform.',
    'submit' => 'Add import to queue',
    'queue' => [
        'status' => [
            'label' => 'Status',
            'queued' => 'queued',
            'queued_hint' => 'Import task is awaiting to be processed.',
            'canceled' => 'canceled',
            'canceled_hint' => 'Import task was canceled.',
            'running' => 'running',
            'running_hint' => 'Import task is being processed.',
            'failed' => 'failed',
            'failed_hint' => 'Import task could not complete: script failure.',
            'passed' => 'passed',
            'passed_hint' => 'Import task was completed successfully!',
        ],
        'feed' => 'Feed',
        'duration' => 'Import duration',
        'imported_episodes' => 'Imported episodes',
        'imported_episodes_hint' => '{newlyImportedCount} newly imported, {alreadyImportedCount} already imported.',
        'actions' => [
            'cancel' => 'Cancel',
            'retry' => 'Retry',
            'delete' => 'Delete',
        ],
    ],
    'messages' => [
        'canceled' => 'Import task has been successfully canceled!',
        'notRunning' => 'Cannot cancel Import Task as it is not running.',
        'alreadyRunning' => 'Import Task is already running. You may cancel it before retrying.',
        'retried' => 'Import task has been queued, it will be retried shortly!',
        'deleted' => 'Import task has been successfully deleted!',
        'importTaskQueued' => 'An new task has been queued, import will start shortly!',
        'syncTaskQueued' => 'A new import task has been queued, synchronization will start shortly!',
    ],
];
