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

## 2. Per i ruoli e le autorizzazioni del podcast

### Per i ruoli del podcast

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| ruolo  | descrizione                                                       | autorizzazioni                                                                                                                                                                                                                                                                              |
| ------ | ----------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin  | Ha il controllo completo del podcast #{id}.                       | \*                                                                                                                                                                                                                                                                                          |
| Editor | Gestisce contenuti e pubblicazioni del podcast #{id}.             | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Autore | Gestisce i contenuti del podcast #{id}, ma non li può pubblicare. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Ospite | Collaboratore generale del podcast #{id}.                         | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Autorizzazioni per podcast

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| autorizzazione               | descrizione                                                                                          |
| ---------------------------- | ---------------------------------------------------------------------------------------------------- |
| view                         | Può visualizzare il pannello di controllo e le statistiche del podcast #{id}.                        |
| edit                         | Può modificare il podcast #{id}.                                                                     |
| delete                       | Può eliminare il podcast #{id}.                                                                      |
| manage-import                | Può sincronizzare il podcast #{id} importato.                                                        |
| manage-persons               | Può gestire le iscrizioni del podcast #{id}.                                                         |
| manage-subscriptions         | Può gestire le iscrizioni del podcast #{id}.                                                         |
| manage-contributors          | Può gestire i collaboratori del podcast #{id}.                                                       |
| manage-platforms             | Può impostare/rimuovere i link della piattaforma del podcast #{id}.                                  |
| manage-publications          | Può pubblicare il podcast #{id}.                                                                     |
| manage-notifications         | Può visualizzare e contrassegnare le notifiche come lette per il podcast #{id}.                      |
| interact-as                  | Può interagire come il podcast #{id}, per salvare tra i preferiti, condividere o rispondere ai post. |
| episodes.view                | Può visualizzare il pannello di controllo e le statistiche del podcast #{id}.                        |
| episodes.create              | Può creare episodi per il podcast #{id}.                                                             |
| episodes.edit                | Può modificare il podcast #{id}.                                                                     |
| episodes.delete              | Può eliminare il podcast #{id}.                                                                      |
| episodes.manage-persons      | Può gestire gli abbonamenti del podcast #{id}.                                                       |
| episodes.manage-clips        | Può gestire le clip video o i suoni del podcast #{id}.                                               |
| episodes.manage-publications | Può pubblicare il podcast #{id}.                                                                     |
| episodes.manage-comments     | Può creare/rimuovere i commenti dell'episodio del podcast #{id}.                                     |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
