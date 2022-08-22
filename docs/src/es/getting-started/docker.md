---
title: Imágenes oficiales de Docker
sidebarDepth: 3
---

# Imágenes oficiales de Docker

Castopod lanza 2 imágenes Docker al Docker Hub durante su proceso de
construcción automatizada:

- [**`castopod/aplicación`**](https://hub.docker.com/r/castopod/app): el paquete
  de aplicación
- [**`castopod/servidor-web`**](https://hub.docker.com/r/castopod/web-server):
  una configuración Nginx para Castopod

Adicionalmente, Castopod requiere una base de datos compatible con MySQL. Una
base de datos Redis puede ser añadida como gestor de caché.

## Etiquetas admitidas

- `desarrollo` [unstable], última rama de desarrollo construida

// más etiquetas por llegar!

## Ejemplo de uso

1.  Instalar [docker](https://docs.docker.com/get-docker/) y
    [docker-compose](https://docs.docker.com/compose/install/)
2.  Crear un archivo `docker-compose.yml` con lo siguiente:

    ```yml
    versión: "3.7"

    servicios:
      applicación:
        imagen: castopod/app:develop
        nombre_contenedor: "castopod-app"
        volúmenes:
          - castopod-media:/opt/castopod/public/media
        ambiente:
          MYSQL_DATABASE: castopod
          MYSQL_USER: castopod
          MYSQL_PASSWORD: cámbiame
          CP_BASEURL: "http://castopod.example.com"
          CP_ANALYTICS_SALT: cámbiame
          CP_CACHE_HANDLER: redis
          CP_REDIS_HOST: redis
        redes:
          - castopod-app
          - castopod-db
        reiniciar: unless-stopped

      servidor-web:
        imagen: castopod/web-server:develop
        nombre_contenedor: "castopod-web-server"
        volúmenes:
          - castopod-media:/var/www/html/media
        redes:
          - castopod-app
        puertos:
          - 8080:80
        reiniciar: unless-stopped

      mariadb:
        imagen: mariadb:10.5
        nombre_contenedor: "castopod-mariadb"
        redes:
          - castopod-db
        volúmenes:
          - castopod-db:/var/lib/mysql
        ambiente:
          MYSQL_ROOT_PASSWORD: cámbiame
          MYSQL_DATABASE: castopod
          MYSQL_USER: castopod
          MYSQL_PASSWORD: cámbiame
        reiniciar: unless-stopped

      redis:
        imagen: redis:7.0-alpine
        nombre_contenedor: "castopod-redis"
        volúmenes:
          - castopod-cache:/data
        redes:
          - castopod-app

    volúmenes:
      castopod-media:
      castopod-db:
      castopod-cache:

    redes:
      castopod-app:
      castopod-db:
    ```

    Debes adaptar algunas variables a tus necesidades (ej. `CP_BASEURL`,
    `MYSQL_ROOT_PASSWORD`, `MYSQL_PASSWORD` and `CP_ANALYTICS_SALT`).

3.  Configura un proxy inverso para TLS (SSL/HTTPS)

    TLS es obligatorio para que ActivityPub funcione. Este trabajo puede ser
    fácilmente manejado por un proxy inverso, por ejemplo con
    [Caddy](https://caddyserver.com/):

    ```
    #castopod
    castopod.example.com {
        reverse_proxy localhost:8080
    }
    ```

4.  Ejecuta `docker-compose -d`, espera a que se inicie y ve a
    `https://castopod.example.com/cp-install` para terminar de configurar
    Castopod!

5.  Todo listo, empieza a podcastear! 🎙️🚀

## Variables del Entorno

- **castopod/app**

  | Nombre de la Variable         | Escribe (`predeterminado`)          |
  | ----------------------------- | ----------------------------------- |
  | **`CP_URLBASE`**              | string (`indefinido`)               |
  | **`CP_MEDIA_URLBASE`**        | ?string (`(vacío)`)                 |
  | **`CP_PUERTA_ADMINISTRADOR`** | ?string (`"cp-admin"`)              |
  | **`CP_AUTH_PUERTA`**          | ?string (`"cp-auth"`)               |
  | **`CP_ANALÍTICAS_SALT`**      | string (`indefinido`)               |
  | **`CP_DATABASE_HOSTNAME`**    | ?string (`"mariadb"`)               |
  | **`CP_DATABASE_NAME`**        | string (`MYSQL_DATABASE`)           |
  | **`CP_DATABASE_USERNAME`**    | string (`MYSQL_USER`)               |
  | **`CP_DATABASE_PASSWORD`**    | string (`MYSQL_PASSWORD`)           |
  | **`CP_DATABASE_PREFIX`**      | ?string (`"cp_"`)                   |
  | **`CP_CACHE_HANDLER`**        | ?[`"file"` or `"redis"`] (`"file"`) |
  | **`CP_REDIS_HOST`**           | ?string (`"localhost"`)             |
  | **`CP_REDIS_PASSWORD`**       | ?string (`null`)                    |
  | **`CP_REDIS_PORT`**           | ?number (`6379`)                    |
  | **`CP_REDIS_DATABASE`**       | ?number (`0`)                       |

- **castopod/web-server**

  | Variable name         | Type (`default`)  |
  | --------------------- | ----------------- |
  | **`CP_APP_HOSTNAME`** | ?string (`"app"`) |
