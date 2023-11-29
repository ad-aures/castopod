---
title: Offisielle Docker-bilete
sidebarDepth: 3
---

# Offisielle Docker-bilete

Castopod plasserer 3 Docker-bilete på Docker Hub som del av den automatiserte
byggjeprosessen:

- [**`castopod/castopod`**](https://hub.docker.com/r/castopod/castopod): alt i
  eitt-løysing med ei nginx-eining
- [**`castopod/app`**](https://hub.docker.com/r/castopod/app): app-pakka med alt
  Castopod avheng av
- [**`castopod/web-server`**](https://hub.docker.com/r/castopod/web-server):eit
  nginx-oppsett for Castopod

I tillegg krev Castopod ein MySQL-kompatibel database. Du kan leggja til ein
Redis-database for å handtera mellomlagring.

## Støtta merkelappar

- `develop` [unstable], det nyaste utviklingsbygget
- `beta` [stable], det nyaste betaversjon-bygget
- `latest` [stable], det nyaste versjonsbygget
- `1.x.x` [stable], bygg av ein spesivikk versjon (sidan `1.0.0`)

## Døme på bruk

1.  Installer [docker](https://docs.docker.com/get-docker/) og
    [docker-compose](https://docs.docker.com/compose/install/)
2.  Lag ei `docker-compose.yml`-fil som inneheld dette:

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

    Du må tilpassa nokre av variablane til din bruk (td. `CP_BASEURL`,
    `MYSQL_ROOT_PASSWORD`, `MYSQL_PASSWORD` og `CP_ANALYTICS_SALT`).

3.  Set opp ein revers-mellomlagertenar for TLS (SSL/HTTPS)

    Du treng TLS for at ActivityPub skal verka. Dette kan du lett handtera med
    ein revers-mellomtenar, til dømes [Caddy](https://caddyserver.com/):

    ```
    #castopod
    castopod.eksempel.com {
        reverse_proxy localhost:8000
    }
    ```

4.  Køyr `docker-compose up -d`, vent på at han skal starta og gå til
    `https://castopod.eksempel.com/cp-install` for å gjera ferdig
    Castopod-oppsettet!

5.  Då er du klar og kan starta å podkasta! 🎙️🚀

## Systemvariablar

- **castopod/castopod** og **castopod/app**

  | Variabelnamn                          | Type (`standard`)          | Standardval      |
  | ------------------------------------- | -------------------------- | ---------------- |
  | **`CP_BASEURL`**                      | streng                     | `udefinert`      |
  | **`CP_MEDIA_BASEURL`**                | ?streng                    | `CP_BASEURL`     |
  | **`CP_ADMIN_GATEWAY`**                | ?streng                    | `"cp-admin"`     |
  | **`CP_AUTH_GATEWAY`**                 | ?streng                    | `"cp-auth"`      |
  | **`CP_ANALYTICS_SALT`**               | streng                     | `udefinert`      |
  | **`CP_DATABASE_HOSTNAME`**            | ?streng                    | `"mariadb"`      |
  | **`CP_DATABASE_NAME`**                | ?streng                    | `MYSQL_DATABASE` |
  | **`CP_DATABASE_USERNAME`**            | ?streng                    | `MYSQL_USER`     |
  | **`CP_DATABASE_PASSWORD`**            | ?streng                    | `MYSQL_PASSORD`  |
  | **`CP_DATABASE_PREFIX`**              | ?streng                    | `"cp_"`          |
  | **`CP_CACHE_HANDLER`**                | [`"file"` eller `"redis"`] | `"file"`         |
  | **`CP_REDIS_HOST`**                   | ?streng                    | `"localhost"`    |
  | **`CP_REDIS_PASSORD`**                | ?streng                    | `tom`            |
  | **`CP_REDIS_PORT`**                   | ?tal                       | `6379`           |
  | **`CP_REDIS_DATABASE`**               | ?tal                       | `0`              |
  | **`CP_EMAIL_SMTP_HOST`**              | ?streng                    | `udefinert`      |
  | **`CP_EMAIL_FROM`**                   | ?streng                    | `udefinert`      |
  | **`CP_EMAIL_SMTP_USERNAME`**          | ?streng                    | `"localhost"`    |
  | **`CP_EMAIL_SMTP_PASSWORD`**          | ?streng                    | `null`           |
  | **`CP_EMAIL_SMTP_PORT`**              | ?tal                       | `25`             |
  | **`CP_EMAIL_SMTP_CRYPTO`**            | [`"tls"` eller `"ssl"`]    | `"tls"`          |
  | **`CP_ENABLE_2FA`**                   | ?boolsk                    | `udefinert`      |
  | **`CP_MEDIA_FILE_MANAGER`**           | ?streng                    | `udefinert`      |
  | **`CP_MEDIA_S3_ENDPOINT`**            | ?streng                    | `udefinert`      |
  | **`CP_MEDIA_S3_KEY`**                 | ?streng                    | `udefinert`      |
  | **`CP_MEDIA_S3_SECRET`**              | ?streng                    | `udefinert`      |
  | **`CP_MEDIA_S3_REGION`**              | ?streng                    | `udefinert`      |
  | **`CP_MEDIA_S3_BUCKET`**              | ?streng                    | `udefinert`      |
  | **`CP_MEDIA_S3_PROTOCOL`**            | ?tal                       | `udefinert`      |
  | **`CP_MEDIA_S3_PATH_STYLE_ENDPOINT`** | ?boolsk                    | `udefinert`      |
  | **`CP_MEDIA_S3_KEY_PREFIX`**          | ?streng                    | `udefinert`      |
  | **`CP_DISABLE_HTTPS`**                | ?[`0` eller `1`]           | `udefinert`      |
  | **`CP_MAX_BODY_SIZE`**                | ?tal (med suffiks)         | `512M`           |
  | **`CP_PHP_MEMORY_LIMIT`**             | ?tal (med suffiks)         | `512M`           |
  | **`CP_TIMEOUT`**                      | ?tal                       | `900`            |

- **castopod/web-server**

  | Variabelnamn           | Type               | Standardval |
  | ---------------------- | ------------------ | ----------- |
  | **`CP_APP_HOSTNAME`**  | ?streng            | `"app"`     |
  | **`CP_MAX_BODY_SIZE`** | ?tal (med suffiks) | `512M`      |
  | **`CP_TIMEOUT`**       | ?tal               | `900`       |
