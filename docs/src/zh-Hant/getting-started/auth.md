---
title: 認證 & 授權
sidebarDepth: 3
---

# 認證 & 授權

Castopod 使用 `codeigniter/shield` 處理身分認證和授權 與自定義規則。 腳色和權限
在定義為兩個層級：

1. [實例範圍](#1-instance-wide-roles-and-permissions)
2. [每個播客](#2-per-podcast-roles-and-permissions)

## 1. 實例範圍的腳色和權限

### 實例腳色

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| 腳色        | 說明                                | 權限                                                                                       |
| ----------- | ----------------------------------- | ------------------------------------------------------------------------------------------ |
| Super admin | Has complete control over Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Manager     | Manages Castopod's content.         | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster   | General users of Castopod.          | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### 實例權限

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| 權限                    | 說明                                                               |
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

## 2. 每個播客腳色與權限

### 每個播客腳色

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| 腳色   | 說明                                                      | 權限                                                                                                                                                                                                                                                                                        |
| ------ | --------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin  | Has complete control of podcast #{id}.                    | \*                                                                                                                                                                                                                                                                                          |
| Editor | Manages content and publications of podcast #{id}.        | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Author | Manages content of podcast #{id} but cannot publish them. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Guest  | General contributor of the podcast #{id}.                 | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### 每個播客權限

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| 權限                         | 說明                                                                     |
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
