---
title: Update
sidebarDepth: 3
---

# How to update Castopod?

After installing Castopod, you may want to update your instance to the latest
version in order to enjoy the latest features ✨, bug fixes 🐛 and performance
improvements ⚡.

## Automatic update instructions

> Coming soon... 👀

## Manual update instructions

1. Go to the
   [releases page](https://code.castopod.org/adaures/castopod/-/releases) and
   see if your instance is up to date with the latest Castopod version

   - cf.
     [Where can I find my Castopod version?](#where-can-i-find-my-castopod-version)

2. Download the latest release package named `Castopod Package`, you may choose
   between the `zip` or `tar.gz` archives

   - ⚠️ Make sure you download the Castopod Package and **NOT** the Source Code

3. On your server:

   - Remove all files except `.env` and `public/media`
   - Copy the new files from the downloaded package into your server

     ::: info Note

     You may need to reset files permissions as during the install process.
     Check [Security Concerns](./security.md).

     :::

4. Releases may come with additional update instructions (see
   [releases page](https://code.castopod.org/adaures/castopod/-/releases)). They
   are usually database migration scripts in `.sql` format to update your
   database schema.

   - 👉 Assurez-vous d'exécuter les scripts sur votre interface phpmyadmin ou
     utilisez la ligne de commande pour mettre à jour la base de données avec
     les fichiers du paquet !
   - cf.
     [Je n'ai pas mis à jour mon instance depuis longtemps… Que devrais-je faire ?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

5. Si vous utilisez redis, effacez votre cache.
6. ✨ Votre nouvelle instance est prête !

## Foire Aux Questions (FAQ)

### Où puis-je trouver ma version de Castopod ?

Allez dans votre panneau d'administration de Castopod, la version s'affiche en
bas à gauche.

Vous pouvez également trouver la version dans le fichier
`app > Config > Constants.php`.

### Je n'ai pas mis à jour mon instance depuis longtemps… Que devrais-je faire ?

Aucun souci ! Il suffit d'obtenir la dernière version comme décrit ci-dessus.
Lorsque vous exécutez les instructions de mise à jour (4), lancez-les
séquentiellement, de la plus ancienne à la plus récente.

> Vous devriez sauvegarder votre instance selon la date de votre dernière mise à
> jour de Castopod.

Par exemple, si vous êtes en `v1.0.0-alpha.42` et souhaitez mettre à jour vers
la `v1.0.0-beta.1` :

0. (fortement recommandé) Faites une sauvegarde de vos fichiers et de votre base
   de données.

1. Téléchargez la dernière version, écrasez vos fichiers tout en conservant
   `.env` et `public/media`.

2. Go through each release update instructions sequentially (from oldest to
   newest) starting with `v1.0.0-alpha.43`, `v1.0.0-alpha.44`,
   `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ Votre nouvelle instance est prête !

### Dois-je faire une sauvegarde avant de mettre à jour ?

Nous vous conseillons de le faire, afin de ne pas tout perdre si quelque chose
se passait mal !

Plus généralement, nous vous conseillons de faire des sauvegardes régulières de
vos fichiers Castopod et de votre base de données afin d'éviter de tout perdre…
