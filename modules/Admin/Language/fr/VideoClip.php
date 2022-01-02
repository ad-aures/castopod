<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Extraits vidéos',
        'status' => [
            'label' => 'Statut',
            'queued' => 'en file d’attente',
            'queued_hint' => 'L’extrait est dans la file d’attente.',
            'pending' => 'en attente',
            'pending_hint' => 'L’extrait va être généré prochainement.',
            'running' => 'en cours',
            'running_hint' => 'L’extrait est en cours de génération.',
            'failed' => 'échec',
            'failed_hint' => 'L’extrait n’a pas pu être généré : erreur du programme.',
            'passed' => 'réussite',
            'passed_hint' => 'L’extrait a été généré avec succès !',
        ],
        'clip' => 'Extrait',
        'duration' => 'Durée',
    ],
    'title' => 'Extrait vidéo : {videoClipLabel}',
    'download_clip' => 'Télécharger l’extrait',
    'create' => 'Nouvel extrait vidéo',
    'go_to_page' => 'Aller à la page de l’extrait',
    'retry' => 'Relancer la génération de l’extrait',
    'delete' => 'Supprimer l’extrait',
    'logs' => 'Historique d’exécution',
    'form' => [
        'title' => 'Nouvel extrait vidéo',
        'params_section_title' => 'Paramètres de l’extrait vidéo',
        'clip_title' => 'Titre de l’extrait',
        'format' => [
            'label' => 'Choisissez un format',
            'landscape' => 'Paysage',
            'landscape_hint' => 'Avec un ratio de 16/9, les vidéos en paysage sont adaptées pour PeerTube, Youtube et Vimeo.',
            'portrait' => 'Portrait',
            'portrait_hint' => 'Avec un ratio de 9/16, les vidéos en portrait sont adaptées pour TikTok, les Youtube shorts and les stories Instagram.',
            'squared' => 'Carré',
            'squared_hint' => 'Avec un ratio de 1/1,  les vidéos carrées sont adaptées pour Mastodon, Facebook, Twitter et LinkedIn.',
        ],
        'theme' => 'Sélectionnez un thème',
        'start_time' => 'Démarrer à',
        'duration' => 'Durée',
        'submit' => 'Créer un extrait vidéo',
    ],
    'requirements' => [
        'title' => 'Outils manquants',
        'missing' => 'Il vous manque des outils. Assurez vous d’avoir ajouté tous les outils nécessaires pour accéder au fomulaire de génération d’extrait vidéo !',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Librairie Freetype pour GD',
        'transcript' => 'Fichier de transcription (.srt)',
    ],
];
