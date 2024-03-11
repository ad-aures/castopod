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

| cargos      | descrição                             | permissões                                                                                 |
| ----------- | ------------------------------------- | ------------------------------------------------------------------------------------------ |
| Super admin | Tem controle completo sobre Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Gerentes    | Gerencia o conteúdo de Castopod.      | criar.podcasts, importar.podcasts, gerenciar.pessoas, gerenciar.páginas                    |
| Podcaster   | Usuários gerais do Castopod.          | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Permissões da instância

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permissões              | descrição                                                        |
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

| cargos    | descrição                                                      | permissões                                                                                                                                                                                                                                                                                                                          |
| --------- | -------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Admin     | Tem controle completo de podcast #{id}.                        | \*                                                                                                                                                                                                                                                                                                                                  |
| Editor    | Gerencia o conteúdo e as publicações do podcast #{id}.         | visualizar, editar, gerenciar-importação, gerenciar-pessoas, gerenciar-plataformas, gerenciar-publicações, gerenciar-notificações, interagir-com, visualizar.episódios, criar.episódios,deletar.episódios, gerenciar-pessoas.episódios, gerenciar-clips.episódios, gerenciar-publicações.episódios, gerenciar-comentários.episódios |
| Autor     | Gerencia o conteúdo do podcast #{id} mas não pode publicá-los. | visualizar, gerenciar-pessoas, visualizar.episódios, criar.episódios, editar.episódios, gerenciar-pessoas.episódios, gerenciar-clips.episódios                                                                                                                                                                                      |
| Convidado | Contribuidor geral do podcast #{id}.                           | visualizar, visualizar.episódios                                                                                                                                                                                                                                                                                                    |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Por permissões de podcast

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permissões                        | descrição                                                                                   |
| --------------------------------- | ------------------------------------------------------------------------------------------- |
| visualizar                        | Pode visualizar o painel de controle e análise de podcast #{id}.                            |
| editar                            | Pode editar podcast #{id}.                                                                  |
| excluir                           | Pode excluir o podcast #{id}.                                                               |
| gerenciar-importações             | Pode sincronizar o podcast importado #{id}.                                                 |
| gerenciar-pessoas                 | Pode gerenciar assinantes de podcast #{id}.                                                 |
| gerenciar-assinaturas             | Pode gerenciar assinaturas de podcast #{id}.                                                |
| gerente-contribuidores            | Pode gerenciar contribuidores do podcast #{id}.                                             |
| gerenciar-plataformas             | Pode definir/remover links de plataforma do podcast #{id}.                                  |
| gerencie-publicações              | Pode publicar podcast #{id}.                                                                |
| gerenciar-notificações            | Pode ver e marcar notificações como lidas para o podcast #{id}.                             |
| interagir-como                    | Pode interagir com o podcast #{id} para favorito, compartilhar ou responder às publicações. |
| visualizar.episódios              | Pode visualizar o painel de controle e análise de podcast #{id}.                            |
| criar.episódio                    | Pode criar episódios para o podcast #{id}.                                                  |
| editar.episódios                  | Pode editar o podcast #{id}.                                                                |
| deletar.episódios                 | Pode deletar episódios do podcast #{id}.                                                    |
| gerenciar-pessoas.episódios       | Pode gerenciar assinaturas de episódios do podcast #{id}.                                   |
| gerenciar-clips.episódios         | Pode gerenciar clipes de vídeo ou sons de episódios do podcast #{id}.                       |
| gerenciar-publicações.episódios   | Pode publicar episódios do podcast #{id}.                                                   |
| gerenteciar-comentários.episódios | Pode criar/remover comentários de episódio do podcast #{id}.                                |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
