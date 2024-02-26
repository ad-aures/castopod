---
title: Verifikacija i Odobravanje
sidebarDepth: 3
---

# Verifikacija i Odobravanje

Castopod upravlja verifikacijom i odobravanjem koristeći `codeigniter/shield` u
paru sa prilagođenim pravilima. Uloge i dozvole su definisane na dva nivoa:

1. [po nalogu](#1-instance-wide-roles-and-permissions)
2. [po podkastu](#2-per-podcast-roles-and-permissions)

## 1. Uloge i dozvole po nalogu

### Uloge po nalogu

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| role        | description                         | permissions                                                                                |
| ----------- | ----------------------------------- | ------------------------------------------------------------------------------------------ |
| Super admin | Has complete control over Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Manager     | Manages Castopod's content.         | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster   | General users of Castopod.          | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Dozvole po nalogu

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission              | description                                                        |
| ----------------------- | ------------------------------------------------------------------ |
| admin.access            | Can access the Castopod admin area.                                |
| admin.settings          | Can access the Castopod settings.                                  |
| users.manage            | Can manage Castopod users.                                         |
| persons.manage          | Can manage persons.                                                |
| pages.manage            | Can manage pages.                                                  |
| podcasts.view           | Can view all podcasts.                                             |
| podcasts.create         | Can create new podcasts.                                           |
| podcasts.import         | Can import podcasts.                                               |
| fediverse.manage-blocks | Can block fediverse actors/domains from interacting with Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Uloge i dozvole po podkastu

### Uloge po podkastu

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| role   | description                                               | permissions                                                                                                                                                                                                                                                                                 |
| ------ | --------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin  | Has complete control of podcast #{id}.                    | \*                                                                                                                                                                                                                                                                                          |
| Editor | Manages content and publications of podcast #{id}.        | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Author | Manages content of podcast #{id} but cannot publish them. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Guest  | General contributor of the podcast #{id}.                 | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Dozvole po podkastu

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
