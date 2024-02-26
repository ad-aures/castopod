---
title: Authentication & Authorization
sidebarDepth: 3
---

# Autenticação & Autorização

Castopod lida com autenticação e autorização usando `codeigniter/shield`
juntamente com regras personalizadas. Papéis e permissões são definidos em dois
níveis:

1. [toda instância](#1-instance-wide-roles-and-permissions)
2. [por podcast](#2-per-podcast-roles-and-permissions)

## Papéis e permissões para toda a instância

### Cargos de instância

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| role                | description                           | permissions                                                                                |
| ------------------- | ------------------------------------- | ------------------------------------------------------------------------------------------ |
| Super administrador | Tem controle completo sobre Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Gerente             | Gerencia o conteúdo de Castopod.      | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster           | Usuários gerais do Castopod.          | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Permissões da instância

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission              | description                                                      |
| ----------------------- | ---------------------------------------------------------------- |
| admin.access            | Pode acessar a área de administração do Castopod.                |
| admin.settings          | Pode acessar as configurações de Castopod.                       |
| users.manage            | Pode gerenciar usuários do Castopod.                             |
| persons.manage          | Pode gerenciar pessoas.                                          |
| pages.manage            | Pode gerenciar páginas.                                          |
| podcasts.view           | Pode ver todos os podcasts.                                      |
| podcasts.create         | Pode criar novos podcasts.                                       |
| podcasts.import         | Pode importar podcasts.                                          |
| fediverse.manage-blocks | Pode bloquear ator/domínios distintos de interagir com Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Por funções de podcast e permissões

### Por cargos de podcast

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| role          | description                                                    | permissions                                                                                                                                                                                                                                                                                 |
| ------------- | -------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Administrador | Tem controle completo do podcast #{id}.                        | \*                                                                                                                                                                                                                                                                                          |
| Editor        | Gerencia o conteúdo e as publicações do podcast #{id}.         | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Autor         | Gerencia o conteúdo do podcast #{id} mas não pode publicá-los. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Convidado     | Contribuidor geral do podcast #{id}.                           | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Por permissões de podcast

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission                   | description                                                                                 |
| ---------------------------- | ------------------------------------------------------------------------------------------- |
| view                         | Pode visualizar o painel de controle e análises do podcast #{id}.                           |
| edit                         | Pode editar o podcast #{id}.                                                                |
| delete                       | Pode deletar episódios do podcast #{id}.                                                    |
| manage-import                | Pode sincronizar o podcast importado #{id}.                                                 |
| manage-persons               | Pode gerenciar assinaturas do podcast #{id}.                                                |
| manage-subscriptions         | Pode gerenciar assinaturas do podcast #{id}.                                                |
| manage-contributors          | Pode gerenciar contribuidores do podcast #{id}.                                             |
| manage-platforms             | Pode definir/remover links de plataforma do podcast #{id}.                                  |
| manage-publications          | Pode publicar podcast #{id}.                                                                |
| manage-notifications         | Pode ver e marcar notificações como lidas para o podcast #{id}.                             |
| interact-as                  | Pode interagir com o podcast #{id} para favorito, compartilhar ou responder às publicações. |
| episodes.view                | Pode visualizar o painel de controle e análises do podcast #{id}.                           |
| episodes.create              | Pode criar episódios para o podcast #{id}.                                                  |
| episodes.edit                | Pode editar o podcast #{id}.                                                                |
| episodes.delete              | Pode deletar episódios do podcast #{id}.                                                    |
| episodes.manage-persons      | Pode gerenciar assinaturas do podcast #{id}.                                                |
| episodes.manage-clips        | Pode gerenciar clipes de vídeo ou sons de episódios do podcast #{id}.                       |
| episodes.manage-publications | Pode publicar podcast #{id}.                                                                |
| episodes.manage-comments     | Pode criar/remover comentários de episódio do podcast #{id}.                                |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
