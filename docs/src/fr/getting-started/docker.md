---
title: Images Docker officielles
sidebarDepth: 3
---

# Images Docker officielles

Castopod publie 2 images Docker sur Docker Hub grâce à l'automatisation de la
construction des images par la chaîne d'intégration GitLab :

- [**`castopod/app`**](https://hub.docker.com/r/castopod/app): l'application
  avec toutes les dépendances de Castopod
- [**`castopod/web-server`**](https://hub.docker.com/r/castopod/web-server): un
  serveur Nginx avec une configuration adaptée à Castopod

De plus, Castopod nécessite une base de donnée compatible avec MySQL. Une base
de donnée Redis peut être utilisée pour gérer le cache.

## Tags disponibles

- `develop` [instable], dernière version de développement de Castopod

// d'autres tags sont à venir !

## Exemple d'utilisation

1.  Installez [docker](https://docs.docker.com/get-docker/) et
    [docker-compose](https://docs.docker.com/compose/install/)
2.  Créez un fichier `docker-compose.yml` contenant :

    ```yml
    version: "3.7"

    services:
      app:
        image: castopod/app:develop
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
        image: castopod/web-server:develop
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

    Vous devez adapter la configuration à vos besoins (e.g. `CP_BASEURL`,
    `MYSQL_ROOT_PASSWORD`, `MYSQL_PASSWORD` and `CP_ANALYTICS_SALT`).

3.  Mettre en place un reverse proxy pour gérer TLS (SSL/HTTPS)

    TLS est obligatoire pour faire fonctionner ActivityPub. Cette tâche peut
    facilement être déléguée à un reverse proxy, par exemple avec
    [Caddy](https://caddyserver.com/):

    ```
    #castopod
    castopod.example.com {
    	reverse_proxy localhost:8080
    }
    ```

4.  Lancez la commande `docker-compose up -d`, attendez l'initialisation et
    rendez-vous sur `https://castopod.example.com/cp-install` pour finir
    l'installation de Castopod !

5.  Tout est bon à présent, à vos podcasts ! 🎙️🚀

## Variables d'environnement

- **castopod/app**

  | Nom de le variable         | Type (`default`)                    |
  | -------------------------- | ----------------------------------- |
  | **`CP_BASEURL`**           | string (`undefined`)                |
  | **`CP_MEDIA_BASEURL`**     | ?string (`(empty)`)                 |
  | **`CP_ADMIN_GATEWAY`**     | ?string (`"cp-admin"`)              |
  | **`CP_AUTH_GATEWAY`**      | ?string (`"cp-auth"`)               |
  | **`CP_ANALYTICS_SALT`**    | string (`undefined`)                |
  | **`CP_DATABASE_HOSTNAME`** | ?string (`"mariadb"`)               |
  | **`CP_DATABASE_NAME`**     | string (`MYSQL_DATABASE`)           |
  | **`CP_DATABASE_USERNAME`** | string (`MYSQL_USER`)               |
  | **`CP_DATABASE_PASSWORD`** | string (`MYSQL_PASSWORD`)           |
  | **`CP_DATABASE_PREFIX`**   | ?string (`"cp_"`)                   |
  | **`CP_CACHE_HANDLER`**     | ?[`"file"` or `"redis"`] (`"file"`) |
  | **`CP_REDIS_HOST`**        | ?string (`"localhost"`)             |
  | **`CP_REDIS_PASSWORD`**    | ?string (`null`)                    |
  | **`CP_REDIS_PORT`**        | ?number (`6379`)                    |
  | **`CP_REDIS_DATABASE`**    | ?number (`0`)                       |

- **castopod/web-server**

  | Nom de la variable    | Type (`default`)  |
  | --------------------- | ----------------- |
  | **`CP_APP_HOSTNAME`** | ?string (`"app"`) |
