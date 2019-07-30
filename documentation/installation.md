# Installation

## Local Environment

##### Git clone 

```bash
git clone https://github.com/5i1/symfony-blog.git
```

##### Install composer

```bash
composer install
```

##### Install yarn package

```bash
yarn install
```

##### Build the assets files

```bash
yarn encore dev
yarn encore production
```

##### Initialize envoirment dev:
```bash
composer require --dev server
```

Before start to code, when you local then create an file `.env.local` in root path and write all necessary configuration (secret, database...) in your environment.

See [here](https://symfony.com/blog/new-in-symfony-4-2-define-env-vars-per-environment) to explain more.

This file is in `.gitignore` and not will be save in repository.

##### Create and update the database structure with this:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

##### Generate fixtures data to begin development:
```bash
bin/console doctrine:fixtures:load
```

Authentication access:<br>
**Login:** admin<br> 
**Password:** admin

##### For execute the website then just follow steps bellow: 

##### Start server:
```bash
$ php bin/console server:run
```

---

## Production Environment (Web Server)

##### Git clone or you own project

```bash
git clone https://github.com/5i1/symfony-study-blog .
```

##### Install composer (only used the necessary dependences)

```bash
composer install --no-dev --prefer-dist --optimize-autoloader
```

##### Install yarn package

```bash
yarn install
```

##### Build the assets files

```bash
yarn encore production
```

##### Adding Rewrite Rules

```bash
composer require symfony/apache-pack
```

##### Configure your .env
Exist more way to configure variable in your environment, but the easiest way is just create an simple `.env.local` file and inform all variable you needed.

```bash
# Config
APP_ENV=prod
APP_SECRET=f9c53050608c5d72494b9asdas6e331sda
DATABASE_URL=mysql://root:12345@127.0.0.1:3306/database_name

# Costum variables
APP_NAME='Project'
FACEBOOK_URL='https://www.facebook.com'
INSTAGRAM_URL='https://www.instagram.com'
GITHUB_URL='https://github.com'
LINKEDIN_URL='https://www.linkedin.com'

```
Obs: You can just make an copy from `.env.test` file and configure your own environment.

##### Create and update the database structure with this:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

That's all.

For more information about the web server configuration and how improvement performance, access [here](https://symfony.com/doc/current/setup/web_server_configuration.html).