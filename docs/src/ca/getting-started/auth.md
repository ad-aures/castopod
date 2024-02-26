---
title: Autenticació i Autorització
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

| role                | description                          | permissions                                                                                |
| ------------------- | ------------------------------------ | ------------------------------------------------------------------------------------------ |
| Super administrador | Té control complet sobre Castopod.   | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Administrador       | Administra el contingut de Castopod. | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster           | Usos generals de Castopod.           | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Instance permissions

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission              | description                                                          |
| ----------------------- | -------------------------------------------------------------------- |
| admin.access            | Pot accedir a l'àrea d'administració de Castopod.                    |
| admin.settings          | Pot accedir a la configuració de Castopod.                           |
| users.manage            | Pot administrar els usuaris de Castopod.                             |
| persons.manage          | Pot administrar persones.                                            |
| pages.manage            | Pot administrar pàgines.                                             |
| podcasts.view           | Pot veure els pòdcasts.                                              |
| podcasts.create         | Pot crear nous pòdcasts.                                             |
| podcasts.import         | Pot importar pòdcasts.                                               |
| fediverse.manage-blocks | Pot evitar que actors/dominis del fedivers interactuen amb Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Per podcast roles and permissions

### Per podcast roles

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| role          | description                                                        | permissions                                                                                                                                                                                                                                                                                 |
| ------------- | ------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Administrador | Té control complet del pòdcast #{id}.                              | \*                                                                                                                                                                                                                                                                                          |
| Editor        | Administra els continguts i la publicació del pòdcast #{id}.       | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Autor         | Administra el contingut del podcast #{id} però no el pot publicar. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Convidat      | Col·laborador general del podcast #{id}.                           | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Per podcast permissions

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission                   | description                                                                                                          |
| ---------------------------- | -------------------------------------------------------------------------------------------------------------------- |
| view                         | Pot veure el tauler i les estadístiques del podcast #{id}.                                                           |
| edit                         | Pot editar el podcast #{id}.                                                                                         |
| delete                       | Pot suprimir el podcast #{id}.                                                                                       |
| manage-import                | Pot sincronitzar el podcast importat #{id}.                                                                          |
| manage-persons               | Pot gestionar les subscripcions del podcast #{id}.                                                                   |
| manage-subscriptions         | Pot gestionar les subscripcions del podcast #{id}.                                                                   |
| manage-contributors          | Pot gestionar els col·laboradors del podcast #{id}.                                                                  |
| manage-platforms             | Pot establir/eliminar enllaços de plataforma del podcast #{id}.                                                      |
| manage-publications          | Pot publicar el podcast #{id}.                                                                                       |
| manage-notifications         | Pot veure i marcar les notificacions com a llegides per al podcast #{id}.                                            |
| interact-as                  | Pot interactuar en nom del podcast #{id} per marcar les publicacions com a preferides, compartir-les o respondre-hi. |
| episodes.view                | Pot veure el tauler i les estadístiques del podcast #{id}.                                                           |
| episodes.create              | Pot crear episodis per al podcast #{id}.                                                                             |
| episodes.edit                | Pot editar el podcast #{id}.                                                                                         |
| episodes.delete              | Pot suprimir el podcast #{id}.                                                                                       |
| episodes.manage-persons      | Pot gestionar les subscripcions del podcast #{id}.                                                                   |
| episodes.manage-clips        | Pot gestionar clips de vídeo o fragments de so del pòdcast #{id}.                                                    |
| episodes.manage-publications | Pot publicar el podcast #{id}.                                                                                       |
| episodes.manage-comments     | Pot crear/eliminar comentaris d'episodi del pòdcast #{id}.                                                           |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
