`MyTimeSheet Project`

* ce projet permet de gérer les projets et le suivi des tâches d'entreprise assignées aux employé
`technologies `: HTML5, CSS3, JAVASCRIPT, PHP Frameworks : BOOTSTRAP JQUERY

`Comment lancer le projet`?
- copier le dossier du projet 
- lancez votre serveur 

sur Wamp:
allez dans le dossier `c:/Wamp64/www/` et collez y le dossier 
sur Xamp 
allez dans le repertoire `c:/xamp/htdocs/` et collez votre dossier 
- allez dans votre gestionnaire de base de donnee et créez une base de donnée nommée `timesheet`
le lien pour acceder à votre gestionnaire de base de donnée est le suivant: `http://localhost/phpmyadmin/`

allez dans la bare de recherche de votre navigateur et tapez l'url: `http://localhost/timesheet/index.php`

 pour acceder à l'interface administrateur allez à l'adresse `http://localhost/timesheet/admin/index.php` 

 les détails de connexion sont les suivants: 
 espace administrateur:
 email: `eliemakodakowo@gmail.com`
 mot de passe:  `eliemakodakowo@gmail.com`


 pour l'interface client / visiteur 
 email: `emakotech@gmail.com`
 mot de passe:  `emakotech@gmail.com`
 ces informations sont succeptibles de changer suivant la volonté de l'administrateur

 Vous devez disposer d'un compte utilisateur pour pouvoir effectuer une quelconque manipulation



 + Quelques règles de Gestion:
 * seul les admin peuvent creer et assigner les taches.
 * une taches ne peut être assignée qu'a un seul utilisateur à la fois *
 * une fois la tâche terminée, l'utilisateur dispose d'un bouton cliquable pour signaler à l'administrateur
 * les routes vers d'autres pages du site vous seront restreinte si vous ne vous êtes pas authentifier 
 * l'utilisateur ne dispose que d'une seule interface qui lui forunit les informations dont il a besoin

 une fois la tache réalisée, les profils sont mis à jour 

 admin: 
 -mise à jour du nombre de projets finalisé sur son profil$
 
 Utilisateur 
 - mise à jour de son solde 
 - mise à jour de son nombre de projet terminé 
 - mise à jour de son portfolio 


* structure des fichiers 
le dossier `config`
 ce dossier contient toutes les configurations du projet ( les fichier d'entête et de pied de page) ainsi que le fichier 
 d'interraction avec la base de donnee toutes les méthodes de cette classe effectue au moins une operation vers la base de donnee

* le dossier `admin`:
- contient tous les fichiers de la partie administrateur.

Redigé par Frede Goldy Nama
