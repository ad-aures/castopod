---
title: Authentification et Autorisation
sidebarDepth: 3
---

# Authentification et Autorisation

Castopod gère l'authentification et l'autorisation à l'aide de
`codeigniter/shield` associés à des règles personnalisées. Les rôles et les
autorisations sont définis sur deux niveaux :

1. [à l'échelle de l'instance](#1-instance-wide-roles-and-permissions)
2. [par podcast](#2-per-podcast-roles-and-permissions)

## 1. Rôles et autorisations à l'échelle de l'instance

### Rôles dans l’instance

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| rôle         | description                         | permissions                                                                                |
| ------------ | ----------------------------------- | ------------------------------------------------------------------------------------------ |
| Super admin  | A un contrôle complet sur Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Gestionnaire | Gère le contenu de Castopod.        | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster    | Utilisateurs généraux de Castopod.  | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Autorisations dans l'instance

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| autorisation            | description                                                        |
| ----------------------- | ------------------------------------------------------------------ |
| admin.access            | Peut accéder à la zone d'administration Castopod.                  |
| admin.settings          | Peut accéder aux paramètres de Castopod.                           |
| users.manage            | Peut gérer les utilisateurs de Castopod.                           |
| persons.manage          | Can manage persons.                                                |
| pages.manage            | Permet de gérer les pages.                                         |
| podcasts.view           | Peut voir tous les podcasts.                                       |
| podcasts.create         | Peut créer de nouveaux podcasts.                                   |
| podcasts.import         | Peut importer des podcasts.                                        |
| fediverse.manage-blocks | Can block fediverse actors/domains from interacting with Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Rôles et autorisations par podcast

### Rôles par podcast

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| rôle    | description                                                     | permissions                                                                                                                                                                                                                                                                                 |
| ------- | --------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin   | A un contrôle total sur le podcast #{id}.                       | \*                                                                                                                                                                                                                                                                                          |
| Éditeur | Gère le contenu et les publications du podcast #{id}.           | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Auteur  | Gère le contenu du podcast #{id} , mais ne peut pas le publier. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Invité  | Contributeur général du podcast #{id}.                          | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Permissions par podcast

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| autorisation                 | description                                                                               |
| ---------------------------- | ----------------------------------------------------------------------------------------- |
| voir                         | Visualisation du tableau de bord et de l'analyse du podcast #{id}.                        |
| éditer                       | Peut éditer le podcast #{id}.                                                             |
| supprimer                    | Peut supprimer le podcast #{id}.                                                          |
| gérer les importations       | Peut synchroniser le podcast importé #{id}.                                               |
| gérer les personnes          | Permet de gérer les abonnements au podcast #{id}.                                         |
| gérer les abonnements        | Permet de gérer les abonnements au podcast #{id}.                                         |
| gérer contributeurs          | Permet de gérer les contributeurs du podcast #{id}.                                       |
| gérer les plates-formes      | Peut configurer/supprimer les liens de la plateforme du podcast #{id}.                    |
| gérer les publications       | Peut publier le podcast #{id}.                                                            |
| gérer les notifications      | Peut afficher et marquer les notifications comme lues pour le podcast #{id}.              |
| interagir en tant que        | Peut interagir en tant que podcast #{id} pour ajouter, partager ou répondre aux messages. |
| episodes.view                | Peut voir le tableau de bord et les analyses du podcast #{id}.                            |
| créer des épisodes           | Peut créer des épisodes pour le podcast #{id}.                                            |
| éditer les épisodes          | Peut éditer le podcast #{id}.                                                             |
| supprimer les épisodes       | Peut supprimer le podcast #{id}.                                                          |
| episodes.manage-persons      | Permet de gérer les abonnements au podcast #{id}.                                         |
| episodes.manage-clips        | Permet de gérer les clips vidéo ou les parties sonores du podcast #{id}.                  |
| episodes.manage-publications | Peut publier le podcast #{id}.                                                            |
| episodes.manage-comments     | Peut créer/supprimer les commentaires de l'épisode du podcast #{id}.                      |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
