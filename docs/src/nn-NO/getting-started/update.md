---
title: Oppdatering
sidebarDepth: 3
---

# Korleis oppdaterer eg Castopod?

Når du har installert Castopod, kan det vera lurt å oppdatera nettstaden din til
siste versjonen for å få nye funksjonar, ✨, feilrettingar 🐛 og betre yting ⚡.

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

> Kjem snart... 👀

## Vanlege spørsmål (FAQ)

### Kvar finn eg Castopod-versjonsnummeret?

Go to your Castopod admin panel, the version is displayed on the bottom left
corner.

Alternatively, you can find the version in the `app > Config > Constants.php`
file.

### Eg har ikkje oppdatert på lenge… Kva skal eg gjera?

No problem! Just get the latest release as described above. Only, when going
through the release instructions (4), perform them sequentially, from the oldest
to the newest.

> Du bør truleg tryggingskopiera nettstaden din, avhengig av kor lenge sidan det
> er du oppdaterte Castopod.

For example, if you're on `v1.0.0-alpha.42` and would like to upgrade to
`v1.0.0-beta.1`:

0. (stekt tilrådd) Ta ein tryggingskopi av filene og databasen din.

1. Last ned siste utgåva, erstatt alle filene utanom `.env` og `public/media`.

2. Gå gjennom alle oppdateringsinstruksane frå eldst til nyast. Start med
   `v1.0.0-alpha.43`, `v1.0.0-alpha.44`, `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ Ferdig!

### Bør eg tryggingskopiera før eg oppdaterer?

We advise you do, so you don't lose everything if anything goes wrong!

More generally, we advise you make regular backups of your Castopod files and
database to prevent you from losing it all…
