---
title: Authentication & Authorization
sidebarDepth: 3
---

# Authenticatie & Autorisatie

Castopod gebruikt voor de authenticatie en autorisatie `codeigniter/schild` met
een aantal aangepaste regels. Rollen en permissies zijn gedefinieerd op twee
niveaus:

1. [globaal: serverbreed](#1-instance-wide-roles-and-permissions)
2. [per podcast](#2-per-podcast-roles-and-permissions)

## 1. Globale rollen en rechten

### Globale rollen

<!-- AUTH-INSTANCE-ROLES-LIST:START - Do not remove or modify this section -->

| rol         | omschrijving                               | rechten                                                                                    |
| ----------- | ------------------------------------------ | ------------------------------------------------------------------------------------------ |
| Super admin | Heeft de volledige controle over Castopod. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Beheerder   | Beheert de inhoud van Castopod.            | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podcaster   | Algemene gebruikers van Castopod.          | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Globale rechten

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| recht                   | omschrijving                                                         |
| ----------------------- | -------------------------------------------------------------------- |
| admin.access            | Kan toegang krijgen tot de beheeromgeving van Castopod.              |
| admin.settings          | Kan toegang krijgen tot de instellingen van Castopod.                |
| users.manage            | Kan Castopod-gebruikers beheren.                                     |
| persons.manage          | Kan personen beheren.                                                |
| pages.manage            | Kan pagina's beheren.                                                |
| podcasts.view           | Kan alle podcasts bekijken.                                          |
| podcasts.create         | Kan nieuwe podcast aanmaken.                                         |
| podcasts.import         | Kan podcasts importeren.                                             |
| fediverse.manage-blocks | Kan fediverse actors/domains blokkeren voor interactie met Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Per podcast rollen en permissies

### Per podcast rollen

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| rol       | omschrijving                                                       | rechten                                                                                                                                                                                                                                                                                     |
| --------- | ------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Beheerder | Heeft de volledige controle over podcast #{id}.                    | \*                                                                                                                                                                                                                                                                                          |
| Editor    | Beheert inhoud en publicaties van podcast #{id}.                   | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Auteur    | Beheert de inhoud van podcast #{id} maar kan deze niet publiceren. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Gast      | Algemene bijdrager van podcast #{id}.                              | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Per aflevering rollen

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| recht                        | omschrijving                                                                           |
| ---------------------------- | -------------------------------------------------------------------------------------- |
| weergeven                    | Kan dashboard en statistieken van podcast #{id} zien.                                  |
| bewerken                     | Kan podcast #{id} wijzigen.                                                            |
| verwijderen                  | Kan podcast #{id} verwijderen.                                                         |
| manage-import                | Kan de geïmporteerde podcast #{id} synchroniseren.                                     |
| manage-persons               | Kan personen van podcast #{id} beheren.                                                |
| manage-subscriptions         | Kan abonnees van podcast #{id} beheren.                                                |
| manage-contributors          | Kan bijdragers van podcast #{id} beheren.                                              |
| manage-platforms             | Kan platform links van podcast #{id} instellen of verwijderen.                         |
| manage-publications          | Kan podcast #{id} publiceren.                                                          |
| manage-notifications         | Kan meldingen voor podcast #{id} bekijken en als gelezen markeren.                     |
| interact-as                  | Kan als podcast #{id} handelen om te favorieten, te delen of te reageren op berichten. |
| episodes.view                | Kan dashboard en statistieken van podcast #{id} zien.                                  |
| episodes.create              | Kan afleveringen voor podcast #{id} aanmaken.                                          |
| episodes.edit                | Kan afleveringen van podcast #{id} wijzigen.                                           |
| episodes.delete              | Kan afleveringen van podcast #{id} verwijderen.                                        |
| episodes.manage-persons      | Kan personen in aflevering van podcast #{id} beheren.                                  |
| episodes.manage-clips        | Kan videoclips of soundbites van podcast #{id} beheren.                                |
| episodes.manage-publications | Kan afleveringen van podcast #{id} publiceren.                                         |
| episodes.manage-comments     | Kan reacties op afleveringen van podcast #{id} maken of verwijderen.                   |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
