---
title: Instalación
sidebarDepth: 3
---

# ¿Cómo instalar Castopod?

Castopod está pensado para ser fácil de instalar. Ya sea usando un alojamiento
dedicado o compartido, puedes instalarlo en la mayoría de servidores web
compatibles con PHP-MySQL.

::: tip Note

We've released official Docker images for Castopod!

If you prefer using Docker, you may skip this and go straight to the
[docker documentation](./docker.md) for Castopod.

:::

## Requerimientos

- PHP v8.0 o superior
- MySQL versión 5.7 o superior o MariaDB versión 10.2 o superior
- Soporte HTTPS

### PHP v8.0 o superior

PHP version 8.0 or higher is required, with the following extensions installed:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) con librerias
  **JPEG**, **PNG** y **WEBP**.
- [exif](https://www.php.net/manual/en/exif.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (habilitada por defecto - no la desactives)
- xml (habilitada por defecto - no la desactives)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### Base de datos compatible con MySQL

> Recomendamos usar [MariaDB](https://mariadb.org).

::: warning Warning

Castopod only works with supported MySQL 5.7 or higher compatible databases. It
will break with the previous MySQL v5.6 for example as its end of life was on
February 5, 2021.

:::

You will need the server hostname, database name, username and password to
complete the installation process. If you do not have these, please contact your
server administrator.

#### Privilegios

User must have at least these privileges on the database for Castopod to work:
`CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`, `UPDATE`.

### (Opcional) FFmpeg v4.1.8 o superior para clips de video

[FFmpeg](https://www.ffmpeg.org/) version 4.1.8 or higher is required if you
want to generate Video Clips. The following extensions must be installed:

- Librería **FreeType 2** para
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Opcional) Otras recomendaciones

- Redis para mejores rendimientos de caché.
- CDN para almacenamiento en caché de archivos estáticos y mejores rendimientos.
- puerta de enlace de email para pérdidas de contraseña.

## Instrucciones de instalación

### Prerequisitos

0. Consigue un Servidor Web con [requerimientos](#requirements) instalados
1. Crea una base de datos MySQL para Castopod con un usuario que tenga acceso y
   privilegios de modificación (para más información, ver
   [MySQL base de datos compatible](#mysql-compatible-database)).
2. Activa HTTPS en tu domino con un _certificado SSL_.
3. Descarga y descomprime el último [paquete Castopod](https://castopod.org/) en
   el servidor de la web si aún no lo has hecho.
   - ⚠️ Establece la raiz del documento del servidor web en la subcarpeta
     `pública/` en la carpeta `castopod`.
4. Añade **cron tasks** en tu servidor web para varios procesos en segundo plano
   (reemplaza las rutas accorde con):

   - Para que las características sociales funcionen correctamente, esta tarea
     se utiliza para transmitir las actividades sociales a tus seguidores en el
     Fediverso:

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php actividades programadas
   ```

   - Para que tus episodios sean transmitidos en hubs abiertos sobre
     publicaciones usando [WebSub](https://en.wikipedia.org/wiki/WebSub):

   ```bash
      * * * * * /usr/local/bin/php /castopod/public/index.php publicaciones-websub-programadas
   ```

   - Para crear Clips de video (ver
     [requerimientos FFmpeg ](#ffmpeg-v418-or-higher-for-video-clips)):

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php clips-devideo-programados
   ```

   > Estas tareas se ejecutan **cada minuto**. Debes establecer la frecuencia
   > dependiendo de tus necesidades: cada 5, 10 minutos o más.

### (recomendado) Instalar Wizard

1. Ejecuta el script de instalación de Castopod yendo a la página de instalación
   de wizard (`https://your_domain_name.com/cp-install`) en tu navegador web
   preferido.
2. Sigue las instrucciones de la pantalla.
3. ¡Empieza a crear podcasting!

::: info Note

The install script writes a `.env` file in the package root. If you cannot go
through the install wizard, you can
[create and update the `.env` file manually](#alternative-manual-configuration).

:::

## Paquetes de la comunidad

If you don't want to bother with installing Castopod manually, you may use one
of the packages created and maintained by the open-source community.

### Instalar con YunoHost

[YunoHost](https://yunohost.org/) is a distribution based on Debian GNU/Linux
made up of free and open-source software packages. It manages the hardships of
self-hosting for you.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Instalar Castopod con YunoHost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github
Repo</a>

</div>
