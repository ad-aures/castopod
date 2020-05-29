# Castopod

Castopod is an open-source podcast hosting solution for everyone. Whether you are a beginner, an amateur or a professional, you will get everything you need: create, upload, publish, manage server subscriptions (WebSub embedded server), connect to the usual directories (Apple, Google, Spotify…), connect to the Fediverse (ActivityPub, Mastodon, Pleroma…) and measure your audience (IAB 2.0 compliant) so that you can monetize your content. Take back control: interact with your audience on your plateform (like, share, comment), the social network IS the podcast. Of course you may also export to proprietary social networks(Twitter, Instagram, Youtube, Facebook). Castopod can be hosted on any PHP/MySQL server: Unzip it and you and other podcasters are ready to broadcast professionally.

## Free

Castopod is a free and open-source solution (AGPL v3). Whether you choose to install it on your own server or have it hosted by a professional, all your data and analytics belong to you and you only.

## Social Media

Castopod is a part of Fediverse (Mastodon, Pleroma, PixelFed, PeerTube…). Podcasters and their audience can post, subscribe, like, comment and share natively. Millions of users already on Fediverse will be able to interact seamlessly.

## Flexible

Castopod is compatible with all Podcasts players and platforms (it can automatically generate an RSS feed).
Moreover Podcasters can choose to publish on Castopod while keeping their existing hosting solution (it can automatically generate posts from an existing RSS feed).

![Castopod Users](https://podlibre.org/img/Business-31.svg)

---

## Setup your development environment

Castopod is a web app based on the `php` framework [CodeIgniter 4](https://codeigniter.com).

To setup a dev environment, we use [Docker](https://www.docker.com/). A `docker-compose.yml` and `Dockerfile` are included in the project's root folder to help you kickstart your contribution.

> Know that you don't need any prior knowledge of Docker to follow the next steps. However, if you wish to use your own environment, feel free to do so!

### Prerequisites

0. Install [docker desktop](https://www.docker.com/products/docker-desktop).

1. Clone castopod project by running:

```bash
git clone https://code.podlibre.org/podlibre/castopod.git
```

2. Create a `./src/.env` file with the minimum required config to connect the app to the database:

```env
CI_ENVIRONMENT = development

database.default.hostname = mariadb
database.default.database = castopod
database.default.username = podlibre
database.default.password = castopod
```

> _NB._ You can tweak your environment by setting more environment variables. See the `./src/env` for examples or the [CodeIgniter4 User Guide](https://codeigniter.com/user_guide/index.html) for more info.

3. Add the repository you've cloned to docker desktop's `Settings` > `Resources` > `File Sharing`.
4. Install castopod's php dependencies
   - The project's dependencies aren't included in the repository, you have to download them using the composer service defined in `docker-compose.yml`

```bash
docker-compose run --rm composer install --ignore-platform-reqs
```

### Start docker containers

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


### Initialize and populate database

Build the database with the migrate command:

```bash
# loads the database schema during first migration
docker-compose run --rm app php spark migrate
```

Populate the database with the required data:

```bash
# Populates all categories
docker-compose run --rm app php spark db:seed CategorySeeder
```

### Start hacking

You're all set! Start working your magic by updating the project's files! Help yourself to the [CodeIgniter4 User Guide](https://codeigniter.com/user_guide/index.html) for more insights.

To see your changes, go to:

- [localhost:8080](http://localhost:8080/) for the castopod app
- [localhost:8888](http://localhost:8888/) for the phpmyadmin interface:

  - **Username**: podlibre
  - **Password**: castopod

---

### Going Further during development

#### Update app dependencies

You can update the project's dependencies using the `composer` service:

```bash
docker-compose run --rm composer update --ignore-platform-reqs
```

> _NB._ Composer commands look for the `composer.json` file to find castopod's php dependencies, all of which live in the `./src/vendor` folder. For more info, check out [Composer documentation](https://getcomposer.org/doc/).

#### Useful docker / docker-compose commands

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

### Developing inside a Container

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
