---
title: Godkjenning & Autorisasjon
sidebarDepth: 3
---

# Godkjenning & Autorisasjon

Castopod tek seg av godkjenning og autorisasjon med `codeigniter/shield` saman
med nokre eigne reglar. Roller og løyve er definerte på to nivå:

1. [for heile nettstaden](#1-instance-wide-roles-and-permissions)
2. [for kvar podkast](#2-per-podcast-roles-and-permissions)

## 1. Roller og løyve for heile nettstaden

### Roller på nettstaden

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| rolle       | skildring                        | løyve                                                                                      |
| ----------- | -------------------------------- | ------------------------------------------------------------------------------------------ |
| Superstyrar | Har full kontroll over Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Leiar       | Styrer innhaldet på Castopod.    | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podkastar   | Vanlege Castopod-brukarar.       | admin.tilgang                                                                              |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Løyve på nettstaden

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| løyve                   | skildring                                                              |
| ----------------------- | ---------------------------------------------------------------------- |
| admin.access            | Kan bruka styringspanelet for Castopod.                                |
| admin.settings          | Kan få tilgang til innstillingane for Castopod.                        |
| users.manage            | Kan handtera Castopod-brukarar.                                        |
| persons.manage          | Kan handtera folk.                                                     |
| pages.manage            | Kan handtera sider.                                                    |
| podcasts.view           | Kan sjå alle podkastane.                                               |
| podcasts.create         | Kan laga nye podkastar.                                                |
| podcasts.import         | Kan importera podkastar.                                               |
| fediverse.manage-blocks | Kan blokkera folk og domene på allheimen frå å samhandla med Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Roller og løyve pr. podkast

### Roller pr. podkast

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| rolle         | skildring                                                        | løyve                                                                                                                                                                                                                                                                                       |
| ------------- | ---------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Administrator | Har full kontroll over podkasten #{id}.                          | \*                                                                                                                                                                                                                                                                                          |
| Redaktør      | Styrer innhald og publisering for podkasten #{id}.               | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Skapar        | Styrer innhald for podkasten #{id}, men kan ikkje publisera dei. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Gjest         | Vanleg bidragsytar til podkasten #{id}.                          | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Løyve pr. podkast

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| løyve                        | description                                                        |
| ---------------------------- | ------------------------------------------------------------------ |
| view                         | Kan sjå styringspanelet og analysedata for podkasten #{id}.        |
| edit                         | Kan redigera podkasten #{id}.                                      |
| delete                       | Kan sletta podkasten #{id}.                                        |
| manage-import                | Kan synkronisera den importerte podkasten #{id}.                   |
| manage-persons               | Kan handtera abonnement for podkasten #{id}.                       |
| manage-subscriptions         | Kan handtera abonnement for podkasten #{id}.                       |
| manage-contributors          | Kan handtera bidragsytarar for podkasten #{id}.                    |
| manage-platforms             | Kan oppretta og fjerna plattformlenkjer for podkasten #{id}.       |
| manage-publications          | Kan publisera podkasten #{id}.                                     |
| manage-notifications         | Kan lesa og merka varsel som lesne for podkasten #{id}.            |
| interact-as                  | Kan merka podkasten #{id} som favoritt, dela og svara på innlegg.  |
| episodes.view                | Kan sjå styringspanelet og analysedata for podkasten #{id}.        |
| episodes.create              | Kan laga epoisodar for podkasten #{id}.                            |
| episodes.edit                | Kan redigera podkasten #{id}.                                      |
| episodes.delete              | Kan sletta podkasten #{id}.                                        |
| episodes.manage-persons      | Kan handtera abonnement for podkasten #{id}.                       |
| episodes.manage-clips        | Kan handtera film- og lydklypp av podkasten #{id}.                 |
| episodes.manage-publications | Kan publisera podkasten #{id}.                                     |
| episodes.manage-comments     | Kan skriva og sletta kommentarar til episodane av podkasten #{id}. |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
