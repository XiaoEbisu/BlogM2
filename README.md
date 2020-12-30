## Installer Symfony
https://symfony.com/download

## Installer Composer 
https://getcomposer.org/download/ 
ou
https://getcomposer.org/Composer-Setup.exe


## Configuration de bdd
.env
APP_ENV=dev
DATABASE_URL=mysql://db_user:db_password@host:port/db_name?serverVersion=*.*

## Initialiser projet 
```PHP
php bin/console app:init
```

## Générer un controller
```PHP
php bin/console make:controller controllerName
or
symfony console make:controller controllerName
```

## Créer une version de migration
```PHP
php bin/console doctrine:migrations:generate
or
symfony console doctrine:migrations:generate
```

## Créer ou mettre à jour la version de migration
```PHP
php bin/console doctrine:migrations:diff
or
symfony console doctrine:migrations:diff
```

## Supprimer une version de migration
```PHP
php bin/console doctrine:migrations:version --delete $version

exemple : php bin/console doctrine:migrations:version --delete DoctrineMigrations\Version20201229214259  
```


## Appliquer le migration
```PHP
php bin/console doctrine:migrations:migrate
or
symfony console doctrine:migrations:migrate
```

## Démarrer le server
```PHP
symfony serve
or
php bin/console server:start
```
Server démarrer sur 127.0.0.1:8000

## Installer Heroku pour déployer
https://devcenter.heroku.com/articles/heroku-cli

## Tutoriel pour déployer une application symfony vers Heroku
https://devcenter.heroku.com/articles/deploying-symfony4

## Init projet à déployer Déployer projet
```GIT
git init
git add .
git commit -m "init projet"

heroku create
echo 'web: heroku-php-apache2 public/' > Procfile
git add Procfile
git commit -m "Heroku Procfile"
heroku config:set APP_ENV=prod
heroku config:set APP_SECRET=$(php -r 'echo bin2hex(random_bytes(16));')
heroku git:remote -a nom-projet
git push heroku master or git push heroku main
```
##

## Liens vers site déployé
heroku open
https://nguyenkhang-tran-blog.herokuapp.com/
:warning: Site en cours de dévéloppement.

## Base de données utilisé 
Postgresql de Heroku