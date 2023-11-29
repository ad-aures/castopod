<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importerer',
        'text' => '{podcastTitle} blir importert.',
        'cta' => 'Sjå status på importen',
    ],
    'old_podcast_section_title' => 'Podkast å importera',
    'old_podcast_legal_disclaimer_title' => 'Juridisk ansvarsfråskriving',
    'old_podcast_legal_disclaimer' =>
        'Syt for at du har rettane til podkasten før du importerer han. Å kopiera og kringkasta ein podkast utan løyve er ulovleg og straffbart.',
    'imported_feed_url' => 'URL til straumen',
    'imported_feed_url_hint' => 'Straumen må vera i xml- eller rss-format.',
    'new_podcast_section_title' => 'Den nye podkasten',
    'lock_import' =>
        'Denne straumen er verna. Du kan ikkje importera han. Viss du er eigaren, må du låsa han opp på den originale plattforma.',
    'submit' => 'Legg importen i køen',
    'queue' => [
        'status' => [
            'label' => 'Status',
            'queued' => 'i kø',
            'queued_hint' => 'Importjobben ventar på å bli utført.',
            'canceled' => 'avbrote',
            'canceled_hint' => 'Importjobben vart avbroten.',
            'running' => 'køyrer',
            'running_hint' => 'Utfører importoppgåva.',
            'failed' => 'mislukka',
            'failed_hint' => 'Greidde ikkje fullføra importen: skriptfeil.',
            'passed' => 'utført',
            'passed_hint' => 'Importen var vellukka.',
        ],
        'feed' => 'Straum',
        'duration' => 'Kor lenge importen vara',
        'imported_episodes' => 'Importerte episodar',
        'imported_episodes_hint' => '{newlyImportedCount} nyss importerte, {alreadyImportedCount} allereie importerte.',
        'actions' => [
            'cancel' => 'Avbryt',
            'retry' => 'Prøv på nytt',
            'delete' => 'Slett',
        ],
    ],
    'syncForm' => [
        'title' => 'Synchronize feeds',
        'feed_url' => 'Feed URL',
        'feed_url_hint' => 'The feed URL you want to synchronize with the current podcast.',
        'submit' => 'Add to queue',
    ],
    'messages' => [
        'canceled' => 'Importen vart avbroten.',
        'notRunning' => 'Kan ikkje avbryta importen, fordi han ikkje køyrer.',
        'alreadyRunning' => 'Importen er i gang. Du kan avbryta han før du prøver på nytt.',
        'retried' => 'Importjobben er lagt i køen, og vil bli prøvd på nytt straks.',
        'deleted' => 'Importjobben er sletta.',
        'importTaskQueued' => 'Ein ny jobb er lagd i køen, og importen startar straks.',
        'syncTaskQueued' => 'Ein ny importjobb er lagd i køen, og synkroniseringa startar straks.',
    ],
];
