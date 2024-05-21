<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Saradnici podkasta',
    'view' => "{username} doprinos {podcastTitle}",
    'add' => 'Dodaj saradnika',
    'add_contributor' => 'Dodaj saradnike za {0}',
    'edit_role' => 'Uredi ulogu za {0}',
    'edit' => 'Izmeni',
    'remove' => 'Ukloni',
    'list' => [
        'username' => 'Korisničko ime',
        'role' => 'Uloga',
    ],
    'form' => [
        'user' => 'Korisnik',
        'user_placeholder' => 'Izaberi korisnika…',
        'role' => 'Uloga',
        'role_placeholder' => 'Dodaj ulogu…',
        'submit_add' => 'Dodaj saradnika',
        'submit_edit' => 'Ažuriraj ulogu',
    ],
    'delete_form' => [
        'title' => 'Ukloni {contributor}',
        'disclaimer' =>
            'Obrisaćete {contributor} iz saradnika. Oni neće moći više da pristupe "{podcastTitle}".',
        'understand' => 'Razumem, želim da uklonim {contributor} iz "{podcastTitle}"',
        'submit' => 'Ukloni',
    ],
    'messages' => [
        'editSuccess' => 'Uloga uspešno promenjena!',
        'editOwnerError' => "Ne možete urediti vlasnika podkasta!",
        'removeOwnerError' => "Ne možete ukloniti vlasnika podkasta!",
        'removeSuccess' =>
            'Uspešno ste uklonili {username} iz {podcastTitle}',
        'alreadyAddedError' =>
            "Saradnik kojeg pokušavate dodati je već dodat!",
    ],
];
