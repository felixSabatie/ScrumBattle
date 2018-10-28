# ScrumBattle

## Instructions

Lancer le service MySQL
Créer un utilisateur MySQL appelé ScrumBattle
Changer la clé DB_HOST=127.0.0.1 du fichier `.env` avec l'addresse ip du server MySQL
Changer la clé DB_PASSWORD=ScrumBattle avec le mot de passe associé à l'utilisateur

Importer la base de données ScrumBattle.sql dans MySQL (ne pas se soucier des problèmes de contraintes s'il y en a)

Exécuter les commandes
```bash
$ php composer.phar install
$ php artisan passport:install
$ php artisan key:generate
```

```bash
$ php atisan serve
```
