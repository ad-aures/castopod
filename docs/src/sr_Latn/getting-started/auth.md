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

| uloga               | opis                                         | dozvola                                                                                    |
| ------------------- | -------------------------------------------- | ------------------------------------------------------------------------------------------ |
| Super administrator | Ima kompletnu kontrolu nad Castopod nalogom. | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Menadžer            | Upravlja sadržajem na Castopod-u.            | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Podkaster           | Opšti korisnici Castopod-a.                  | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Dozvole po nalogu

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| dozvola                 | opis                                                            |
| ----------------------- | --------------------------------------------------------------- |
| admin.access            | Može pristupiti administratorskom delu Castopod-a.              |
| admin.settings          | Može pristupiti podešavanjima Castopod-a.                       |
| users.manage            | Može upravljati korisnicima Castopod-a.                         |
| persons.manage          | Može upravljati osobama.                                        |
| pages.manage            | Može upravljati stranicama.                                     |
| podcasts.view           | Može videti sve podkaste.                                       |
| podcasts.create         | Može napraviti nove podkaste.                                   |
| podcasts.import         | Može uvesti nove podkaste.                                      |
| fediverse.manage-blocks | Može blokirati interakciju Castopoda i fediverse naloga/domena. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Uloge i dozvole po podkastu

### Uloge po podkastu

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| uloga         | opis                                                        | dozvola                                                                                                                                                                                                                                                                                     |
| ------------- | ----------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Administrator | Ima kompletnu kontrolu nad podkastom #{id}.                 | \*                                                                                                                                                                                                                                                                                          |
| Urednik       | Upravlja sadržajem i objavama podkasta #{id}.               | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Autor         | Upravlja sadržajem podkasta #{id} ali ne može da ga objavi. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Gost          | Saradnik na podkastu #{id}.                                 | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Dozvole po podkastu

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| dozvola                      | opis                                                                                   |
| ---------------------------- | -------------------------------------------------------------------------------------- |
| view                         | Može videti upravljačku tablu i analitiku podkasta #{id}.                              |
| edit                         | Može uređivati podkast #{id}.                                                          |
| delete                       | Može obrisati podkast #{id}.                                                           |
| manage-import                | Može upravljati uvozom podkasta #{id}.                                                 |
| manage-persons               | Može upravljati osobama na podkastu #{id}.                                             |
| manage-subscriptions         | Može upravljati pretplatama na podkast #{id}.                                          |
| manage-contributors          | Može upravljati saradnicima na podkastu #{id}.                                         |
| manage-platforms             | Može ubaciti/izbaciti veze ka platformama podkasta #{id}.                              |
| manage-publications          | Može objaviti podkast #{id}.                                                           |
| manage-notifications         | Može videti obaveštenja i označiti ih kao pročitana za podkast #{id}.                  |
| interact-as                  | Može da komunicira kao podkast #{id} i deli, odgovara na i stavlja u omiljene postove. |
| episodes.view                | Može videti upravljačku tablu i analitiku podkasta #{id}.                              |
| episodes.create              | Može napraviti epizodu podkasta #{id}.                                                 |
| episodes.edit                | Može uređivati epizodu podkasta #{id}.                                                 |
| episodes.delete              | Može obrisati epizodu podkasta #{id}.                                                  |
| episodes.manage-persons      | Može upravljati pretplatama na podkast #{id}.                                          |
| episodes.manage-clips        | Može upravljati video klipovima i zvučnim isečcima podkasta #{id}.                     |
| episodes.manage-publications | Može objaviti podkast #{id}.                                                           |
| episodes.manage-comments     | Može dodati/obrisati komentar na epizodi podkasta #{id}.                               |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
