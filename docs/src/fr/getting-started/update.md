---
title: Mise à jour
sidebarDepth: 3
---

# Comment installer Castopod ?

Après avoir installé Castopod, vous pouvez mettre à jour votre instance vers la
dernière version afin de profiter des dernières fonctionnalités ✨, des
corrections de bugs 🐛 et des améliorations de performance ⚡.

## Instructions de mise à jour

0. ⚠️ Avant toute mise à jour, nous vous recommandons fortement de sauvegarder
   vos fichiers Castopod et la base de données .

   - cf.
     [Should I make a backup before updating?](#should-i-make-a-backup-before-updating)

1. Go to the
   [releases page](https://code.castopod.org/adaures/castopod/-/releases) and
   see if your instance is up to date with the latest Castopod version

   - cf.
     [Where can I find my Castopod version?](#where-can-i-find-my-castopod-version)

2. Download the latest release package named `Castopod Package`, you may choose
   between the `zip` or `tar.gz` archives

   - ⚠️ Make sure you download the Castopod Package and **NOT** the Source Code
   - Note that you can also download the latest package from
     [castopod.org](https://castopod.org/)

3. Sur votre serveur :

   - Supprimer tous les fichiers sauf `.env` et `public/media`
   - Copiez les nouveaux fichiers du paquet téléchargé sur votre serveur

     ::: info Note

     Vous devrez peut-être re-définir les autorisations de fichiers comme
     effectué durant le processus d'installation. Check
     [Security Concerns](./security.md).

     :::

4. Update your database schema from your `Castopod Admin` > `About` page or by
   running:

   ```bash
   php spark castopod:database-update
   ```

5. Clear your cache from your `Castopod Admin` > `Settings` > `general` >
   `Housekeeping`
6. ✨Profitez de votre nouvelle instance, vous avez terminé !

::: info Note

Les versions peuvent être accompagnées d'instructions de mise à jour
supplémentaires (cf. la
[page des notes de versions](https://code.castopod.org/adaures/castopod/-/releases)).

- cf.
  [Je n'ai pas mis à jour mon instance depuis longtemps… Que devrais-je faire ?](#je-nai-pas-mis-à-jour-mon-instance-depuis-longtemps-que-devrais-je-faire)

:::

## Mises à jour entièrement automatisées

> Prochainement... 👀

## Foire Aux Questions (FAQ)

### Où puis-je trouver ma version de Castopod ?

Allez dans votre panneau d'administration de Castopod, la version s'affiche en
bas à gauche.

Vous pouvez également trouver la version dans l'application
`> Configuration > Constantes.php` dossier.

### Je n'ai pas mis à jour mon instance depuis longtemps… Que devrais-je faire ?

Pas de problème ! Il suffit d'obtenir la dernière version comme décrit
ci-dessus. Lorsque vous exécutez les instructions de mise à jour (4), lancez-les
séquentiellement, de la plus ancienne à la plus récente.

> Vous devriez sauvegarder votre instance selon la date de votre dernière mise à
> jour de Castopod.

Par exemple, si vous êtes en `v1.0.0-alpha.42` et souhaitez mettre à jour vers
la `v1.0.0-beta.1` :

0. (fortement recommandé) Faites une sauvegarde de vos fichiers et de votre base
   de données.

1. Téléchargez la dernière version, écrasez vos fichiers tout en conservant
   `.env` et `public/media`.

2. Effectuez les instructions de mise à jour l'une après l'autre (de la plus
   ancienne à la plus récente).

3. ✨ Votre nouvelle instance est prête !

### Dois-je faire une sauvegarde avant de mettre à jour ?

Nous vous conseillons de le faire, afin de ne pas tout perdre si quelque chose
se passait mal !

Plus généralement, nous vous conseillons de faire des sauvegardes régulières de
vos fichiers Castopod et de votre base de données afin d'éviter de tout perdre…
