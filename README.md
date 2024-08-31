Livequestion

Description :
Livequestion est une application Symfony permettant de gérer des questions et réponses dans un environnement communautaire. Les utilisateurs peuvent poser des questions, y répondre et gérer leurs profils.


Prérequis :
Avant de commencer, assurez-vous que vous avez installé les éléments suivants :

- PHP 8.0 ou supérieur
- Composer pour la gestion des dépendances
- Symfony CLI
- MySQL


Installation :

- Clonez le dépôt :
git clone https://github.com/username/nom-du-projet.git
- Installez les dépendances :
composer install
- Créez et configurez la base de données
Copiez le fichier .env et modifiez les paramètres de la base de données :
Modifiez .env.local pour configurer vos informations de base de données :
DATABASE_URL="mysql://root@127.0.0.1:3306/livequestion?serverVersion=10.4.32-MariaDB&charset=utf8mb4"

Créez la base de données et les tables :

- php bin/console doctrine:database:create
- php bin/console doctrine:make:migration
- php bin/console doctrine:migrations:migrate

Charger les données de base (facultatif)

Si vous avez des fixtures, chargez-les :
- php bin/console doctrine:fixtures:load

Démarrez le serveur :
- symfony server:start -d


Utilisation :
Ouvrez votre navigateur et allez à http://localhost:8000 pour voir l'application en action.
