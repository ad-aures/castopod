---
title: Officiella Docker images
sidebarDepth: 3
---

# Officiella Docker images

Castopod pushes 3 Docker images to the Docker Hub during its automated build
process:

- [**`castopod/app`**](https://hub.docker.com/r/castopod/app): apppaketet med
  alla Castopod-beroenden
- [**`castopod/web-server`**](https://hub.docker.com/r/castopod/web-server): en
  Nginx konfiguration för Castopod
- [**`castopod/video-clipper`**](https://hub.docker.com/r/castopod/video-clipper):
  an optional image building videoclips thanks to ffmpeg

Dessutom kräver Castopod en MySQL-kompatibel databas. En Redis databas kan
läggas till som cachehanterare.

## Taggar som stöds

- `utveckla` [unstable], senaste utvecklingsgrenen
- `beta` [stable], senaste betaversionen bygger
- `1.0.0-beta.x` [stable], specifik betaversion build (sedan `1.0.0-beta.22`)
- `latest` [stable], latest version build
- `1.x.x` [stable], specific version build (since `1.0.0`)

## Exempel på användning

1.  Installera [docker](https://docs.docker.com/get-docker/) och
    [docker-komponera](https://docs.docker.com/compose/install/)
2.  Skapa en `docker-compose.yml` fil med följande:

    ```yml
    version: "3.7"

    services:
      app:
        image: castopod/app:latest
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
        image: castopod/web-server:latest
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

      # this container is optional
      # add this if you want to use the videoclips feature
      ffmpeg:
        image: castopod/video-clipper:latest
        container_name: "castopod-video-clipper"
        volumes:
          - castopod-media:/opt/castopod/public/media
        environment:
          MYSQL_DATABASE: castopod
          MYSQL_USER: castopod
          MYSQL_PASSWORD: changeme
        networks:
          - castopod-db
        restart: unless-stopped

    volumes:
      castopod-media:
      castopod-db:
      castopod-cache:

    networks:
      castopod-app:
      castopod-db:
    ```

    Du måste anpassa vissa variabler efter dina behov (t.ex. `CP_BASEURL`,
    `MYSQL_ROOT_PASSWORD`, `MYSQL_PASSWORD` och `CP_ANALYTICS_SALT`).

3.  Ställ in en omvänd proxy för TLS (SSL/HTTPS)

    TLS är obligatoriskt för ActivityPub att arbeta. Detta jobb kan enkelt
    hanteras av en omvänd proxy, till exempel med
    [Caddy](https://caddyserver.com/):

    ```
    #castopod
    castopod.example.com {
        reverse_proxy localhost:8080
    }
    ```

4.  Kör `docker-komponera upp -d`, vänta på att den initieras och gå vidare till
    `https://castopod.example.com/cp-install` för att slutföra installationen av
    Castopod!

5.  Ni är alla klara, börja podcasting! 🎙️🚀

## Miljövariabler

- **castopod/video-clipper**

  | Variabel namn              | Type (`default`) | Standard         |
  | -------------------------- | ---------------- | ---------------- |
  | **`CP_DATABASE_HOSTNAME`** | ?string          | `"mariadb"`      |
  | **`CP_DATABASE_NAME`**     | ?sträng          | `MYSQL_DATABASE` |
  | **`CP_DATABASE_USERNAME`** | ?string          | `MYSQL_USER`     |
  | **`CP_DATABASE_PASSWORD`** | ?string          | `MYSQL_PASSWORD` |
  | **`CP_DATABASE_PREFIX`**   | ?string          | `"cp_"`          |

- **castopod/app**

  | Variabelt namn               | Type (`default`)        | Standard         |
  | ---------------------------- | ----------------------- | ---------------- |
  | **`CP_BASEURL`**             | sträng                  | `odefinierad`    |
  | **`CP_MEDIA_BASEURL`**       | ?string                 | `CP_BASEURL`     |
  | **`CP_ADMIN_GATEWAY`**       | ?string                 | `"cp-admin"`     |
  | **`CP_AUTH_GATEWAY`**        | ?string                 | `"cp-auth"`      |
  | **`CP_ANALYTICS_SALT`**      | string                  | `odefinierad`    |
  | **`CP_DATABASE_HOSTNAME`**   | ?string                 | `"mariadb"`      |
  | **`CP_DATABASE_NAME`**       | ?string                 | `MYSQL_DATABASE` |
  | **`CP_DATABASE_USERNAME`**   | ?string                 | `MYSQL_USER`     |
  | **`CP_DATABASE_PASSWORD`**   | ?string                 | `MYSQL_PASSWORD` |
  | **`CP_DATABASE_PREFIX`**     | ?string                 | `"cp_"`          |
  | **`CP_CACHE_HANDLER`**       | [`"file"` 或 `"redis"`] | `"file"`         |
  | **`CP_REDIS_HOST`**          | ?string                 | `"localhost"`    |
  | **`CP_REDIS_PASSWORD`**      | ?string                 | `null`           |
  | **`CP_REDIS_PORT`**          | ?number                 | `6379`           |
  | **`CP_REDIS_DATABASE`**      | ?number                 | `0`              |
  | **`CP_EMAIL_SMTP_HOST`**     | ?string                 | `undefined`      |
  | **`CP_EMAIL_FROM`**          | ?string                 | `undefined`      |
  | **`CP_EMAIL_SMTP_USERNAME`** | ?string                 | `"localhost"`    |
  | **`CP_EMAIL_SMTP_PASSWORD`** | ?string                 | `null`           |
  | **`CP_EMAIL_SMTP_PORT`**     | ?number                 | `25`             |
  | **`CP_EMAIL_SMTP_CRYPTO`**   | [`"tls"` eller `"ssl"`] | `"tls"`          |

- **castopod/web-server**

  | Variable name         | Typ     | Default |
  | --------------------- | ------- | ------- |
  | **`CP_APP_HOSTNAME`** | ?string | `"app"` |
