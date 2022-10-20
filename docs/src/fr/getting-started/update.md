---
title: Mise à jour
sidebarDepth: 3
---

# Comment installer Castopod ?

Après avoir installé Castopod, vous pouvez mettre à jour votre instance vers la
dernière version afin de profiter des dernières fonctionnalités ✨, des
corrections de bugs 🐛 et des améliorations de performance ⚡.

## Update instructions

0. ⚠️ Before any update, we highly recommend you backup your Castopod files and
   database.

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

3. On your server:

   - Remove all files except `.env` and `public/media`
   - Copy the new files from the downloaded package into your server

     ::: info Note

     You may need to reset files permissions as during the install process.
     Check [Security Concerns](./security.md).

     :::

4. Update your database schema from your `Castopod Admin` > `About` page or by
   running:

   ```bash
   php spark castopod:database-update
   ```

5. Clear your cache from your `Castopod Admin` > `Settings` > `general` >
   `Housekeeping`
6. ✨ Enjoy your fresh instance, you're all done!

::: info Note

Releases may come with additional update instructions (see
[releases page](https://code.castopod.org/adaures/castopod/-/releases)).

- cf.
  [I haven't updated my instance in a long time… What should I do?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

:::

## Fully Automated updates

> Prochainement... 👀

## Foire Aux Questions (FAQ)

### Où puis-je trouver ma version de Castopod ?

Go to your Castopod admin panel, the version is displayed on the bottom left
corner.

Alternatively, you can find the version in the `app > Config > Constants.php`
file.

### [Je n'ai pas mis à jour mon instance depuis longtemps… Que devrais-je faire ?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

No problem! Just get the latest release as described above. Only, when going
through the release instructions (4), perform them sequentially, from the oldest
to the newest.

> Vous devriez sauvegarder votre instance selon la date de votre dernière mise à
> jour de Castopod.

For example, if you're on `v1.0.0-alpha.42` and would like to upgrade to
`v1.0.0-beta.1`:

0. (fortement recommandé) Faites une sauvegarde de vos fichiers et de votre base
   de données.

1. Téléchargez la dernière version, écrasez vos fichiers tout en conservant
   `.env` et `public/media`.

2. Effectuez les instructions de mise à jour l'une après l'autre (de la plus
   ancienne à la plus récente).

3. ✨ Votre nouvelle instance est prête !

### Dois-je faire une sauvegarde avant de mettre à jour ?

We advise you do, so you don't lose everything if anything goes wrong!

More generally, we advise you make regular backups of your Castopod files and
database to prevent you from losing it all…
