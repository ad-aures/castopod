---
title: Actualización
sidebarDepth: 3
---

# ¿Cómo actualizar Castopod?

Después de instalar Castopod, es posible que quieras actualizar tu instancia a
la última versión para disfrutar de las últimas características ✨, correcciones
de errores 🐛 y mejoras de rendimiento ⚡.

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

> Próximamente... 👀

## Preguntas Frecuentes (FAQ)

### ¿Dónde puedo encontrar mi versión de Castopod?

Go to your Castopod admin panel, the version is displayed on the bottom left
corner.

Alternatively, you can find the version in the `app > Config > Constants.php`
file.

### No he actualizado mi instancia en mucho tiempo… ¿Qué debo hacer?

No problem! Just get the latest release as described above. Only, when going
through the release instructions (4), perform them sequentially, from the oldest
to the newest.

> Puede que quieras hacer una copia de seguridad de tu instancia dependiendo del
> tiempo que no hayas actualizado Castopod.

For example, if you're on `v1.0.0-alpha.42` and would like to upgrade to
`v1.0.0-beta.1`:

0. (altamente recomendado) Haga una copia de seguridad de sus archivos y base de
   datos.

1. Descarga la última versión, sobrescribe tus archivos manteniendo `.env` y
   `public/media`.

2. Repase las instrucciones de actualización de cada versión secuencialmente (de
   más antiguo a más reciente) comenzando con `v1.0.0-alpha. 3`,
   `v1.0.0-alpha.44`, `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ ¡Disfruta de tu instancia recién instalada, todo listo!

### ¿Debo hacer una copia de seguridad antes de actualizar?

We advise you do, so you don't lose everything if anything goes wrong!

More generally, we advise you make regular backups of your Castopod files and
database to prevent you from losing it all…
