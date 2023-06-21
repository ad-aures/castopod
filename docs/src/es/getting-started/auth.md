---
title: Autenticación & Autenticación
sidebarDepth: 3
---

# Autenticación & Autenticación

Castopod gestiona la autenticación y autorización usando `codeignitor/escudo`
emparejado con reglas personalizadas. Los roles y permisos se definen en dos
niveles:

1. [por instancia](#1-instance-wide-roles-and-permissions)
2. [por podcast](#2-per-podcast-roles-and-permissions)

## 1. Roles por instancia y permisos

### Roles de instancia

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| roles               | descripción                            | permisos                                                                                   |
| ------------------- | -------------------------------------- | ------------------------------------------------------------------------------------------ |
| Super administrador | Tiene control completo sobre Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Administrador       | Gestiona el contenido de Castopod.     | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster           | Usuarios generales de Castopod.        | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Permisos de instancia

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permisos                | descripción                                                                    |
| ----------------------- | ------------------------------------------------------------------------------ |
| admin.access            | Puedes acceder al área de administración de Castopod.                          |
| admin.settings          | Puede acceder a la configuración de Castopod.                                  |
| users.manage            | Puede administrar usuarios de Castopod.                                        |
| persons.manage          | Puede administrar personas.                                                    |
| pages.manage            | Puede administrar páginas.                                                     |
| podcasts.view           | Puede ver todos los podcasts.                                                  |
| podcasts.create         | Puede crear nuevos podcasts.                                                   |
| podcasts.import         | Puede importar podcasts.                                                       |
| fediverse.manage-blocks | Puedes bloquear la interacción de actores/dominios del fediverso con Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Permisos y roles por podcast

### Roles por podcast

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| roles         | descripción                                                       | permisos                                                                                                                                                                                                                                                                                    |
| ------------- | ----------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Administrador | Tiene el control completo del podcast #{id}.                      | \*                                                                                                                                                                                                                                                                                          |
| Editor        | Gestiona el contenido y las publicaciones del podcast #{id}.      | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Autor         | Gestiona el contenido del podcast #{id} pero no puede publicarlo. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Invitado      | Colaborador general del podcast #{id}.                            | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Permisos por podcast

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permisos                     | descripción                                                                                        |
| ---------------------------- | -------------------------------------------------------------------------------------------------- |
| view                         | Puede ver el panel de control y análisis del podcast #{id}.                                        |
| edit                         | Puede editar podcast #{id}.                                                                        |
| delete                       | Puede borrar el podcast #{id}.                                                                     |
| manage-import                | Puede sincronizar el podcast importado #{id}.                                                      |
| manage-persons               | Puede administrar las suscripciones del podcast #{id}.                                             |
| manage-subscriptions         | Puede administrar las suscripciones del podcast #{id}.                                             |
| manage-contributors          | Puede administrar colaboradores del podcast #{id}.                                                 |
| manage-platforms             | Puede establecer/eliminar enlaces a la plataforma del podcast #{id}.                               |
| manage-publications          | Puede publicar el podcast #{id}.                                                                   |
| manage-notifications         | Puede ver y marcar las notificaciones como leídas para podcast #{id}.                              |
| interact-as                  | Puede interactuar como el podcast #{id} para favoritar, compartir o responder a las publicaciones. |
| episodes.view                | Puede ver el panel de control y analíticas del episodio #{id}.                                     |
| episodes.create              | Puede crear episodios para el podcast #{id}.                                                       |
| episodes.edit                | Puede editar episodios #{id}.                                                                      |
| episodes.delete              | Puede borrar el podcast #{id}.                                                                     |
| episodes.manage-persons      | Puede administrar las suscripciones del podcast #{id}.                                             |
| episodes.manage-clips        | Puedes administrar video clips o sonidos del podcast #{id}.                                        |
| episodes.manage-publications | Puede publicar el podcast #{id}.                                                                   |
| episodes.manage-comments     | Puede crear/eliminar los comentarios de episodio del podcast #{id}.                                |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
