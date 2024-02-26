---
title: Authentication & Authorization
sidebarDepth: 3
---

# Authentication & Authorization

Castopod handles authentication and authorization using `codeigniter/shield`
coupled with custom rules. Roles and permissions are defined at two levels:

1. [instance wide](#1-instance-wide-roles-and-permissions)
2. [per podcast](#2-per-podcast-roles-and-permissions)

## 1. Instance wide roles and permissions

### Instance roles

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| role                | description                             | permissions                                                                                |
| ------------------- | --------------------------------------- | ------------------------------------------------------------------------------------------ |
| Super administratör | Har fullständig kontroll över Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Hanterare           | Hanterar Castopods innehåll.            | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster           | Generella användare av Castopod.        | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Instance permissions

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission              | description                                                                   |
| ----------------------- | ----------------------------------------------------------------------------- |
| admin.access            | Kan komma åt Castopod admin-området.                                          |
| admin.settings          | Kan komma åt Castopod-inställningarna.                                        |
| users.manage            | Kan hantera Castopod-användare.                                               |
| persons.manage          | Kan hantera personer.                                                         |
| pages.manage            | Kan hantera sidor.                                                            |
| podcasts.view           | Kan se alla podcasts.                                                         |
| podcasts.create         | Kan skapa nya podcasts.                                                       |
| podcasts.import         | Kan importera podcasts.                                                       |
| fediverse.manage-blocks | Kan blockera fediverse skådespelare/domäner från att interagera med Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Per podcast roles and permissions

### Per podcast roles

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| role       | description                                                   | permissions                                                                                                                                                                                                                                                                                 |
| ---------- | ------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin      | Har fullständig kontroll över podcast #{id}.                  | \*                                                                                                                                                                                                                                                                                          |
| Redigerare | Hanterar innehåll och publikationer i podcast #{id}.          | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Författare | Hanterar innehåll i podcast #{id} men kan inte publicera dem. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Gäst       | Generell bidragsgivare till podcasten #{id}.                  | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Per podcast permissions

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission                   | description                                                                      |
| ---------------------------- | -------------------------------------------------------------------------------- |
| view                         | Kan visa instrumentpanelen och analysen av podcast #{id}.                        |
| edit                         | Kan redigera podcast #{id}.                                                      |
| delete                       | Kan ta bort podcast #{id}.                                                       |
| manage-import                | Kan synkronisera importerad podcast #{id}.                                       |
| manage-persons               | Kan hantera prenumerationer på podcast #{id}.                                    |
| manage-subscriptions         | Kan hantera prenumerationer på podcast #{id}.                                    |
| manage-contributors          | Kan hantera bidragsgivare för podcast #{id}.                                     |
| manage-platforms             | Kan sätta/ta bort plattformslänkar för podcast #{id}.                            |
| manage-publications          | Kan publicera podcast #{id}.                                                     |
| manage-notifications         | Can view and mark notifications as read for podcast #{id}.                       |
| interact-as                  | Kan interagera som podcasten #{id} för att favorita, dela eller svara på inlägg. |
| episodes.view                | Kan visa instrumentpanelen och analysen av podcast #{id}.                        |
| episodes.create              | Kan skapa avsnitt för podcast #{id}.                                             |
| episodes.edit                | Kan redigera podcast #{id}.                                                      |
| episodes.delete              | Kan ta bort podcast #{id}.                                                       |
| episodes.manage-persons      | Kan hantera prenumerationer på podcast #{id}.                                    |
| episodes.manage-clips        | Kan hantera videoklipp eller ljudklipp från podcasten #{id}.                     |
| episodes.manage-publications | Kan publicera podcast #{id}.                                                     |
| episodes.manage-comments     | Kan skapa/ta bort avsnitt kommentarer från podcasten #{id}.                      |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
