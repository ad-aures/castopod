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

- PHP v8.1 o superior
- MySQL versión 5.7 o superior o MariaDB versión 10.2 o superior
- Soporte HTTPS

### PHP v8.1 o superior

Se requiere PHP versión 8.1 o superior con las siguientes extensiones
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

El usuario debe tener al menos estos privilegios en la base de datos para que
Castopod funcione: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`,
`SELECT`, `UPDATE`, `REFERENCES`, `CREATE VIEW`.

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
   > más.

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

### Configuración de Correo Electrónico/SMTP

La configuración del correo electrónico es necesaria para que algunas
características funcionen correctamente (por ejemplo, recuperar su contraseña
olvidada, enviando instrucciones a los suscriptores premium, …)

Puedes añadir tu configuración de correo electrónico en el archivo `.env` de tu
instancia así:

```ini
# […]

email.fromEmail="your_email_address"
email.SMTPHost="your_smtp_host"
email.SMTPUser="your_smtp_user"
email.SMTPPass="your_smtp_password"
```

#### Opciones de configuración de email

| Nombre de la variable | Tipo                 | Predeterminado |
| --------------------- | -------------------- | -------------- |
| **`fromEmail`**       | string               | `undefined`    |
| **`fromName`**        | string               | `"Castopod"`   |
| **`SMTPHost`**        | string               | `undefined`    |
| **`SMTPUser`**        | string               | `undefined`    |
| **`SMTPPass`**        | string               | `undefined`    |
| **`SMTPPort`**        | number               | `25`           |
| **`SMTPCrypto`**      | [`"tls"` or `"ssl"`] | `"tls"`        |

## Paquetes de la comunidad

Si no quieres molestarte en instalar Castopod manualmente, puedes utilizar uno
de los paquetes creados y mantenidos por la comunidad de código abierto.

### Instalar con YunoHost

[YunoHost](https://yunohost.org/) es una distribución GNU/Linux basada en Debian
compuesta por paquetes de software libre y de código abierto. Te ayuda a
gestionar las partes difíciles de autoalojamiento.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Instalar Castopod con YunoHost." class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github
Repo</a>

</div>
