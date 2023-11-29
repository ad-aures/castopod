<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Uvoz',
        'text' => '{podcastTitle} se trenutno uvozi.',
        'cta' => 'Pogledaj status uvoza',
    ],
    'old_podcast_section_title' => 'Podkast koji se uvozi',
    'old_podcast_legal_disclaimer_title' => 'Pravno odricanje od odgovornosti',
    'old_podcast_legal_disclaimer' =>
        'Uverite se da posedujete prava za ovaj podkast pre nego što ga uvezete. Kopiranje i emitovanje podkasta bez odgovarajućih prava je piraterija i podložno je krivičnom gonjenju.',
    'imported_feed_url' => 'URL snabdevača',
    'imported_feed_url_hint' => 'Snabdevač mora biti u xml ili rss formatu.',
    'new_podcast_section_title' => 'Novi podkast',
    'lock_import' =>
        'Ovaj snabdevač je zaštićen. Ne možete ga uvesti. Ukoliko ste vlasnik, otključajte snabdevač na originalnoj platformi na kojoj ste ga napravili.',
    'submit' => 'Dodaj uvoz na čekanje',
    'queue' => [
        'status' => [
            'label' => 'Status',
            'queued' => 'čekanje',
            'queued_hint' => 'Zadatak uvoza čeka na obradu.',
            'canceled' => 'otkazano',
            'canceled_hint' => 'Zadatak uvoza je otkazan.',
            'running' => 'u toku',
            'running_hint' => 'Zadatak uvoza se procesuira.',
            'failed' => 'nije uspеlo',
            'failed_hint' => 'Zadatak uvoza nije mogao da se završi: greška skripte.',
            'passed' => 'pauzirano',
            'passed_hint' => 'Zadatak uvoza uspešno obavljen!',
        ],
        'feed' => 'Snabdevač',
        'duration' => 'Trajanje uvoza',
        'imported_episodes' => 'Uvežene epizode',
        'imported_episodes_hint' => '{newlyImportedCount} novo uvežena, {alreadyImportedCount} već uveženih.',
        'actions' => [
            'cancel' => 'Otkaži',
            'retry' => 'Pokušaj ponovo',
            'delete' => 'Obriši',
        ],
    ],
    'syncForm' => [
        'title' => 'Sinhronizuj snabdevače',
        'feed_url' => 'URL snabdevača',
        'feed_url_hint' => 'URL veza snabdevača koju želite da sinhronizujete sa trenutnim podkastom.',
        'submit' => 'Dodaj u redosled',
    ],
    'messages' => [
        'canceled' => 'Zadatak uvoza uspešno otkazan!',
        'notRunning' => 'Nije moguće otkazati zadatak uvoza jer isti nije u toku.',
        'alreadyRunning' => 'Zadatak uvoza je u toku. Možete ga otkazati pre ponovnog pokušaja.',
        'retried' => 'Zadatak uvoza je na čekanju, biće pokušan ponovo uskoro!',
        'deleted' => 'Zadatak uvoza uspešno obrisan!',
        'importTaskQueued' => 'Novi zadatak je na čekanju, uvoz će krenuti uskoro!',
        'syncTaskQueued' => 'Novi zadatak uvoza je na čekanju, sinhronizacija će početi uskoro!',
    ],
];
