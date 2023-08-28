---
title: Autenticazione & Autorizzazione
sidebarDepth: 3
---

# Autenticazione & Autorizzazione

Castopod gestisce l'autenticazione e l'autorizzazione utilizzando
`codeigniter/shield` abbinato a regole personalizzate. Ruoli e permessi sono
definiti a due livelli:

1. [intera istanza](#1-instance-wide-roles-and-permissions)
2. [per podcast](#2-per-podcast-roles-and-permissions)

## 1. Ruoli e permessi per l'intera istanza

### Ruoli dell'istanza

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| ruolo       | descrizione                        | permessi                                                                                   |
| ----------- | ---------------------------------- | ------------------------------------------------------------------------------------------ |
| Super admin | Ha il pieno controllo su Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Manager     | Gestisce il contenuto di Castopod. | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster   | Utenti generali di Castopod.       | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Permessi istanza

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permesso                | descrizione                                                               |
| ----------------------- | ------------------------------------------------------------------------- |
| admin.access            | Può accedere alla zona di amministrazione di Castopod.                    |
| admin.settings          | Può accedere alle impostazioni di Castopod.                               |
| users.manage            | Può gestire gli utenti di Castopod.                                       |
| persons.manage          | Può gestire le persone.                                                   |
| pages.manage            | Può gestire le pagine.                                                    |
| podcasts.view           | Può visualizzare tutti i podcast.                                         |
| podcasts.create         | Può creare nuovi podcast.                                                 |
| podcasts.import         | Può importare podcast.                                                    |
| fediverse.manage-blocks | Può impedire agli attori/domini del fediverso di interagire con Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Per podcast roles and permissions

### Per podcast roles

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| role   | description                                               | permissions                                                                                                                                                                                                                                                                                 |
| ------ | --------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin  | Has complete control of podcast #{id}.                    | \*                                                                                                                                                                                                                                                                                          |
| Editor | Manages content and publications of podcast #{id}.        | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Author | Manages content of podcast #{id} but cannot publish them. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Guest  | General contributor of the podcast #{id}.                 | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Per podcast permissions

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission                   | description                                                              |
| ---------------------------- | ------------------------------------------------------------------------ |
| view                         | Can view dashboard and analytics of podcast #{id}.                       |
| edit                         | Can edit podcast #{id}.                                                  |
| delete                       | Can delete podcast #{id}.                                                |
| manage-import                | Can synchronize imported podcast #{id}.                                  |
| manage-persons               | Can manage subscriptions of podcast #{id}.                               |
| manage-subscriptions         | Can manage subscriptions of podcast #{id}.                               |
| manage-contributors          | Can manage contributors of podcast #{id}.                                |
| manage-platforms             | Can set/remove platform links of podcast #{id}.                          |
| manage-publications          | Can publish podcast #{id}.                                               |
| manage-notifications         | Can view and mark notifications as read for podcast #{id}.               |
| interact-as                  | Can interact as the podcast #{id} to favourite, share or reply to posts. |
| episodes.view                | Can view dashboard and analytics of podcast #{id}.                       |
| episodes.create              | Can create episodes for podcast #{id}.                                   |
| episodes.edit                | Can edit podcast #{id}.                                                  |
| episodes.delete              | Can delete podcast #{id}.                                                |
| episodes.manage-persons      | Can manage subscriptions of podcast #{id}.                               |
| episodes.manage-clips        | Can manage video clips or soundbites of podcast #{id}.                   |
| episodes.manage-publications | Can publish podcast #{id}.                                               |
| episodes.manage-comments     | Can create/remove episode comments of podcast #{id}.                     |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
