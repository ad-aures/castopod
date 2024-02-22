<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Abonnements au podcast',
    'add' => 'Nouvel abonnement',
    'view' => 'Afficher l\'abonnement',
    'edit' => 'Modifier l\'inscription',
    'regenerate_token' => 'Regenerer le token',
    'suspend' => 'Suspendre l\'abonnement',
    'resume' => 'Reprendre l\'abonnement',
    'delete' => 'Supprimer l\'abonnement',
    'status' => [
        'active' => 'Actif',
        'suspended' => 'Suspendu',
        'expired' => 'Expiré',
    ],
    'list' => [
        'number' => 'Numéro',
        'email' => 'Adresse e-mail',
        'expiration_date' => 'Date d\'expiration',
        'unlimited' => 'Illimité',
        'downloads' => 'Téléchargements',
        'status' => 'Statut',
    ],
    'form' => [
        'email' => 'Adresse e-mail',
        'expiration_date' => 'Date d\'expiration',
        'expiration_date_hint' => 'La date et l\'heure à laquelle l\'abonnement expire. Laissez vide pour un abonnement illimité.',
        'submit_create' => 'Créer un abonnement',
        'submit_edit' => 'Modifier l\'inscription',
    ],
    'form_link_add' => [
        'link' => 'Lien vers la page d\'abonnement',
        'link_hint' => 'Cela va ajouter un appel à l\'action dans le site Web invitant les auditeurs à s\'abonner au podcast.',
        'submit' => 'Enregistrer le lien',
    ],
    'suspend_form' => [
        'disclaimer' => 'Suspendre l\'abonnement empêchera l\'abonné d\'avoir accès au contenu premium. Vous pourrez toujours lever la suspension par la suite.',
        'reason' => 'Raison',
        'reason_placeholder' => 'Pour quelle raison arrêtez vous votre abonnement ?',
        "submit" => 'Suspendre l\'abonnement',
    ],
    'delete_form' => [
        'disclaimer' => 'La suppression de l\'abonnement de {subscriber} supprimera toutes les données d\'analyse qui lui sont associées.',
        'understand' => 'Je comprends, supprimez l\'abonnement définitivement',
        'submit' => 'Supprimer l\'abonnement',
    ],
    'messages' => [
        'addSuccess' => 'Un nouvel abonnement a été ajouté ! Un e-mail de bienvenue a été envoyé à {subscriber}.',
        'addError' => 'L\'abonnement n\'a pu être ajouté.',
        'editSuccess' => 'La date d\'expiration de l\'abonnement a été mise à jour ! Un e-mail a été envoyé à {subscriber}.',
        'editError' => 'L\'abonnement n\'a pas pu être modifié.',
        'regenerateTokenSuccess' => 'Jeton régénéré ! Un email a été envoyé à {subscriber} avec le nouveau jeton.',
        'regenerateTokenError' => 'Le jeton n\'a pas pu être régénéré.',
        'deleteSuccess' => 'L\'abonnement a été suspendu! Un e-mail a été envoyé à {subscriber}.',
        'deleteError' => 'L\'abonnement n\'a pas pu être supprimé.',
        'suspendSuccess' => 'L\'abonnement a été suspendu! Un e-mail a été envoyé à {subscriber}.',
        'suspendError' => 'L\'abonnement ne peut pas être suspendu.',
        'resumeSuccess' => 'L\'abonnement a été suspendu! Un e-mail a été envoyé à {subscriber}.',
        'resumeError' => 'L\'abonnement n\'a pas pu être repris.',
        'linkSaveSuccess' => 'Le lien de l\'abonnement a été enregistré avec succès ! Il apparaîtra sur le site comme un Appel à l\'action !',
        'linkRemoveSuccess' => 'Le lien de l\'abonnement a été supprimé avec succès !',
    ],
    'emails' => [
        'greeting' => 'Hé,',
        'token' => 'Votre jeton : {0}',
        'unique_feed_link' => 'Votre lien de flux unique : {0}',
        'how_to_use' => 'Comment l\'utiliser ?',
        'two_ways' => 'Vous avez deux façons de débloquer les épisodes premium :',
        'import_into_app' => 'Copiez votre URL de flux unique dans votre application de baladodiffusion préférée (importez-la en tant que flux privé pour éviter de dévoiler vos identifiants).',
        'go_to_website' => 'Rendez-vous sur le site web de {podcastWebsite} et débloquez le podcast avec votre jeton.',
        'welcome_subject' => 'Bienvenue sur {podcastTitle}',
        'welcome' => 'Vous vous êtes abonné à {podcastTitle}, merci et bienvenue à bord !',
        'welcome_token_title' => 'Voici vos identifiants pour débloquer les épisodes premium du podcast:',
        'welcome_expires' => 'Votre abonnement a été configuré pour expirer le {0}.',
        'welcome_never_expires' => 'Votre abonnement a été configuré pour ne jamais expirer.',
        'reset_subject' => 'Votre jeton a été réinitialisé !',
        'reset_token' => 'Votre accès à {podcastTitle} a été réinitialisé !',
        'reset_token_title' => 'De nouveaux identifiants ont été générés pour vous permettre de déverrouiller les épisodes premium du podcast:',
        'edited_subject' => 'Votre abonnement a été mis à jour !',
        'edited_expires' => 'Votre abonnement pour {podcastTitle} a été configuré pour expirer le {expiresAt}.',
        'edited_never_expires' => 'Votre abonnement pour {podcastTitle} a été configuré pour ne jamais expirer !',
        'suspended_subject' => 'Votre abonnement a été suspendu !',
        'suspended' => 'Votre abonnement à {podcastTitle} a été suspendu ! Vous ne pouvez plus accéder aux épisodes premium du podcast.',
        'suspended_reason' => 'Pour la raison suivante : {0}',
        'resumed_subject' => 'Votre abonnement a été réactivé !',
        'resumed' => 'Votre abonnement à {podcastTitle} a été réactivé ! Vous pouvez à nouveau accéder aux épisodes premium du podcast.',
        'deleted_subject' => 'Votre abonnement a été supprimé !',
        'deleted' => 'Votre abonnement pour {podcastTitle} a été supprimé ! Vous n\'avez plus accès aux épisodes premium du podcast.',
        'footer' => '{castopod} hébergé sur {host}',
    ],
];
