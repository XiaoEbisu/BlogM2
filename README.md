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

## Mettre à jour la version migration
```PHP
php bin/console doctrine:migrations:diff
or
symfony console doctrine:migrations:diff
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

## Déployer projet
```GIT
git init
heroku git:remote -a nom-projet
git add .
git commit -m "init projet"
git push heroku master ou git push heroku HEAD:master 
```

## Liens vers site déployé
https://nguyenkhang-tran-blog.herokuapp.com/
:warning: Site en cours de dévéloppement.

## Base de données utilisé 
Postgresql de Heroku