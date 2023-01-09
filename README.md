# Introduction 

L'objet de ce document est de décrire brièvement comment construire un squelette de projet Symfony 5.4 avec Composer.

# Téléchargement de Composer

Pour pouvoir lancer une création de projet Symfony, il est nécessaire de télécharger Composer, qui est un gestionnaire de dépendances de PHP.

Cela se fait en lançant les 4 commandes indiquées sur la page suivante : https://getcomposer.org/download/

# Installation de Symfony


Une fois que vous avez téléchargé Composer, vous pouvez créer l'ossature du projet Symfony en lançant la commande suivante (en supposant que le nom de votre projet est "symfony_skeleton") :

```sh
php composer.phar create-project symfony/skeleton:"^5.4" symfony_skeleton

```

Puis, lancer les 3 commandes suivantes :

```sh
cd symfony_skeleton
php ../composer.phar require webapp
php ../composer.phar require symfony/apache-pack

```

# Mise en place d'un petit morceau de code pour avoir une application minimale

Le squelette de l'application est désormais installé. vous pouvez désormais y ajouter du code.

Pour commencer, créer un fichier src/Controller/LuckyController.php avec le code suivant :

```sh

<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class LuckyController
{
    public function number(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}

```

Puis, créer un fichier config/routes.yaml avec le code suivant :

```sh

app_lucky_number:
    path: /
    controller: App\Controller\LuckyController::number

```


# Configuration d'Apache

Pour pouvoir afficher cette application minimale dans un navigateur web, il va falloir ajouter un virtual host dans votre configuration d'Apache.

Le répertoire à indiquer est le chemin absolu vers le dossier "public" du projet.
Dans l'exemple suivant, le chemin vers ce dossier est "C:\wamp64\symfony-skeleton\symfony_skeleton\public". Il va falloir que vous modifiiez le chemin de ce dossier selon l'emplacement où vous avez placé votre projet.

Voici le virtual host à ajouter, en supposant que le nom de domaine que vous souhaitez est "symfony-skeleton.local" :

```sh

<VirtualHost *:80>
	DocumentRoot "C:\wamp64\symfony-skeleton\symfony_skeleton\public"
	ServerName symfony-skeleton.local
	
	<Directory "C:\wamp64\symfony-skeleton\symfony_skeleton\public">
         Options Indexes FollowSymLinks MultiViews
         AllowOverride All
         Require all granted
    </Directory>
</VirtualHost>


```

# Affichage de l'application dans un navigateur

Si vous travaillez en local, il va falloir que vous ajoutiez la ligne suivante dans le fichier hosts de votre PC :

```sh

127.0.0.1 symfony-skeleton.local

```

Puis, vous devriez normalement pouvoir accéder à votre application en saisissant l'url suivante dans un navigateur :

http://symfony-skeleton.local/




