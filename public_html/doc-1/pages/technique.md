## Documentation technique


### Installation et mise à jour du projet

Voici les différentes étapes que vous serez amené à réaliser pour mettre à jour le projet.  
L'utilisation de git est fortement conseillé.

- Connexion en SSH.  
		MAC-Leo:~ Leo$ ssh nil@puce.geap.iut-tlse3.fr
		nil@puce.geap.iut-tlse3.fr's password: 
		Linux puce 3.2.0-4-amd64 #1 SMP Debian 3.2.65-1+deb7u2 x86_64

- Mise à jour du code avec un *git pull* :  
		nil@puce:~$ git pull origin prod
		Username for 'https://github.com': serut
		Password for 'https://serut@github.com': 
		remote: Counting objects: 66, done.
		remote: Compressing objects: 100% (56/56), done.
		remote: Total 66 (delta 51), reused 25 (delta 10), pack-reused 0
		Unpacking objects: 100% (66/66), done.
		From https://github.com/julienCsj/projetM1
		* branch            master     -> FETCH_HEAD
		Updating 4c89d79..d6b8e54
		Fast-forward

Vous devez éditer les paramètres de base de données dans le cas d'une nouvelle installation. 
	nil@puce:~$ nano app/config/database.php
    'mysql' => array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => *'A_CHANGER'*,
        'username'  => *'A_CHANGER'*,
        'password'  => *'A_CHANGER'*,
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ),

Editez le fichier .htaccess (public_html/.htaccess) et décommentez la ligne pour le rewrite URL fonctionne :
    #RewriteBase /~nil/
    en
    RewriteBase /~nil/

Allouez les bons droits au dossier app/storage pour qu'ils ressemblent à ceci
	drwxr-xr-x  7 www-data users 4096 mars  31 11:53 storage



### Ajouter un responsable

Pour ajouter un responsable, vous devez editer **app/controllers/IdentificationController.php**.
Il suffit d'ajouter le login des enseignants dans 
    public static $listeResponsable = array(...,"nouvel.user");

### Reinitialiser la base de données

Nous utilisons le système de [Migration](http://laravel.com/docs/4.2/migrations) de Laravel. La migration s'appuie sur une migration qui a un tuple par migration effective.

Si vous souhaitez créer de nouvelles tables, il faut créer un nouveau fichier de migration :
	php artisan migrate:make le_nom_de_la_migration


Si vous souhaitez executer toutes les migrations présentes dans le dossier migration et qui ne serait pas dans la table migration :
	php artisan migrate

Si vous souhaitez rollback d'une migration et ainsi supprimer les données et le schéma :
	php artisan migrate:rollback

Si vous souhaitez rollback toutes les migrations et ainsi supprimer les données et le schéma :
	php artisan migrate:reset

Si votre migration echoue en cours, des tables vont se créer sans pour autant finir correctement et ajouter un tuple dans la table migration.

### Laravel

Ce projet est basé sur Laravel 4.2, un framework PHP 5.  
Vous pouvez retrouver la documentation technique [ici (site officiel)](http://laravel.com/docs) et [ici (branche 4.2 de la documentation officielle)](https://github.com/laravel/docs/tree/4.2) 

