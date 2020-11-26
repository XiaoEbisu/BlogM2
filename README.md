# Initialiser projet 
```PHP
php bin/console app:init
```


# Configuration de bdd
.env

# Créer une version de migration
```PHP
php bin/console doctrine:migrations:generate
```


# Mettre à jour la version migration
```PHP
php bin/console doctrine:migrations:diff
```


# Déployer projet
```
git init
heroku git:remote -a nom-projet
git add .
git commit -m "init projet"
git push heroku master ou git push heroku HEAD:master 
```

On peut aussi synchroniser le projet avec github
