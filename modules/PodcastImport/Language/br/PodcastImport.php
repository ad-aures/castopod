<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Enporzhiañ',
        'text' => 'Emañ {podcastTitle} o vezañ enporzhiet.',
        'cta' => 'Gwelet stad an enporzh',
    ],
    'old_podcast_section_title' => 'Ar podkast da vezañ enporzhiet',
    'old_podcast_legal_disclaimer_title' => 'Menegoù lezennel',
    'old_podcast_legal_disclaimer' =>
        'Bezit sur oc\'h aotreet da enporzhiañ ar podkast-mañ a-raok en ober. Eilañ ha skignañ ur podkast hep kaout an aotre a zo heñvel ouzh dambreziñ ha gallout a reer bezañ kaset d\'al lez-varn.',
    'imported_feed_url' => 'URL ar wazh',
    'imported_feed_url_hint' => 'Rankout a ra ar wazh bezañ er furmad xml pe rss.',
    'new_podcast_section_title' => 'Ar podkast nevez',
    'lock_import' =>
        'Gwarezet eo ar wazh-mañ. Ne c\'hallit ket enporzhiañ anezhi. Ma\'z oc\'h ar perc\'henn·erez, dibrennit anezhi war ar savenn orin.',
    'submit' => 'Ouzhpennañ an enporzh d\'al lost',
    'queue' => [
        'status' => [
            'label' => 'Statud',
            'queued' => 'el lost',
            'queued_hint' => 'Emañ an enporzh el lost.',
            'canceled' => 'nullet',
            'canceled_hint' => 'Nullet eo bet an enporzh.',
            'running' => 'war ar stern',
            'running_hint' => 'Emañ an enporzh war ar stern.',
            'failed' => 'c\'hwitet',
            'failed_hint' => 'An enporzh n\'eo ket bet graet: fazi skript.',
            'passed' => 'berzh',
            'passed_hint' => 'Enporzhiet eo bet gant berzh!',
        ],
        'feed' => 'Gwazh',
        'duration' => 'Padelezh an enporzh',
        'imported_episodes' => 'Rannoù enporzhiet',
        'imported_episodes_hint' => '{newlyImportedCount} enporzhiet nevez zo, {alreadyImportedCount} enporzhiet en holl.',
        'actions' => [
            'cancel' => 'Nullañ',
            'retry' => 'Klask en-dro',
            'delete' => 'Dilemel',
        ],
    ],
    'syncForm' => [
        'title' => 'Sinkronekaat ar gwazhoù',
        'feed_url' => 'URL ar wazh',
        'feed_url_hint' => 'URL ar wazh ho peus c\'hoant da sinkronekaat ouzh ar podkast-mañ.',
        'submit' => 'Ouzhpennañ d\'al lost',
    ],
    'messages' => [
        'canceled' => 'An enporzh zo bet nullet gant berzh!',
        'notRunning' => 'Ne c\'haller ket nullañ an enporzh rak n\'eo ket krog al labour.',
        'alreadyRunning' => 'Emañ an enporzh war ar stern. Gallout a rit nullañ anezhañ a-raok klask en-dro.',
        'retried' => 'Ouzhpennet eo bet an enporzh d\'al lost, klasket e vo en-dro dindan berr!',
        'deleted' => 'An enporzh zo bet dilamet gant berzh!',
        'importTaskQueued' => 'Un enporzh nevez zo bet ouzhpennet d\'al lost, kroget e vo dindan berr!',
        'syncTaskQueued' => 'Un enporzh nevez zo bet ouzhpennet d\'al lost, kroget e vo ar sinkronekaat dindan berr!',
    ],
];
