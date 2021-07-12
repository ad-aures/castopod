# How to update Castopod Host <!-- omit in toc -->

After installing _Castopod Host_, you may want to update your instance to the
latest version in order to enjoy the latest features ✨, bug fixes 🐛 and
performance improvements ⚡.

## Table of contents <!-- omit in toc -->

- [Manual update instructions](#manual-update-instructions)
- [Automatic update instructions](#automatic-update-instructions)
- [Frequently asked questions (FAQ)](#frequently-asked-questions-faq)
  - [Where can I find my _Castopod Host_ version?](#where-can-i-find-my-castopod-host-version)
  - [I haven't updated my instance in a long time… What should I do?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)
  - [Should I make a backup before updating?](#should-i-make-a-backup-before-updating)

## Manual update instructions

1. Go to the
   [releases page](https://code.podlibre.org/podlibre/castopod-host/-/releases)
   and see if your instance is up to date with the latest _Castopod Host_
   version

   - cf.
     [Where can I find my _Castopod Host_ version?](#where-can-i-find-my-castopod-host-version)

2. Download the latest release package named `Castopod Host Package`, you may
   choose between the `zip` or `tar.gz` archives

   - ⚠️ Make sure you download the Castopod Host Package and **NOT** the Source
     Code

3. On your server:

   - Remove all files except `.env` and `public/media`
   - Copy the new files from the downloaded package into your server
     - Note: you may need to reset files permissions as during the install
       process. Check
       [Security Concerns section in INSTALL.md](./INSTALL.md#security-concerns).

4. Alpha releases may come with additional update instructions (see
   [releases page](https://code.podlibre.org/podlibre/castopod-host/-/releases)).
   They are usually database migration scripts in `.sql` format to update your
   database schema.

   - 👉 Make sure you run the scripts on your phpmyadmin panel or using command
     line to update the database along with the package files!
   - cf.
     [I haven't updated my instance in a long time… What should I do?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

5. If you are using redis, clear your cache.
6. ✨ Enjoy your fresh instance, you're all done!

## Automatic update instructions

> Coming soon... 👀

## Frequently asked questions (FAQ)

### Where can I find my _Castopod Host_ version?

Go to your _Castopod Host_ admin panel, the version is displayed on the bottom
right corner.

Alternatively, you can find the version in the `app > Config > Constants.php`
file.

### I haven't updated my instance in a long time… What should I do?

No problem! Just get the latest release as described above. Only, when going
through the release instructions (4), perform them sequentially, from the oldest
to the newest.

> You may want to backup your instance depending on how long you haven't updated
> _Castopod Host_.

For example, if you're on `v1.0.0-alpha.42` and would like to upgrade to
`v1.0.0-alpha.58`:

0. (recommended) Make a backup of your files and database.

1. Download the latest release, overwrite your files whilst keeping `.env` and
   `public/media`.

2. Go through each release update instructions sequentially (from oldest to
   newest) starting with `v1.0.0-alpha.43`, `v1.0.0-alpha.44`,
   `v1.0.0-alpha.45`, …, `v1.0.0-alpha.58`.

3. ✨ Enjoy your fresh instance, you're all done!

### Should I make a backup before updating?

We advise you do, so you don't lose everything if anything goes wrong!

More generally, we advise you make regular backups of your Castopod Host files
and database to prevent you from losing it all…
