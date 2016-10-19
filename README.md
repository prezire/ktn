## What is Ktn?

Ktn, which means Kitten, is an application that lets anyone file and manage a report
related to abandoned or endangered kittens. It also provides instructions how to
take care of them and contains contact information of animal welfare organizations in many areas.

### Prerequisites

- You need to download and install [Docker](https://www.docker.com/products/overview) (for OSX, Linux or Windows) to get started with our Local Development Environment.

### Installation

- After cloning or forking this project, go to the root folder and run:

```
$ docker-compose up -d
```
- The installation would take a while on first setup and once it is done, type in your browser: `http://localhost:8069/__a.php`
- This would open up a pre-installed `adminer` lightweight database management script and use these credentials:

```
MySQL Database Credentials
---
user: ktn_user
pass: ktn_pwd
host: ktn_mysql
```
- Once you are in, open the `ktn_db` database and import the file from `/application/models/ktn.sql`.
- You can then access the app from: `http://localhost:8069`

### Maintenance

- If you have any changes in the `Dockerfile`, `/nginx/default.conf` and/or `docker-compose.yml`, you need to run the following to `rebuild` and `restart` the server.

```
$ docker-compose build
$ docker-compose up -d --force-recreate
```

- To stop and delete all containers:

```
$ docker stop $(docker ps -a -q)
$ docker rm $(docker ps -a -q)
```

- If you wish to delete the images as well (I don't necessarily recommend):

```
$ docker rmi $(docker images -a -q)
```

### License

Please see the [license agreement](https://opensource.org/licenses/MIT).

### Resources

Report any issues to [Ktn in Github](https://github.com/prezire/ktn/issues). Or better yet, contribute.

### Acknowledgement

PHP, open-source communities, developers, designers, animal welfare organizations and you.
