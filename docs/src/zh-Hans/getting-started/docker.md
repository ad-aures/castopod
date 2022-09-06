---
title: 官方 Docker 镜像
sidebarDepth: 3
---

# 官方 Docker 镜像

Castopod 在 Docker Hub 自动构建 程序中将 Docker 镜像推送至 Docker Hub ：

- [**`castopod/app`**](https://hub.docker.com/r/castopod/app)：应用程序包，包含
  所有 Castopod 依赖关系
- [**`castopod/web-server`**](https://hub.docker.com/r/castopod/web-server)：Castopod
  的 Nginx 配置

此外，Castopod 需要一个与 MySQL 兼容的数据库。 Redis 数据库 可以添加为缓存处理器
。

## 目前支持的标签

- `develop` [unstable], 最新开发分支版本

更多标签即将到来！

## 用法示例：

1.  安装 [Docker](https://docs.docker.com/get-docker/) 和
    [docker-compose](https://docs.docker.com/compose/install/)
2.  创建 `docker-compose.yml` 文件，并添加以下内容：

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

    你还需要调整一些变量。（例如：`CP_BASEURL`， `MYSQL_ROOT_PASSWORD`，
    `MYSQL_PASSSWORD` 和 `CP_ANALYTICS_SALT`）

3.  设置 TLS 反向代理 (SSL/HTTPS)

    TLS 是 ActivePub 工作的强制性要求。 此操作可用通过反向代理轻松解决，例如使用
    [Caddy](https://caddyserver.com/) 处理：

    ```
    #castopod
    castopod.example.com {
        reverse_proxy localhost:8080
    }
    ```

4.  运行命令 `docker-compose up -d`， 等待初始化后跳转到
    `https://castopod.example.com/cp-install` 来完成 Castopod 的设置！

5.  一切准备就绪，开始博客吧！ 🎙️🚀

## 环境变量

- **castopod/app**

  | 变量名称                   | 类型 (`默认值`)                     |
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

  | 变量名称              | 类型 (`默认值`)   |
  | --------------------- | ----------------- |
  | **`CP_APP_HOSTNAME`** | ?string (`"app"`) |
