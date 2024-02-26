---
title: Official Docker images
sidebarDepth: 3
---

# Official Docker images

Castopod pushes 3 Docker images to the Docker Hub during its automated build
process:

- [**`castopod/castopod`**](https://hub.docker.com/r/castopod/castopod): an all
  in one castopod image using nginx unit
- [**`castopod/app`**](https://hub.docker.com/r/castopod/app): the app bundle
  with all of Castopod dependencies
- [**`castopod/web-server`**](https://hub.docker.com/r/castopod/web-server): an
  Nginx configuration for Castopod

Additionally, Castopod requires a MySQL-compatible database. A Redis database
can be added as a cache handler.

## Supported tags

- `develop` [unstable], latest development branch build
- `beta` [stable], latest beta version build
- `latest` [stable], latest version build
- `1.x.x` [stable], specific version build (since `1.0.0`)

## Example usage

1.  Install [docker](https://docs.docker.com/get-docker/) and
    [docker-compose](https://docs.docker.com/compose/install/)
2.  Create a `docker-compose.yml` file with the following:

    ```yml
    version: "3.7"

    services:
      app:
        image: castopod/castopod:latest
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

    You have to adapt some variables to your needs (e.g. `CP_BASEURL`,
    `MYSQL_ROOT_PASSWORD`, `MYSQL_PASSWORD` and `CP_ANALYTICS_SALT`).

3.  Setup a reverse proxy for TLS (SSL/HTTPS)

    TLS is mandatory for ActivityPub to work. This job can easily be handled by
    a reverse proxy, for example with [Caddy](https://caddyserver.com/):

    ```
    #castopod
    castopod.example.com {
        reverse_proxy localhost:8000
    }
    ```

4.  Run `docker-compose up -d`, wait for it to initialize and head on to
    `https://castopod.example.com/cp-install` to finish setting up Castopod!

5.  You're all set, start podcasting! 🎙️🚀

## Environment Variables

- **castopod/castopod** and **castopod/app**

  | Variable name                         | Type (`default`)        | Dre ziouer       |
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

  | Variable name          | Doare                 | Default |
  | ---------------------- | --------------------- | ------- |
  | **`CP_APP_HOSTNAME`**  | ?string               | `"app"` |
  | **`CP_MAX_BODY_SIZE`** | ?number (with suffix) | `512M`  |
  | **`CP_TIMEOUT`**       | ?number               | `900`   |
