# Installation

### In your environment dev

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
yarn encore production
```

##### Initialize envoirment dev:
```bash
composer require --dev server
```

Before start to code, when you local then create an file in root path, `.env.dev.local` (.env.*.local) and write all necessary configuration (secret, database...) in your environment.

See [here](https://symfony.com/blog/new-in-symfony-4-2-define-env-vars-per-environment) to explain more.

This file is in `.gitignore` and not will be save in repository.

##### To execute, just follow steps bellow: 

##### Start server:
```bash
$ php bin/console server:run
```

---

### In your web server

##### Git clone or you own project

```bash
git clone https://github.com/5i1/symfony-blog.git
```

##### Install composer (only used the necessary dependences)

```bash
composer install -n --prefer-dist
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

In your sites-available by the .conf file, you need to change the environment to prod:

```bash
    # The value of the environment variables used in the symfony application
    SetEnv APP_ENV prod
    SetEnv APP_SECRET <your-secret>
    SetEnv DATABASE_URL "mysql://db_user:db_pass@host:3306/db_name"

</VirtualHost>
```

and change the root document set for public/ folder:
DocumentRoot /var/www/project/public

Example file:

```bash
<VirtualHost *:80>

    ServerName www.thomaskanzig.com
    ServerAlias thomaskanzig.com
    DocumentRoot /var/www/html/sites/thomaskanzig/public
    ErrorLog /var/www/html/sites/thomaskanzig/public/error.log
    CustomLog /var/www/html/sites/thomaskanzig/public/requests.log combined
    RewriteEngine on

   # optionally set the value of the environment variables used in the application
   SetEnv APP_ENV prod
   SetEnv APP_SECRET 72733826773dc81024b2351c558203275118e947
   SetEnv DATABASE_URL "mysql://db_user:db_pass@host:3306/db_name"

</VirtualHost>
```

That's all.

For more information about the web server configuration and how improvement performance, access [here](https://symfony.com/doc/current/setup/web_server_configuration.html).