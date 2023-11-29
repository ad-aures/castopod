<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Suscripciones de Podcast',
    'add' => 'Nueva suscripción',
    'view' => 'Ver suscripción',
    'edit' => 'Editar la suscripción',
    'regenerate_token' => 'Regenerar token',
    'suspend' => 'Suspender suscripción',
    'resume' => 'Reanudar suscripción',
    'delete' => 'Eliminar suscripción',
    'status' => [
        'active' => 'Activo',
        'suspended' => 'Suspendido',
        'expired' => 'Caducado',
    ],
    'list' => [
        'number' => 'Número',
        'email' => 'Correo electrónico',
        'expiration_date' => 'Fecha de expiración',
        'unlimited' => 'Ilimitado',
        'downloads' => 'Descargas',
        'status' => 'Estado',
    ],
    'form' => [
        'email' => 'Correo electrónico',
        'expiration_date' => 'Fecha de expiración',
        'expiration_date_hint' => 'La fecha y hora en que caduca la suscripción. Dejar en blanco para una suscripción ilimitada.',
        'submit_create' => 'Create subscription',
        'submit_edit' => 'Editar la suscripción',
    ],
    'form_link_add' => [
        'link' => 'Enlace de página de suscripción',
        'link_hint' => 'Esto añadirá una llamada a la acción en el sitio web invitando a los oyentes a suscribirse al podcast.',
        'submit' => 'Guardar enlace',
    ],
    'suspend_form' => [
        'disclaimer' => 'Suspender la suscripción restringirá que el suscriptor tenga acceso al contenido premium. Aún podrá levantar la suspensión después.',
        'reason' => 'Motivo',
        'reason_placeholder' => '¿Por qué quieres detener tu suscripción?',
        "submit" => 'Suspender suscripción',
    ],
    'delete_form' => [
        'disclaimer' => 'Eliminar la suscripción de {subscriber} eliminará todos los datos analíticos asociados a ella.',
        'understand' => 'Entiendo, eliminar la suscripción permanentemente',
        'submit' => 'Eliminar Suscripción',
    ],
    'messages' => [
        'addSuccess' => '¡Nueva suscripción añadida! Se ha enviado un correo electrónico de bienvenida a {subscriber}.',
        'addError' => 'La suscripción no pudo ser añadida.',
        'editSuccess' => '¡La fecha de caducidad de la suscripción ha sido actualizada! Se ha enviado un correo electrónico a {subscriber}.',
        'editError' => 'No se pudo editar la suscripción.',
        'regenerateTokenSuccess' => '¡Token regenerado! Un correo electrónico fue enviado a {subscriber} con el nuevo token.',
        'regenerateTokenError' => 'El token no se pudo regenerar.',
        'deleteSuccess' => '¡La suscripción ha sido eliminada! Se ha enviado un correo electrónico a {subscriber}.',
        'deleteError' => 'La suscripción no pudo ser eliminada.',
        'suspendSuccess' => '¡La suscripción ha sido suspendida! Se ha enviado un correo electrónico a {subscriber}.',
        'suspendError' => 'La suscripción no pudo ser suspendida.',
        'resumeSuccess' => 'La suscripción se ha reanudado! Se ha enviado un correo electrónico a {subscriber}.',
        'resumeError' => 'No se pudo reanudar la suscripción.',
        'linkSaveSuccess' => '¡El enlace de suscripción se ha guardado correctamente! ¡Aparecerá en el sitio web como una acción de llamada!',
        'linkRemoveSuccess' => '¡El enlace de suscripción se eliminó correctamente!',
    ],
    'emails' => [
        'greeting' => 'Hola,',
        'token' => 'Tu token: {0}',
        'unique_feed_link' => 'Tu enlace de feed único: {0}',
        'how_to_use' => '¿Cómo se usa?',
        'two_ways' => 'Tienes dos maneras de desbloquear los episodios premium:',
        'import_into_app' => 'Copie su Url única dentro de su aplicación de podcast favorita (importe como un feed privado para evitar exponer sus credenciales).',
        'go_to_website' => 'Ve a la página web de {podcastWebsite} y desbloquea el podcast con tu token.',
        'welcome_subject' => 'Bienvenido a {podcastTitle}',
        'welcome' => 'Te has suscrito a {podcastTitle}, ¡gracias y bienvenido!',
        'welcome_token_title' => 'Aquí están tus credenciales para desbloquear los episodios premium del podcast:',
        'welcome_expires' => 'Sus suscripción caducará en {0}.',
        'welcome_never_expires' => 'Tu suscripción nunca expirará.',
        'reset_subject' => '¡Tu token ha sido restablecido!',
        'reset_token' => '¡Tu acceso a {podcastTitle} ha sido restablecido!',
        'reset_token_title' => 'Se han generado nuevas credenciales para desbloquear los episodios premium del podcast:',
        'edited_subject' => 'Su suscripción ha sido actualizada!',
        'edited_expires' => 'Su suscripción para {podcastTitle} caducará el {expiresAt}.',
        'edited_never_expires' => '¡Tu suscripción para {podcastTitle} nunca caducará!',
        'suspended_subject' => 'Tu suscripción ha sido suspendida!',
        'suspended' => '¡Tu suscripción para {podcastTitle} ha sido suspendida! Ya no puedes acceder a los episodios premium del podcast.',
        'suspended_reason' => 'Este es el siguiente motivo: {0}',
        'resumed_subject' => 'Hemos reactivado tu suscripción!',
        'resumed' => '¡Tu suscripción para {podcastTitle} ha sido reanudada! Puedes acceder de nuevo a los episodios premium del podcast.',
        'deleted_subject' => 'La suscripción ha sido eliminada!',
        'deleted' => '¡Tu suscripción para {podcastTitle} ha sido eliminada! Ya no tienes acceso a los episodios premium del podcast.',
        'footer' => '{castopod} alojado en {host}',
    ],
];
