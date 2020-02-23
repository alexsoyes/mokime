## Installation

For dev environment, I am using [docker-compose](https://docs.docker.com/compose/).

* Create a `mokime` directoy and go in there
* Create the directories `mkdir -vp mokime/db mokime/wordpress`
* Create a directory and unzip WordPress in there
  * `wget https://wordpress.org/latest.tar.gz`
  * `tar -xzvf latest.tar.gz`
  * `rm -v latest.tar.gz`
* Get the theme : `cd wordpress/wp-content/themes && git clone git@github.com:Dinath/mokime.git`

```
.
├── db
├── docker-compose.yaml
└── wordpress
```
* Add the following `docker-compose.yaml` file

```yaml
version: '3.1'

services:

  wordpress:
    image: wordpress
    restart: always
    ports:
      - 8080:80
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: exampleuser
      WORDPRESS_DB_PASSWORD: examplepass
      WORDPRESS_DB_NAME: exampledb
    volumes:
      - ./wordpress:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:5.7
    restart: always
    environment:
      MYSQL_DATABASE: exampledb
      MYSQL_USER: exampleuser
      MYSQL_PASSWORD: examplepass
      MYSQL_RANDOM_ROOT_PASSWORD: '1'
    volumes:
      - ./db:/var/lib/mysql

volumes:
  wordpress:
  db:
```

* Start it! 

```sh
docker-compose up --build
```
* Simple login into your WordPress admin panel.

## Access

* WordPress Administration : http://localhost:8080/wp-admin/
* WordPress Front-Office : http://localhost:8080

