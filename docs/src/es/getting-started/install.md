---
title: Instalación
sidebarDepth: 3
---

# ¿Cómo instalar Castopod?

Castopod está pensado para ser fácil de instalar. Ya sea usando un alojamiento
dedicado o compartido, puedes instalarlo en la mayoría de servidores web
compatibles con PHP-MySQL.

::: tip Nota

¡Hemos publicado imágenes oficiales de Docker para Castopod!

Si prefieres usar Docker, puedes saltarte esto e ir directamente a la
[documentación sobre docker](./docker.md) para Castopod.

:::

## Requisitos

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

Además, asegúrate de que las siguientes extensiones están habilitadas en tu PHP:

- json (habilitada por defecto - no la desactives)
- xml (habilitada por defecto - no la desactives)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### Base de datos compatible con MySQL

> Se recomienda usar [MariaDB](https://mariadb.org).

::: warning Alerta

Castopod solo funciona con base de datos compatibles con MySQL 5.7 o superior.
No funcionará por ejemplo con la version previa MySQL v5.6, ya que su vida útil
terminó el 5 de febrero de 2021.

:::

Necesitarás la dirección/nombre del servidor (hostname), el nombre de la base de
datos, el usuario y la contraseña para completar el proceso de instalación. Si
no cuentas con esta información, contacta con el administrador de tu servidor.

#### Privilegios

User must have at least these privileges on the database for Castopod to work:
`CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`, `UPDATE`,
`REFERENCES`, `CREATE VIEW`.

### (Opcional) FFmpeg v4.1.8 o superior para poder generar clips de vídeo (recortes de vídeo)

Es necesario tener instalado [FFmpeg](https://www.ffmpeg.org/) versión 4.1.8 o
superior si desea generar recorte de vídeos. Se debe instalar las siguientes
extensiones:

- Librería **FreeType 2** para
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Opcional) Otras recomendaciones

- Redis para mejores rendimientos de caché.
- CDN para almacenamiento en caché de archivos estáticos y mejores rendimientos.
- Pasarela de correo para recuperación de contraseñas olvidadas.

## Instrucciones de instalación

### Pre-requisitos

0. Consigue un servidor web que cuente con todos los [requisitos](#requirements)
   recomendados.
1. Crea una base de datos MySQL para Castopod con un usuario que tenga acceso y
   privilegios de modificación (para más información, ver
   [base de datos compatible con MySQL](#mysql-compatible-database)).
2. Activa HTTPS en tu dominio web mediante un _certificado SSL_.
3. Descarga y descomprime en tu servidor la última versión de
   [Castopod](https://castopod.org/), si aún no lo has hecho.
   - ⚠️ Edita la configuración de tu servidor para que el "document root" sea la
     subcarpeta `castopod/public/`.
4. Añade tareas en el **cron** de tu servidor web para hacer funcionar varios
   procesos de Castopod en segundo plano (reemplaza las rutas de acuerdo a la
   estructura de directorios de tu servidor):

   - Esta tarea se utiliza para transmitir las actividades sociales a tus
     seguidores en el Fediverso:

   ```bash
      * * * * * /ruta/al/php /ruta/a/castopod/public/index.php scheduled-activities
   ```

   - Para que tus episodios sean transmitidos a los hubs abiertos que usan el
     nuevo protocolo [WebSub](https://en.wikipedia.org/wiki/WebSub) (2018):

   ```bash
      * * * * * /ruta/al/php /castopod/public/index.php scheduled-websub-publish
   ```

   - Para generar Recortes de video (ver
     [requisitos FFmpeg ](#ffmpeg-v418-or-higher-for-video-clips)):

   ```bash
      * * * * * /ruta/al/php /path/to/castopod/public/index.php scheduled-video-clips
   ```

   > Estas tareas así definidas se ejecutarán **cada minuto**. Pero puedes
   > definir una frecuencia más acorde a tus necesidades: cada 5, 10 minutos o
   > más. Ejemplo: si reemplazas el último asterisco por \*/30 se ejecutará cada
   > 30 minutos.
   > ([más ejemplos](https://blog.carreralinux.com.ar/2016/09/ejemplos-de-cron-tareas-linux/))

### (recomendado) Asistente web de instalación

1. Ejecuta el script de instalación de Castopod visitando en tu navegador web
   esta dirección: `https://tu_nombre_de_dominio.com/cp-install`
2. Sigue las instrucciones en pantalla.
3. ¡Empieza a hacer podcasting!

::: info Nota

El script de instalación crea un archivo `.env` en la raíz de castopod. If you
cannot go through the install wizard, you can create and edit the `.env` file
manually based on the `.env.example` file.

:::

### Email/SMTP setup

Email configuration is required for some features to work properly (eg.
retrieving your forgotten password, sending instructions to premium subscribers,
…)

You may add your email configuration in your instance's `.env` like so:

```ini
# […]

email.fromEmail="your_email_address"
email.SMTPHost="your_smtp_host"
email.SMTPUser="your_smtp_user"
email.SMTPPass="your_smtp_password"
```

#### Email config options

| Variable name    | Type                 | Default      |
| ---------------- | -------------------- | ------------ |
| **`fromEmail`**  | string               | `undefined`  |
| **`fromName`**   | string               | `"Castopod"` |
| **`SMTPHost`**   | string               | `undefined`  |
| **`SMTPUser`**   | string               | `undefined`  |
| **`SMTPPass`**   | string               | `undefined`  |
| **`SMTPPort`**   | number               | `25`         |
| **`SMTPCrypto`** | [`"tls"` or `"ssl"`] | `"tls"`      |

## Paquetes de la comunidad

If you don't want to bother with installing Castopod manually, you may use one
of the packages created and maintained by the open-source community.

### Install with YunoHost

[YunoHost](https://yunohost.org/) is a distribution based on Debian GNU/Linux
made up of free and open-source software packages. It manages the hardships of
self-hosting for you.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Instalar Castopod con YunoHost." class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100">

</div>
