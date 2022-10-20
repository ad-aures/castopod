---
title: 更新
sidebarDepth: 3
---

# 如何更新 Castopod ？

安装 Castopod 后，你可能希望将实例更新到最新版本 版本以享受最新功能 ✨, 修复错误
🐛 和性能提升 ⚡。

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

> 即将到来... 👀

## 常见问题（FAQ）

### 在哪里可以找到我的 Castopod 版本号？

Go to your Castopod admin panel, the version is displayed on the bottom left
corner.

Alternatively, you can find the version in the `app > Config > Constants.php`
file.

### 我很长时间没有更新我的实例… 我该怎么办？

No problem! Just get the latest release as described above. Only, when going
through the release instructions (4), perform them sequentially, from the oldest
to the newest.

> 你可能想要备份你的实例，这取决于您多久没有更新过 Castopod 。

For example, if you're on `v1.0.0-alpha.42` and would like to upgrade to
`v1.0.0-beta.1`:

0. (强烈推荐) 备份你的文件和数据库。

1. 下载最新版本，覆盖您的文件，同时保留 `.env` 文件和 `public/media` 文件夹。

2. 从 `v1.0.0-alpha.43` 开始，按顺序执行每个版本更新指令(从老版本到 最新版本)，
   然后是 `v1.0.0-alpha.44`，`v1.0.0-alpha.45`，…，直到 `v1.0.0-beta.1`。

3. ✨ 享受你的新实例, 你已经更新完毕！

### 我是否应该在更新前备份？

We advise you do, so you don't lose everything if anything goes wrong!

More generally, we advise you make regular backups of your Castopod files and
database to prevent you from losing it all…
