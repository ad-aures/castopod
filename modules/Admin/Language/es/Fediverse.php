<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'messages' => [
        'actorNotFound' => '¡No se pudo encontrar la cuenta!',
        'blockActorSuccess' => '¡{actor} ha sido bloqueado!',
        'unblockActorSuccess' => '¡El actor ha sido desbloqueado!',
        'blockDomainSuccess' => '¡{domain} ha sido bloqueado!',
        'unblockDomainSuccess' => '¡{domain} ha sido desbloqueado!',
    ],
    'blocked_actors' => 'Cuentas bloqueadas',
    'blocked_domains' => 'Dominios bloqueados',
    'block_lists_form' => [
        'handle' => 'Alias de la cuenta',
        'handle_hint' => 'Ingrese la cuenta @username@dominio.',
        'domain' => 'Nombre de dominio',
        'submit' => 'Bloquear!',
    ],
    'list' => [
        'actor' => 'Cuenta',
        'domain' => 'Nombre de dominio',
        'unblock' => 'Desbloquear',
    ],
];
