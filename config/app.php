<?php
class App
{
    public $host =  "localhost";
    public $database = "timesheet"; //nom de votre base de données ici
    public $password = "";  // votre mot de passe utilisateur ici
    public $user = "root"; //votre nom d'utilisateur 
    public $lien_connexion;
    //connexion à la base de données
    public function __construct()
    {
        $this->connecter();
    }
    public function connecter()
    {
        $this->lien_connexion =  new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=utf8", $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        if (!$this->lien_connexion) {
            echo "erreur de connexion à la base de données";
        }
    }
    public function SelectionnerTout($requete)
    {
        $ligne = $this->lien_connexion->query($requete);
        $ligne->execute();
        $resultat = $ligne->fetchAll(PDO::FETCH_OBJ);
        if ($resultat) {
            return $resultat;
        } else {
            return false;
        }
    }
    //lecture d'un élément de la base de données
    public function SelectionnerUn($requete)
    {
        $ligne = $this->lien_connexion->query($requete);
        $ligne->execute();
        $resultat = $ligne->fetch(PDO::FETCH_OBJ);
        if ($resultat) {
            return $resultat;
        } else {
            return false;
        }
    }
    public function inserer($requete, $tableau_donnee, $destination)
    {

        $insert = $this->lien_connexion->prepare($requete);
        $insert->execute($tableau_donnee);
        header("location: " . $destination . "");
    }

    //supprimer les éléments de la base de données
    public function supprimer($requete, $destination)
    {
        $sup = $this->lien_connexion->query($requete);
        $sup->execute();
        header("location: " . $destination . "");
    }

    public function maj($req, $destination)
    {
        $ligne = $this->lien_connexion->prepare($req);
        $ligne->execute();
        header("location: " . $destination . "");
    }
    public function se_connecter_admin($requete, $tableau_donnee, $destination)
    {
        $tab = ['email' => $tableau_donnee['email'],
                "statutAdmin"=>$tableau_donnee["statutAdmin"]
                ];
        $connection_user =  $this->lien_connexion->prepare($requete);
        $connection_user->execute($tab);
        $resultat = $connection_user->fetch(PDO::FETCH_ASSOC);
        if ($connection_user->rowCount() > 0) {
            if ($tableau_donnee['password']== $resultat['passwordAdmin']) {
                //début des sessions
                session_start();
                $_SESSION['idAdmin'] = $resultat['idAdmin'];
                $_SESSION['nomAdmin'] = $resultat['nomAdmin'];
                $_SESSION['emailAdmin'] = $resultat['emailAdmin'];
                $_SESSION['DateNaissAdmin'] = $resultat['DateNaissAdmin'];
                $_SESSION['BioAdmin'] = $resultat['BioAdmin'];
                $_SESSION['ExperienceAdmin'] = $resultat['ExperienceAdmin'];
                $_SESSION['CompetenceAdmin'] = $resultat['CompetenceAdmin'];
                $_SESSION['passwordAdmin'] = $resultat['passwordAdmin'];
                $_SESSION['statutAdmin'] = $resultat['statutAdmin'];
                $_SESSION['DateAjoutAdmin'] = $resultat['DateAjoutAdmin'];
                $_SESSION['NombreProjetAdmin'] = $resultat['NombreProjetAdmin'];
                $_SESSION['ImageAdmin'] = $resultat['ImageAdmin'];

                header("location: " . $destination . "");
            } else {
                echo "mauvais mot de passe";
            }
        } else {
            echo "aucune adresse mail correspondante";
        }
    }
    public function se_connecter_client($requete, $tableau_donnee, $destination)
    {
        $tab = ['email' => $tableau_donnee['email'],
        "statutUSer"=>$tableau_donnee["statutUSer"]
        ];
        $connection_user =  $this->lien_connexion->prepare($requete);
        $connection_user->execute($tab);
        $resultat = $connection_user->fetch(PDO::FETCH_ASSOC);
        if ($connection_user->rowCount() > 0) {
            if ($tableau_donnee['password']== $resultat['passwordUSer']) {
                //début des sessions
                session_start();
                $_SESSION['idUSer'] = $resultat['idUSer'];
                $_SESSION['nomUSer'] = $resultat['nomUSer'];
                $_SESSION['emailUSer'] = $resultat['emailUSer'];
                $_SESSION['DateNaissUSer'] = $resultat['DateNaissUSer'];
                $_SESSION['BioUSer'] = $resultat['BioUSer'];
                $_SESSION['ExperienceUSer'] = $resultat['ExperienceUSer'];
                $_SESSION['CompetenceUSer	'] = $resultat['CompetenceUSer	'];
                $_SESSION['passwordUSer'] = $resultat['passwordUSer'];
                $_SESSION['statutUSer'] = $resultat['statutUSer'];

                $_SESSION['ImageUSer'] = $resultat['ImageUSer'];
                $_SESSION['DateAjoutUSer'] = $resultat['DateAjoutUSer'];
                $_SESSION['NombreProjetUSer'] = $resultat['NombreProjetUSer'];
                $_SESSION['GainsUser'] = $resultat['GainsUser'];

                header("location: " . $destination . "");
            } else {
                echo "mauvais mot de passe";
            }
        } else {
            echo "aucune adresse mail correspondante";
        }
    }
    public function debut_session()
    {
        session_start();
    }
    public function maj2($req)
    {
        $ligne = $this->lien_connexion->prepare($req);
        $ligne->execute();
        // header("location: ".$destination."");

    }
    public  function calculateDaysBetweenDates($date1, $date2)
    {
        $date1 = DateTime::createFromFormat('d/m/Y', $date1);
        $date2 = DateTime::createFromFormat('d/m/Y', $date2);
        $interval = $date1->diff($date2);
        return $interval->days;
    }
}
