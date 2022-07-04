---
title: Instalación
sidebarDepth: 3
---

# ¿Cómo instalar Castopod?

Castopod está pensado para ser fácil de instalar. Ya sea usando un alojamiento
dedicado o compartido, puedes instalarlo en la mayoría de servidores web
compatibles con PHP-MySQL.

::: Nota informativa

Esta sección de la documentación te ayudará a configurar Castopod para la
producción. Si estás buscando participar en el desarrollo de Castopod, debes
pasar a la sección de contribuciones.

:::

## Requerimientos

- PHP v8.0 o superior
- MySQL versión 5.7 o superior o MariaDB versión 10.2 o superior
- Soporte HTTPS

### PHP v8.0 o superior

Se requiere PHP versión 8.0 o superior con las siguientes extensiones
instaladas:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) con librerias
  **JPEG**, **PNG** y **WEBP**.
- [exif](https://www.php.net/manual/en/exif.installation.php)

Adicionalmente, asegúrate que las siguientes extensiones están habilitadas en tu
PHP:

- json (habilitada por defecto - no la desactives)
- xml (habilitada por defecto - no la desactives)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### Base de datos compatible con MySQL

> Recomendamos usar [MariaDB](https://mariadb.org).

::: aviso Aviso

Castopod solo funciona con base de datos compatible con MySQL 5.7 o superior. Se
romperá con la version previa MySQL v5.6 por ejemplo, ya que su vida terminó el
5 de febrero de 2021.

:::

Necesitarás el nombre del anfitrión del servidor, nombre de la base de datos,
usuario y contraseña para completar el proceso de instalación. Si no los tienes,
por favor, contacta al administrador del servidor.

#### Privilegios

Los usuarios deben tener al menos estos privilegios en la base de datos para que
Castopod funcione: `CREAR`, `ALTERAR`, `BORRAR`, `EJECUTAR`, `INDICE`,
`INSERTAR`, `SELECCIONAR`, `ACTUALIZAR`.

### (Opcional) FFmpeg v4.1.8 o superior para clips de video

Se requiere [FFmpeg](https://www.ffmpeg.org/) versión 4.1.8 o superior si
quieres general clips de video. Se debe instalar las siguientes extensiones:

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

::: Nota informativa

El script de instalación escribe un archivo `.env` en la raiz de paquete. Si no
puedes completar la instalación de wizard, puedes
[crear y actualizar el archivo `.env` manualmente](#alternative-manual-configuration).

:::

## Paquetes de la comunidad

Si no quieres molestarte en instalar Castopod manualmente, puedes usar uno de
los paquetes creados y mantenidos por la comunidad de código abierto.

### Instalar con YunoHost

[YunoHost](https://yunohost.org/) es una distribuidora basada en Debian
GNU/Linux compuesta por paquetes de software libres y de código abierto. It
manages the hardships of self-hosting for you.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Instalar Castopod con YunoHost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github
Repo</a>

</div>

### Instalar con Docker

Si desea utilizar Docker para instalar Castopod, ¡es posible gracias a
[Romain de Laage](https://mamot.fr/@rdelaage)!

<a href="https://gitlab.utc.fr/picasoft/projets/services/castopod" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 mx-auto font-semibold text-center text-white rounded-md shadow gap-x-1 bg-[#1282d7] hover:no-underline hover:bg-[#0f6eb5]">Instalar
con
Docker<svg viewBox="0 0 24 24" width="1em" height="1em" class="text-xl text-pine-200"><path fill="currentColor" d="m16.172 11-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg></a>

::: Nota de información

Dada la alta demanda de docker, planeamos mantener una imagen oficial del Docker
de Castopod directamente en el repositorio de Castopod.

:::
