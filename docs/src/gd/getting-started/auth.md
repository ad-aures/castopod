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

| role            | description                             | permissions                                                                                |
| --------------- | --------------------------------------- | ------------------------------------------------------------------------------------------ |
| Sàr-rianaire    | Smachd gu lèir air Castopod.            | admin.\*, podcasts.\*, users.manage, persons.manage, pages.manage, fediverse.manage-blocks |
| Manaidsear      | Stiùireadh susbaint Chastopod.          | podcasts.create, podcasts.import, persons.manage, pages.manage                             |
| Pod-chraoladair | Luchd-cleachdaidh coitcheann Chastopod. | admin.access                                                                               |

<!-- AUTH-INSTANCE-ROLES-LIST:END -->

### Instance permissions

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission              | description                                                                                   |
| ----------------------- | --------------------------------------------------------------------------------------------- |
| admin.access            | ’S urrainn dhaibh raon rianachd Chastopod inntrigeadh.                                        |
| admin.settings          | ’S urrainn dhaibh roghainnean Chastopod inntrigeadh.                                          |
| users.manage            | ’S urrainn dhaibh luchdc-leachdaidh Chastopod a stiùireadh.                                   |
| persons.manage          | ’S urrainn dhaibh daoine a stiùireadh.                                                        |
| pages.manage            | ’S urrainn dhaibh duilleagan a stiùireadh.                                                    |
| podcasts.view           | Chì iad a h-uile pod-chraoladh.                                                               |
| podcasts.create         | ’S urrainn dhaibh pod-chraolaidhean ùra a chruthachadh.                                       |
| podcasts.import         | ’S urrainn dhaibh pod-chraolaidhean ion-phortadh.                                             |
| fediverse.manage-blocks | ’S urrainn dhaibh actairean/àrainnean a cho-shaoghail a bhacadh o eadar-ghabhail le Castopod. |

<!-- AUTH-INSTANCE-PERMISSIONS-LIST:END -->

## 2. Per podcast roles and permissions

### Per podcast roles

<!-- AUTH-PODCAST-ROLES-LIST:START - Do not remove or modify this section -->

| role      | description                                                                    | permissions                                                                                                                                                                                                                                                                                 |
| --------- | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Rianaire  | Smachd gu lèir air air a’ phod-chraoladh #{id}.                                | \*                                                                                                                                                                                                                                                                                          |
| Deasaiche | A’ stiùireadh susbaint is foillseachaidhean a’ phod-chraoladh #{id}.           | view, edit, manage-import, manage-persons, manage-platforms, manage-publications, manage-notifications, interact-as, episodes.view, episodes.create, episodes.edit, episodes.delete, episodes.manage-persons, episodes.manage-clips, episodes.manage-publications, episodes.manage-comments |
| Ùghdar    | A’ stiùireadh susbaint a’ phod-chraolaidh #{id} ach gun chomas foillseachaidh. | view, manage-persons, episodes.view, episodes.create, episodes.edit, episodes.manage-persons, episodes.manage-clips                                                                                                                                                                         |
| Aoigh     | Neach-cuideachaidh a’ phod-chraolaidh #{id}.                                   | view, episodes.view                                                                                                                                                                                                                                                                         |

<!-- AUTH-PODCAST-ROLES-LIST:END -->

### Per podcast permissions

<!-- AUTH-PODCAST-PERMISSIONS-LIST:START - Do not remove or modify this section -->

| permission                   | description                                                                                                                |
| ---------------------------- | -------------------------------------------------------------------------------------------------------------------------- |
| view                         | Cead an deas-bhòrd agus anailiseachd a’ phod-chraolaidh #{id} a shealltainn.                                               |
| edit                         | ’S urrainn dhaibh am pod-chraoladh #{id} a dheasachadh.                                                                    |
| delete                       | ’S urrainn dhaibh am pod-chraoladh #{id} a sguabadh às.                                                                    |
| manage-import                | ’S urrainn dhaibh am pod-chraoladh #{id} air ion-phortadh a shioncronachadh.                                               |
| manage-persons               | ’S urrainn dhaibh na fo-sgrìobhaidhean air a’ phod-chraoladh #{id} a stiùireadh.                                           |
| manage-subscriptions         | ’S urrainn dhaibh na fo-sgrìobhaidhean air a’ phod-chraoladh #{id} a stiùireadh.                                           |
| manage-contributors          | ’S urrainn dhaibh an luchd-cuideachaidh aig a’ phod-chraoladh #{id} a stiùireadh.                                          |
| manage-platforms             | ’S urrainn dhaibh ceanglaichean-ùrlair a’ phod-chraolaidh #{id} a shuidheachadh/a thoirt air falbh.                        |
| manage-publications          | ’S urrainn dhaibh am pod-chraoladh #{id} fhoillseachadh.                                                                   |
| manage-notifications         | Chì iad brathan a’ phod-chraolaidh #{id} agus ’s urrainn dhaibh comharra a chur gun deach an leughadh.                     |
| interact-as                  | ’S urrainn dhaibh eadar-ghabhail ’na phod-chraoladh #{id} airson annsachdan, co-roinneadh is freagairtean do phostaichean. |
| episodes.view                | Cead an deas-bhòrd agus anailiseachd a’ phod-chraolaidh #{id} a shealltainn.                                               |
| episodes.create              | ’S urrainn dhaibh eapasodan a chruthachadh dhan phod-chraoladh #{id}.                                                      |
| episodes.edit                | ’S urrainn dhaibh am pod-chraoladh #{id} a dheasachadh.                                                                    |
| episodes.delete              | ’S urrainn dhaibh am pod-chraoladh #{id} a sguabadh às.                                                                    |
| episodes.manage-persons      | ’S urrainn dhaibh na fo-sgrìobhaidhean air a’ phod-chraoladh #{id} a stiùireadh.                                           |
| episodes.manage-clips        | ’S urrainn dhaibh cliopaichean video no blasan-fuaime aig a’ phod-chraoladh #{id} a stiùireadh.                            |
| episodes.manage-publications | ’S urrainn dhaibh am pod-chraoladh #{id} fhoillseachadh.                                                                   |
| episodes.manage-comments     | ’S urrainn dhaibh beachdan air eapasod a’ phod-chraolaidh #{id} a chruthachadh/a thoirt air falbh.                         |

<!-- AUTH-PODCAST-PERMISSIONS-LIST:END -->
