# Setup your development environment <!-- omit in toc -->

## Table of contents <!-- omit in toc -->

- [Introduction](#introduction)
- [Prerequisites](#prerequisites)
- [Start docker containers](#start-docker-containers)
- [Initialize and populate database](#initialize-and-populate-database)
- [Install/Update app dependencies](#installupdate-app-dependencies)
- [Start hacking](#start-hacking)
- [Going Further](#going-further)
  - [Useful docker / docker-compose commands](#useful-docker--docker-compose-commands)
- [Developing inside a Container](#developing-inside-a-container)

## Introduction

Castopod is a web app based on the `php` framework [CodeIgniter 4](https://codeigniter.com).

To setup a dev environment, we use [Docker](https://www.docker.com/). A `docker-compose.yml` and `Dockerfile` are included in the project's root folder to help you kickstart your contribution.

> Know that you don't need any prior knowledge of Docker to follow the next steps. However, if you wish to use your own environment, feel free to do so!

## Prerequisites

0. Install [docker desktop](https://www.docker.com/products/docker-desktop).

1. Clone castopod project by running:

```bash
git clone https://code.podlibre.org/podlibre/castopod.git
```

2. Create a `.env` file with the minimum required config to connect the app to the database:

```ini
CI_ENVIRONMENT = development

database.default.hostname = mariadb
database.default.database = castopod
database.default.username = podlibre
database.default.password = castopod
```

> _NB._ You can tweak your environment by setting more environment variables in your custom `.env` file. See the `env` for examples or the [CodeIgniter4 User Guide](https://codeigniter.com/user_guide/index.html) for more info.

3. Add the repository you've cloned to docker desktop's `Settings` > `Resources` > `File Sharing`.
4. Install castopod's php dependencies

> The project's php dependencies aren't included in the repository, you have to download them using the composer service defined in `docker-compose.yml`

```bash
docker-compose run --rm composer install --ignore-platform-reqs
```

5. Install castopod's js dependencies

> The project's js dependencies aren't included in the repository, you have to download them using the node service defined in `docker-compose.yml`

```bash
docker-compose run --rm node npm install
```

6. Build assets: javascript, styles, icons and svg images

> To generate public assets, you must run the following commands.

```bash
docker-compose run --rm node npm run build:js
docker-compose run --rm node npm run build:css
docker-compose run --rm node npm run build:icons
docker-compose run --rm node npm run build:svg
```

## Start docker containers

Go to project's root folder and run:

```bash
# starts all services declared in docker-compose.yml file
# -d option starts the containers in the background
docker-compose up -d

# See all running processes (you should see 3 processes running)
docker ps

# Alternatively, you can check all processes (you should see composer with an Exited status)
docker ps -a
```

> The `docker-compose up -d` command will boot 3 containers in the background:
>
> - `castopod_app`: a php based container with codeigniter requirements installed
> - `castopod_mariadb`: a [mariadb](https://mariadb.org/) server for persistent data
> - `castopod_phpmyadmin`: a phpmyadmin server to visualize the mariadb database
>
> _NB._ `./mariadb`, `./phpmyadmin` folders will be mounted in the project's root directory to persist data and logs.

## Initialize and populate database

1. Build the database with the migrate command:

```bash
# loads the database schema during first migration
docker-compose run --rm app php spark migrate -all
```

2. Populate the database with the required data:

```bash
# Populates all required data
docker-compose run --rm app php spark db:seed AppSeeder
```

You may also add only data you chose:

```bash
# Populates all categories
docker-compose run --rm app php spark db:seed CategorySeeder
# Populates all Languages
docker-compose run --rm app php spark db:seed LanguageSeeder
# Populates all podcasts platforms
docker-compose run --rm app php spark db:seed PlatformSeeder
# Populates all Authentication data (roles definition…)
docker-compose run --rm app php spark db:seed AuthSeeder
# Populates test data (login: admin / password: AGUehL3P)
docker-compose run --rm app php spark db:seed TestSeeder
```

3. (optionnal) Populate the database with test data:

```bash
docker-compose run --rm app php spark db:seed TestSeeder
```

This will add an active superadmin user with the following credentials:

- username: **admin**
- password: **AGUehL3P**

## Install/Update app dependencies

Castopod uses `composer` to manage php dependencies and `npm` to manage javascript dependencies.

You can install / update the project's dependencies using both `composer` and `node` services:

```bash
# install php dependencies
docker-compose run --rm composer install --ignore-platform-reqs

# update php dependencies
docker-compose run --rm composer update --ignore-platform-reqs
```

> _NB._ composer commands look for the `composer.json` file to find castopod's php dependencies, all of which live in the `vendor/` folder. For more info, check out [Composer documentation](https://getcomposer.org/doc/).

```bash
# install js dependencies
docker-compose run --rm node npm install

# update js dependencies
docker-compose run --rm node npm update
```

> _NB._ npm commands look for the `package.json` file to find castopod's js dependencies, all of which live in the `node_modules/` folder. For more info, check out [NPM documentation](https://docs.npmjs.com/).

## Start hacking

You're all set! Start working your magic by updating the project's files! Help yourself to the [CodeIgniter4 User Guide](https://codeigniter.com/user_guide/index.html) for more insights.

To see your changes, go to:

- [localhost:8080](http://localhost:8080/) for the castopod app
- [localhost:8888](http://localhost:8888/) for the phpmyadmin interface:

  - **Username**: podlibre
  - **Password**: castopod

---

## Going Further

### Useful docker / docker-compose commands

```bash
# monitor the app container
docker logs --tail 50 --follow --timestamps castopod_app

# monitor the mariadb container
docker logs --tail 50 --follow --timestamps castopod_mariadb

# monitor the phpmyadmin container
docker logs --tail 50 --follow --timestamps castopod_phpmyadmin

# restart docker containers
docker-compose restart

# Destroy all containers, opposite of `up` command
docker-compose down
```

Check [docker](https://docs.docker.com/engine/reference/commandline/docker/) and [docker-compose](https://docs.docker.com/compose/reference/) documentations for more insights.

## Developing inside a Container

If you're working in VSCode, you can take advantage of the `./.devcontainer/` folder. It defines a development container with preinstalled VSCode extensions so you don't have to worry about them. The container will be loaded with php, composer and git:

1. Install the VSCode extension [Remote - Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)
2. `Ctrl/Cmd + Shift + P` > `Open in container`

The VSCode window will reload inside the dev container.

You can check that the required packages are running in the console (`Terminal` > `New Terminal`):

```bash
php -v

composer -V

git version
```

For more info, see [VSCode Remote Containers](https://code.visualstudio.com/docs/remote/containers)
