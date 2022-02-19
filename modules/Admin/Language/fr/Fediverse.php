<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'messages' => [
        'blockActorSuccess' => '{actor} a été bloqué !',
        'unblockActorSuccess' => 'L’utilisateur a été débloqué !',
        'blockDomainSuccess' => '{domain} a été bloqué !',
        'unblockDomainSuccess' => '{domain} a été débloqué !',
    ],
    'block_lists' => 'Listes de blocage',
    'block_lists_form' => [
        'blocked_users' => 'Utilisateurs bloqués',
        'blocked_users_hint' =>
            'Entrez les pseudonymes @utilisateur@domaine séparés par une virgule.',
        'blocked_domains' => 'Domaines bloqués',
        'blocked_domains_hint' =>
            'Entrez les noms de domaine séparés par une virgule.',
        'submit' => 'Sauvegarder les listes',
    ],
];
