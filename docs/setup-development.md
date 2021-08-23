# Setup your development environment <!-- omit in toc -->

## Table of contents <!-- omit in toc -->

- [Introduction](#introduction)
- [Pre-requisites](#pre-requisites)
- [(recommended) Develop inside the app Container with VSCode](#recommended-develop-inside-the-app-container-with-vscode)
- [(not-recommended) Develop outside the app container](#not-recommended-develop-outside-the-app-container)
- [Install Castopod Host's dependencies](#install-castopod-hosts-dependencies)
- [Initialize and populate database](#initialize-and-populate-database)
- [Start hacking](#start-hacking)
- [Going Further](#going-further)
  - [Useful docker / docker-compose commands](#useful-docker--docker-compose-commands)
- [Known issues](#known-issues)
  - [Allocation failed - JavaScript heap out of memory](#allocation-failed---javascript-heap-out-of-memory)
  - [Files created inside container are attributed to root locally (Linux)](#files-created-inside-container-are-attributed-to-root-locally-linux)

## Introduction

Castopod Host is a web app based on the `php` framework
[CodeIgniter 4](https://codeigniter.com).

To setup a dev environment, we use [Docker](https://www.docker.com/). A
`docker-compose.yml` and `Dockerfile` are included in the project's root folder
to help you kickstart your contribution.

> Know that you don't need any prior knowledge of Docker to follow the next
> steps. However, if you wish to use your own environment, feel free to do so!

## Pre-requisites

0. Install [docker](https://docs.docker.com/get-docker).

1. Clone Castopod Host project by running:

   ```bash
   git clone https://code.podlibre.org/podlibre/castopod-host.git
   ```

2. Create a `.env` file with the minimum required config to connect the app to
   the database and use redis as a cache handler:

   ```ini
   CI_ENVIRONMENT="development"

   # By default, this is set to true in the app config.
   # For development, this must be set to false as it is
   # on a local environment
   app.forceGlobalSecureRequests=false

   app.baseURL="http://localhost:8080/"
   app.mediaBaseURL="http://localhost:8080/"

   admin.gateway="cp-admin"
   auth.gateway="cp-auth"

   database.default.hostname="mariadb"
   database.default.database="castopod"
   database.default.username="podlibre"
   database.default.password="castopod"

   cache.handler="redis"
   cache.redis.host = "redis"

   # You may not want to use redis as your cache handler
   # Comment/remove the two lines above and uncomment
   # the next line for file caching.
   #cache.handler="file"
   ```

   > _NB._ You can tweak your environment by setting more environment variables
   > in your custom `.env` file. See the `env` for examples or the
   > [CodeIgniter4 User Guide](https://codeigniter.com/user_guide/index.html)
   > for more info.

3. (for docker desktop) Add the repository you've cloned to docker desktop's
   `Settings` > `Resources` > `File Sharing`

## (recommended) Develop inside the app Container with VSCode

If you're working in VSCode, you can take advantage of the `.devcontainer/`
folder. It defines a development environment (dev container) with preinstalled
requirements and VSCode extensions so you don't have to worry about them. All
required services will be loaded automagically!

1. Install the VSCode extension
   [Remote - Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)
2. `Ctrl/Cmd + Shift + P` > `Open in container`

   > The VSCode window will reload inside the dev container. Expect several
   > minutes during first load as it is building all necessary services.

   **Note**: The dev container will start by running Castopod Host's php server.
   During development, you will have to start [Vite](https://vitejs.dev)'s dev
   server for compiling the typescript code and styles:

   ```bash
   # run Vite dev server
   npm run dev
   ```

   If there is any issue with the php server not running, you can restart them
   using the following commands:

   ```bash
   # run Castopod host server
   php spark serve --host 0.0.0.0
   ```

3. You're all set! 🎉

   You're now **inside the dev container**, you may use the VSCode console
   (`Terminal` > `New Terminal`) to run any command:

   ```bash
   # PHP is installed
   php -v

   # Composer is installed
   composer -V

   # npm is installed
   npm -v

   # git is installed
   git version
   ```

For more info, see
[VSCode Remote Containers](https://code.visualstudio.com/docs/remote/containers)

## (not-recommended) Develop outside the app container

You do not wish to use the VSCode devcontainer? No problem!

1. Start docker containers manually:

   Go to project's root folder and run:

   ```bash
   # starts all services declared in docker-compose.yml file
   # -d option starts the containers in the background
   docker-compose up -d

   # See all running processes (you should see 3 processes running)
   docker-compose ps

   # Alternatively, you can check all docker processes
   docker ps -a

   ```

   > The `docker-compose up -d` command will boot 4 containers in the
   > background:
   >
   > - `castopod-host_app`: a php based container with CodeIgniter4 requirements
   >   installed
   > - `castopod-host_redis`: a [redis](https://redis.io/) database to handle
   >   queries and pages caching
   > - `castopod-host_mariadb`: a [mariadb](https://mariadb.org/) server for
   >   persistent data
   > - `castopod-host_phpmyadmin`: a phpmyadmin server to visualize the mariadb
   >   database.

2. Run any command by prefixing them with `docker-compose run --rm app`:

   ```bash
   # use PHP
   docker-compose run --rm app php -v

   # use Composer
   docker-compose run --rm app composer -V

   # use npm
   docker-compose run --rm app npm -v

   # use git
   docker-compose run --rm app git version
   ```

## Install Castopod Host's dependencies

1. Install php dependencies with [Composer](https://getcomposer.org/)

   ```bash
   composer install
   ```

   > **Note:**
   >
   > The php dependencies aren't included in the repository. Composer will check
   > the `composer.json` and `composer.lock` files to download the packages with
   > the right versions. The dependencies will live under the `vendor/` folder.
   > For more info, check out the
   > [Composer documentation](https://getcomposer.org/doc/).

2. Install javascript dependencies with [npm](https://www.npmjs.com/)

   ```bash
   npm install
   ```

   > **Note:**
   >
   > The javascript dependencies aren't included in the repository. Npm will
   > check the `package.json` and `package.lock` files to download the packages
   > with the right versions. The dependencies will live under the `node_module`
   > folder. For more info, check out the
   > [NPM documentation](https://docs.npmjs.com/).

3. Generate static assets:

   ```bash
   # build all static assets at once
   npm run build:static

   # build specific assets
   npm run build:icons
   npm run build:svg
   ```

   > **Note:**
   >
   > The static assets generated live under the `public/assets` folder, it
   > includes javascript, styles, images, fonts, icons and svg files.

## Initialize and populate database

> **Note:**
>
> You may skip this section if you go through the install wizard (go to
> `/cp-install`).

1. Build the database with the migrate command:

   ```bash
   # loads the database schema during first migration
   php spark migrate -all
   ```

   You may need to undo the migration (rollback):

   ```bash
   # rolls back database schema (deletes all tables and their content)
   php spark migrate:rollback
   ```

2. Populate the database with the required data:

   ```bash
   # Populates all required data
   php spark db:seed AppSeeder
   ```

   You may choose to add data separately:

   ```bash
   # Populates all categories
   php spark db:seed CategorySeeder

   # Populates all Languages
   php spark db:seed LanguageSeeder

   # Populates all podcasts platforms
   php spark db:seed PlatformSeeder

   # Populates all Authentication data (roles definition…)
   php spark db:seed AuthSeeder
   ```

3. (optionnal) Populate the database with test data:

   ```bash
   # Populates test data (login: admin / password: AGUehL3P)
   php spark db:seed TestSeeder

   # Populates with fake podcast analytics
   php spark db:seed FakePodcastsAnalyticsSeeder

   # Populates with fake website analytics
   php spark db:seed FakeWebsiteAnalyticsSeeder
   ```

   TestSeeder will add an active superadmin user with the following credentials:

   - username: **admin**
   - password: **AGUehL3P**

## Start hacking

You're all set! Start working your magic by updating the project's files! Help
yourself to the
[CodeIgniter4 User Guide](https://codeigniter.com/user_guide/index.html) for
more insights.

To see your changes, go to:

- [localhost:8080](http://localhost:8080/) for the Castopod Host app
- [localhost:8888](http://localhost:8888/) for the phpmyadmin interface:

  - username: **podlibre**
  - password: **castopod**

---

## Going Further

### Useful docker / docker-compose commands

```bash
# monitor the app container
docker-compose logs --tail 50 --follow --timestamps app

# interact with redis server using included redis-cli command
docker exec -it castopod-host_redis redis-cli

# monitor the redis container
docker-compose logs --tail 50 --follow --timestamps redis

# monitor the mariadb container
docker-compose logs --tail 50 --follow --timestamps mariadb

# monitor the phpmyadmin container
docker-compose logs --tail 50 --follow --timestamps phpmyadmin

# restart docker containers
docker-compose restart

# Destroy all containers, opposite of `up` command
docker-compose down

# Rebuild app container
docker-compose build app
```

Check [docker](https://docs.docker.com/engine/reference/commandline/docker/) and
[docker-compose](https://docs.docker.com/compose/reference/) documentations for
more insights.

## Known issues

### Allocation failed - JavaScript heap out of memory

This happens when running `npm install`.

👉 By default, docker might not have access to enough RAM. Allocate more memory
and run `npm install` again.

### Files created inside container are attributed to root locally (Linux)

You may use Linux user namespaces to fix this on your machine:

> **Note:**
>
> Replace "username" with your local username

1. Go to `/etc/docker/daemon.json` and add:

   ```json
   {
     "userns-remap": "username"
   }
   ```

2. Configure the subordinate uid/guid:

   ```bash
   # in /etc/subuid
   username:1000:1
   username:100000:65536
   ```

   ```bash
   # in /etc/subgid
   username:1000:1
   username:100000:65536
   ```

3. Restart docker:

   ```bash
   sudo systemctl restart docker
   ```

4. That's it! Now, the root user in the container will be mapped to the user on
   your local machine, no more permission issues! 🎉

You can check
[this great article](https://www.jujens.eu/posts/en/2017/Jul/02/docker-userns-remap/)
to know more about how it works.
