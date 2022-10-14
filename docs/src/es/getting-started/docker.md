---
title: Imágenes oficiales de Docker
sidebarDepth: 3
---

# Imágenes oficiales de Docker

Castopod lanza 2 imágenes Docker al Docker Hub durante su proceso de
construcción automatizada:

- [**`castopod/app`**](https://hub.docker.com/r/castopod/app): el paquete
  completo de Castopod con todas las dependencias.
- [**`castopod/web-server`**](https://hub.docker.com/r/castopod/web-server): una
  configuración Nginx para Castopod

Adicionalmente, Castopod requiere una base de datos compatible con MySQL.
También se puede añadir una base de datos Redis como gestor de caché.

## Etiquetas admitidas

- `develop` [unstable], última rama de desarrollo construida
- `beta` [stable], latest beta version build
- `1.0.0-beta.x` [stable], specific beta version build (since `1.0.0-beta.22`)

## Ejemplo de uso

1.  Instalar [docker](https://docs.docker.com/get-docker/) y
    [docker-compose](https://docs.docker.com/compose/install/)
2.  Crear un archivo `docker-compose.yml` con lo siguiente:

    ```yml
    version: "3.7"

    services:
      app:
        image: castopod/app:beta
        container_name: "castopod-app"
        volumes:
          - castopod-media:/opt/castopod/public/media
        environment:
          MYSQL_DATABASE: castopod
          MYSQL_USER: castopod
          MYSQL_PASSWORD: changeme
          CP_BASEURL: "http://castopod.example.com"
          CP_ANALYTICS_SALT: changeme
          CP_CACHE_HANDLER: redis
          CP_REDIS_HOST: redis
        networks:
          - castopod-app
          - castopod-db
        restart: unless-stopped

      web-server:
        image: castopod/web-server:beta
        container_name: "castopod-web-server"
        volumes:
          - castopod-media:/var/www/html/media
        networks:
          - castopod-app
        ports:
          - 8080:80
        restart: unless-stopped

      mariadb:
        image: mariadb:10.5
        container_name: "castopod-mariadb"
        networks:
          - castopod-db
        volumes:
          - castopod-db:/var/lib/mysql
        environment:
          MYSQL_ROOT_PASSWORD: changeme
          MYSQL_DATABASE: castopod
          MYSQL_USER: castopod
          MYSQL_PASSWORD: changeme
        restart: unless-stopped

      redis:
        image: redis:7.0-alpine
        container_name: "castopod-redis"
        volumes:
          - castopod-cache:/data
        networks:
          - castopod-app

    volumes:
      castopod-media:
      castopod-db:
      castopod-cache:

    networks:
      castopod-app:
      castopod-db:
    ```

    Debes adaptar algunas variables a tus necesidades (ej. `CP_BASEURL`,
    `MYSQL_ROOT_PASSWORD`, `MYSQL_PASSWORD` y `CP_ANALYTICS_SALT`).

3.  Configura un servidor proxy inverso para TLS (SSL/HTTPS).

    TLS es imprescindible para que ActivityPub funcione. Este trabajo puede ser
    fácilmente manejado por un proxy inverso, por ejemplo con
    [Caddy](https://caddyserver.com/):

    ```
    #castopod
    castopod.mi_dominio.com {
        reverse_proxy localhost:8080
    }
    ```

4.  Ejecuta `docker-compose -d`, espera a que se inicie y ve a
    `https://castopod.mi_dominio.com/cp-install` para terminar de configurar
    Castopod!

5.  Todo listo, empieza a hacer podcasting! 🎙️🚀

## Variables de Entorno

- **castopod/app**

  | Nombre de la Variable        | Tipo (`predeterminado`) | Default          |
  | ---------------------------- | ----------------------- | ---------------- |
  | **`CP_URLBASE`**             | string                  | `undefined`      |
  | **`CP_MEDIA_URLBASE`**       | ?string                 | `CP_BASEURL`     |
  | **`CP_ADMIN_GATEWAY`**       | ?string                 | `"cp-admin"`     |
  | **`CP_AUTH_GATEWAY`**        | ?string                 | `"cp-auth"`      |
  | **`CP_ANALYTICS_SALT`**      | string                  | `undefined`      |
  | **`CP_DATABASE_HOSTNAME`**   | ?string                 | `"mariadb"`      |
  | **`CP_DATABASE_NAME`**       | ?string                 | `MYSQL_DATABASE` |
  | **`CP_DATABASE_USERNAME`**   | ?string                 | `MYSQL_USER`     |
  | **`CP_DATABASE_PASSWORD`**   | ?string                 | `MYSQL_PASSWORD` |
  | **`CP_DATABASE_PREFIX`**     | ?string                 | `"cp_"`          |
  | **`CP_CACHE_HANDLER`**       | [`"file"` or `"redis"`] | `"file"`         |
  | **`CP_REDIS_HOST`**          | ?string                 | `"localhost"`    |
  | **`CP_REDIS_PASSWORD`**      | ?string                 | `null`           |
  | **`CP_REDIS_PORT`**          | ?number                 | `6379`           |
  | **`CP_REDIS_DATABASE`**      | ?number                 | `0`              |
  | **`CP_EMAIL_SMTP_HOST`**     | ?string                 | `undefined`      |
  | **`CP_EMAIL_FROM`**          | ?string                 | `undefined`      |
  | **`CP_EMAIL_SMTP_USERNAME`** | ?string                 | `"localhost"`    |
  | **`CP_EMAIL_SMTP_PASSWORD`** | ?string                 | `null`           |
  | **`CP_EMAIL_SMTP_PORT`**     | ?number                 | `25`             |
  | **`CP_EMAIL_SMTP_CRYPTO`**   | [`"tls"` or `"ssl"`]    | `"tls"`          |

- **castopod/web-server**

  | Nombre de la variable | Type    | Default |
  | --------------------- | ------- | ------- |
  | **`CP_APP_HOSTNAME`** | ?string | `"app"` |
