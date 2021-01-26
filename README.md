# Catalogue de Cours pour Etudiants d'Echanges - CCES TOURS 
<em> Auteurs : DEFIENAS Colin - GIGOT Florian - MOTARD Dylan - LASTENNET Dorian - HAN Lu - WANG Kuo - XU Rui </em>

## Résumé
Les étudiants étrangers en échange international avec l’Université de Tours doivent choisir les cours qu'ils suivront pendant leur séjour. Pour visualiser tous les cours disponibles, les étudiants étrangers ont accès à une plateforme numérique appelée « CCES » (acronyme de Catalogue de Cours pour Etudiants d’Echanges). Cependant, le site actuel est difficile à maintenir pour la Direction des Relations Internationales (DRI). Effectivement, il faut tenir à jour plus de 700 cours manuellement. De plus, pour les étudiants étrangers le site actuel n’est pas suffisamment intuitif. Ainsi, dans ce contexte, nous avons travaillé sur la conception et le développement d’une nouvelle solution, afin de la proposer à l’Université de Tours.

## Langages
PHP, JavaScript, HTML, CSS, Bootstrap

## Guides d'installation

### Guide installation et déploiement environnement Linux : 

#### Serveur web Apache et PHP :
Avant de commencer, veuillez vérifier que votre machine est à jour :

    > sudo apt-get update
    > sudo apt-get upgrade

Dev : Installer un package AMP (Apache MySQL PHP), tel que XAMPP (https://www.apachefriends.org/fr/download.html) ou WampServer (http://www.wampserver.com/).
Après installation, il peut y avoir un conflit de ports avec VMWare Workstation. Dans ce cas, il faut résoudre le problème en allant dans VMWare Workstation : Edit > Preferences > Shared VMs.

Prod : Il n’est pas recommandé de faire la même chose. Il faut plutôt utiliser les commandes suivantes : 

    > sudo apt-get install apache2
    > sudo apt-get install php libapache2-mod-php

#### Mise en place du projet
Télécharger le projet.

Il faut tout d’abord se placer dans le dossier de publication des sites (par exemple : C:\xampp\htdocs\ ou encore /var/www/html), et décompresser l’archive dans un dossier  nommé CCES.

A la suite de cela, il faut compléter le projet en utilisant Composer via l'invite de commande :

    > cd CCES

    > composer install
#### Finalisation de l’application
Droits des dossiers :

L’application génère et manipule automatiquement certains types de fichiers, mais il y a de fortes chances que le système de fichiers de votre système d’exploitation lui refuse l’accès aux dossiers du projet. En effet, PHP est souvent exécuté avec un autre utilisateur que le vôtre.

    > chmod a+w CCES/

Fin de procédure. 

### Guide installation et déploiement environnement Windows : 

#### Serveur web Apache et PHP :
Installer un package AMP (Apache MySQL PHP), tel que WampServer (http://www.wampserver.com/).

#### Mise en place du projet
Télécharger le projet.

Il faut tout d’abord se placer dans le dossier de publication des sites (par exemple : C:\xampp\htdocs\ ou encore /var/www/html), puis décompresser l’archive dans un dossier  nommé CCES.

Fin de procédure. 

