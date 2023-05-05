---
title: Images officielles Docker
sidebarDepth: 3
---

# Images officielles de Docker

Castopod envoie 3 images Docker au Hub Docker pendant son processus de
construction automatisée :

- [**`castopod/castopod`**](https://hub.docker.com/r/castopod/castopod): an all
  in one castopod image using nginx unit
- [**`castopod/app`**](https://hub.docker.com/r/castopod/app): the app bundle
  with all of Castopod dependencies
- [**`castopod/web-server`**](https://hub.docker.com/r/castopod/web-server): an
  Nginx configuration for Castopod
- [**`castopod/video-clipper`**](https://hub.docker.com/r/castopod/video-clipper):
  an optional image building videoclips thanks to ffmpeg

De plus, Castopod nécessite une base de données compatible avec MySQL. Une base
de données Redis peut être ajoutée en tant que gestionnaire de cache.

## Tags supportés

- `développer` [unstable], la dernière version de la branche de développement
- `beta` [stable], dernière version bêta
- `1.0.0-beta.x` [stable], version bêta spécifique (depuis `1.0.0-beta.22`)
- `beta` [stable], dernière version bêta
- `1.x.x` [stable], version spécifique (depuis `1.0.0`)

## Exemple d'utilisation

1.  Installez [docker](https://docs.docker.com/get-docker/) et
    [docker-compose](https://docs.docker.com/compose/install/)
2.  Créez un fichier `docker-compose.yml` avec les éléments suivants :

    ```yml
    version: "3.7"

    services:
      app:
        image: castopod/app:latest
        container_name: "castopod-app"
        volumes:
          - castopod-media:/var/www/castopod/public/media
        environment:
          MYSQL_DATABASE: castopod
          MYSQL_USER: castopod
          MYSQL_PASSWORD: changeme
          CP_BASEURL: "https://castopod.example.com"
          CP_ANALYTICS_SALT: changeme
          CP_CACHE_HANDLER: redis
          CP_REDIS_HOST: redis
        networks:
          - castopod-app
          - castopod-db
        ports:
          - 8000:8000
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

    Vous devez adapter certaines variables à vos besoins (p. ex. `CP_BASEURL`,
    `MYSQL_ROOT_PASSWORD`, `MYSQL_PASSWORD` et `CP_ANALYTICS_SALT`).

3.  Setup a reverse proxy for TLS (SSL/HTTPS)

    TLS is mandatory for ActivityPub to work. This job can easily be handled by
    a reverse proxy, for example with [Caddy](https://caddyserver.com/):

    ```
    #castopod
    castopod.example.com {
        reverse_proxy localhost:8000
    }
    ```

4.  Exécutez `docker-compose up -d`, attendez qu'il s'initialise sur
    `https://castopod.example.com/cp-install` pour terminer la configuration de
    Castopod !

5.  Vous êtes prêt, commencez à podcaster! 🎙️🚀

## Environment Variables

- **castopod/video-clipper**

  | Nom de la variable         | Type (`default`) | Par défaut       |
  | -------------------------- | ---------------- | ---------------- |
  | **`CP_DATABASE_HOSTNAME`** | ?string          | `"mariadb"`      |
  | **`CP_DATABASE_NAME`**     | ?string          | `MYSQL_DATABASE` |
  | **`CP_DATABASE_USERNAME`** | ?string          | `MYSQL_USER`     |
  | **`CP_DATABASE_PASSWORD`** | ?string          | `MYSQL_PASSWORD` |
  | **`CP_DATABASE_PREFIX`**   | ?string          | `"cp_"`          |

- **castopod/castopod** and **castopod/app**

  | Variable name                         | Type (`default`)        | Par défaut       |
  | ------------------------------------- | ----------------------- | ---------------- |
  | **`CP_BASEURL`**                      | string                  | `undefined`      |
  | **`CP_MEDIA_BASEURL`**                | ?string                 | `CP_BASEURL`     |
  | **`CP_ADMIN_GATEWAY`**                | ?string                 | `"cp-admin"`     |
  | **`CP_AUTH_GATEWAY`**                 | ?string                 | `"cp-auth"`      |
  | **`CP_ANALYTICS_SALT`**               | string                  | `undefined`      |
  | **`CP_DATABASE_HOSTNAME`**            | ?string                 | `"mariadb"`      |
  | **`CP_DATABASE_NAME`**                | ?string                 | `MYSQL_DATABASE` |
  | **`CP_DATABASE_USERNAME`**            | ?string                 | `MYSQL_USER`     |
  | **`CP_DATABASE_PASSWORD`**            | ?string                 | `MYSQL_PASSWORD` |
  | **`CP_DATABASE_PREFIX`**              | ?string                 | `"cp_"`          |
  | **`CP_CACHE_HANDLER`**                | [`"file"` or `"redis"`] | `"file"`         |
  | **`CP_REDIS_HOST`**                   | ?string                 | `"localhost"`    |
  | **`CP_REDIS_PASSWORD`**               | ?string                 | `null`           |
  | **`CP_REDIS_PORT`**                   | ?number                 | `6379`           |
  | **`CP_REDIS_DATABASE`**               | ?number                 | `0`              |
  | **`CP_EMAIL_SMTP_HOST`**              | ?string                 | `undefined`      |
  | **`CP_EMAIL_FROM`**                   | ?string                 | `undefined`      |
  | **`CP_EMAIL_SMTP_USERNAME`**          | ?string                 | `"localhost"`    |
  | **`CP_EMAIL_SMTP_PASSWORD`**          | ?string                 | `null`           |
  | **`CP_EMAIL_SMTP_PORT`**              | ?number                 | `25`             |
  | **`CP_EMAIL_SMTP_CRYPTO`**            | [`"tls"` or `"ssl"`]    | `"tls"`          |
  | **`CP_ENABLE_2FA`**                   | ?boolean                | `undefined`      |
  | **`CP_MEDIA_FILE_MANAGER`**           | ?string                 | `undefined`      |
  | **`CP_MEDIA_S3_ENDPOINT`**            | ?string                 | `undefined`      |
  | **`CP_MEDIA_S3_KEY`**                 | ?string                 | `undefined`      |
  | **`CP_MEDIA_S3_SECRET`**              | ?string                 | `undefined`      |
  | **`CP_MEDIA_S3_REGION`**              | ?string                 | `undefined`      |
  | **`CP_MEDIA_S3_BUCKET`**              | ?string                 | `undefined`      |
  | **`CP_MEDIA_S3_PROTOCOL`**            | ?number                 | `undefined`      |
  | **`CP_MEDIA_S3_PATH_STYLE_ENDPOINT`** | ?boolean                | `undefined`      |
  | **`CP_MEDIA_S3_KEY_PREFIX`**          | ?string                 | `undefined`      |
  | **`CP_DISABLE_HTTPS`**                | ?[`0` or `1`]           | `undefined`      |
  | **`CP_MAX_BODY_SIZE`**                | ?number (with suffix)   | `512M`           |
  | **`CP_PHP_MEMORY_LIMIT`**             | ?number (with suffix)   | `512M`           |
  | **`CP_TIMEOUT`**                      | ?number                 | `900`            |

- **castopod/web-server**

  | Nom de la variable     | Type                  | Par défaut |
  | ---------------------- | --------------------- | ---------- |
  | **`CP_APP_HOSTNAME`**  | ?string               | `"app"`    |
  | **`CP_MAX_BODY_SIZE`** | ?number (with suffix) | `512M`     |
  | **`CP_TIMEOUT`**       | ?number               | `900`      |
