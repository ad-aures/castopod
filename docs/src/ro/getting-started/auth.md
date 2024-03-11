---
title: Autentificare & Autorizare
sidebarDepth: 3
---

# Autentificare & Autorizare

Castopod folosește pentru autentificare și autorizare `codeigniter/shield`
cuplat la reguli personalizate. Rolurile și permisiunile sunt definite la două
niveluri:

1. [întreaga instanță](#1-instance-wide-roles-and-permissions)
2. [per podcast](#2-per-podcast-roles-and-permissions)

## 1. Gestionați roluri şi permisiuni pe întreaga instanță

### Rolurile instanței

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| rol         | descriere                                 | permisiuni                                                                                 |
| ----------- | ----------------------------------------- | ------------------------------------------------------------------------------------------ |
| Super admin | Deține controlul complet asupra Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Manager     | Gestionează conținutul Castopodului.      | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster   | Utilizatorii generali ai Castopod.        | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Permisiuni instanță

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permisiune              | descriere                                                                  |
| ----------------------- | -------------------------------------------------------------------------- |
| admin.access            | Poate accesa zona de administrare Castopod.                                |
| admin.settings          | Poate accesa setările Castopod.                                            |
| users.manage            | Poate gestiona utilizatorii Castopod.                                      |
| persons.manage          | Poate gestiona persoane.                                                   |
| pages.manage            | Poate gestiona pagini.                                                     |
| podcasts.view           | Poate vedea toate podcast-urile.                                           |
| podcasts.create         | Poate crea noi podcast-uri.                                                |
| podcasts.import         | Poate importa podcast-uri.                                                 |
| fediverse.manage-blocks | Poate bloca actorilor/domenii din fediverse să interacționeze cu Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Roluri și permisiuni per podcast

### Roluri per podcast

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| rol    | descriere                                                      | permisiuni                                                                                                                                                                                                                                                                                  |
| ------ | -------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin  | Deține controlul complet asupra podcastului #{id}.             | \*                                                                                                                                                                                                                                                                                          |
| Editor | Gestionează conținutul și publicațiile podcastului #{id}.      | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Author | Gestionează conținutul podcastului #{id} dar nu poate publica. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Guest  | Contribuitor al podcastului #{id}.                             | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Permisiuni per podcast

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permisiune                   | descriere                                                                                               |
| ---------------------------- | ------------------------------------------------------------------------------------------------------- |
| view                         | Poate vedea panoul de control și analiticele podcastului #{id}.                                         |
| edit                         | Poate edita podcastul #{id}.                                                                            |
| delete                       | Poate șterge podcastul #{id}.                                                                           |
| manage-import                | Poate sincroniza podcastul importat #{id}.                                                              |
| manage-persons               | Poate administra abonamentele podcastului #{id}.                                                        |
| manage-subscriptions         | Poate administra abonamentele podcastului #{id}.                                                        |
| manage-contributors          | Poate administra colaboratorii podcastului #{id}.                                                       |
| manage-platforms             | Poate seta/elimina link-urile podcastului #{id}.                                                        |
| manage-publications          | Poate publica podcastul #{id}.                                                                          |
| manage-notifications         | Poate vizualiza și marca notificările ca fiind citite pentru podcastul #{id}.                           |
| interact-as                  | Poate interacționa ca podcastul #{id} pentru adăuga la favorite, a distribui sau a răspunde la postări. |
| episodes.view                | Poate vizualiza panoul de control și analiticile podcastului #{id}.                                     |
| episodes.create              | Poate crea episoade pentru podcastul #{id}.                                                             |
| episodes.edit                | Poate edita podcastul #{id}.                                                                            |
| episodes.delete              | Poate șterge podcastul #{id}.                                                                           |
| episodes.manage-persons      | Poate administra abonamentele podcastului #{id}.                                                        |
| episodes.manage-clips        | Poate administra clipuri video sau biții de sunet ai podcastului #{id}.                                 |
| episodes.manage-publications | Poate publica podcastul #{id}.                                                                          |
| episodes.manage-comments     | Poate crea/elimina comentariile episodului podcastului #{id}.                                           |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
