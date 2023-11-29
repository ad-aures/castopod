<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Uredi {username} uloge",
    'ban' => 'Zabrani',
    'unban' => 'Ukini zabranu',
    'delete' => 'Obriši',
    'create' => 'Novi korisnik',
    'view' => "Informacije o korisniku {username}",
    'all_users' => 'Svi korisnici',
    'list' => [
        'user' => 'Korisnik',
        'role' => 'Uloga',
        'banned' => 'Zabranjen?',
    ],
    'form' => [
        'email' => 'E-pošta',
        'username' => 'Korisničko ime',
        'password' => 'Lozinka',
        'new_password' => 'Nova lozinka',
        'role' => 'Uloga',
        'roles' => 'Uloge',
        'permissions' => 'Dozvole',
        'submit_create' => 'Kreiraj korisnika',
        'submit_edit' => 'Sačuvaj',
        'submit_password_change' => 'Promeni!',
    ],
    'delete_form' => [
        'title' => 'Ukloni korisnika {user}',
        'disclaimer' =>
            "Spremate se da trajno uklonite korisnika {user}. Korisnik neće moći više da pristupi administratorskoj zoni.",
        'understand' => 'Shvatam, želim da trajno uklonim korisnika {user}',
        'submit' => 'Obriši',
    ],
    'messages' => [
        'createSuccess' =>
            'Korisnik je uspešno kreiran! Poruka dobrodošlice je poslata E-poštom korisniku {username}. Ona sadrži vezu za prijavu a od njih će biti zatraženo resetovanje lozinke nakon prve autentifikacije.',
        'roleEditSuccess' =>
            "Uloge korisnika {username} su uspešno ažurirane.",
        'banSuccess' => 'Korisnik {username} je zabranjen.',
        'unbanSuccess' => 'Korisniku {username} je skinuta zabrana.',
        'editOwnerError' =>
            'Korisnik {username} je vlasnik instance, prosto ne možete dirati vlasnika…',
        'banSuperAdminError' =>
            'Korisnik {username} je super administrator, prosto ne možete zabraniti super administratora…',
        'deleteOwnerError' =>
            'Korisnik {username} je vlasnik instance, prosto ne možete obrisati vlasnika…',
        'deleteSuperAdminError' =>
            'Korisnik {username} je super administrator, prosto ne možete obrisati super administratora…',
        'deleteSuccess' => 'Korisnik {username} je obrisan.',
    ],
];
