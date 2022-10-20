---
title: Actualitzar
sidebarDepth: 3
---

# Com actualitzar Castopod?

Després d'instal·lar Castopod, és possible que vulgueu actualitzar la vostra
instància a la darrera versió per gaudir de les últimes funcions ✨, correccions
d'errors 🐛 i millores de rendiment ⚡.

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

> Aviat... 👀

## Preguntes més freqüents (FAQ)

### On puc trobar la meva versió de Castopod?

Go to your Castopod admin panel, the version is displayed on the bottom left
corner.

Alternatively, you can find the version in the `app > Config > Constants.php`
file.

### Fa temps que no actualitzo la meva instància... Què hauria de fer?

No problem! Just get the latest release as described above. Only, when going
through the release instructions (4), perform them sequentially, from the oldest
to the newest.

> És possible que vulgueu fer una còpia de seguretat de la vostra instància en
> funció del temps que no heu actualitzat Castopod.

For example, if you're on `v1.0.0-alpha.42` and would like to upgrade to
`v1.0.0-beta.1`:

0. (molt recomanable) Feu una còpia de seguretat dels vostres fitxers i base de
   dades.

1. Baixeu la darrera versió, sobreescriu els vostres fitxers mantenint `.env` i
   `public/media`.

2. Seguiu les instruccions d'actualització de cada versió seqüencialment (de la
   més antiga a la més recent) començant per `v1.0.0-alpha.43`,
   `v1.0.0-alpha.44`, `v1.0.0-alpha.45`, ..., `v1.0.0-beta.1`.

3. ✨ Gaudiu de la vostra nova instància, tot fet i preparat!

### Hauria de fer una còpia de seguretat abans d'actualitzar?

We advise you do, so you don't lose everything if anything goes wrong!

More generally, we advise you make regular backups of your Castopod files and
database to prevent you from losing it all…
