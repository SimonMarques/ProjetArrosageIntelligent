<?php 
/**
 * Classe permettant de gérer les circuits d'arrosages et leur données
 */
class Circuit{

    function __construct() {
        $dsn = "mysql:host=localhost;dbname=arrosageintelligent;";
        // BDD serveur
        // $user = "projet18";
        // $password = "Projet18";
        // Ma BDD
        $user = 'root';
        $password = '';
        $dbhBDD = null;
        try {
            $dbhBDD = new PDO($dsn, $user, $password);
            $this->dbh = $dbhBDD;
        }catch(PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Retourne les ID des circuits pour l'utilisateur passé en paramètre
     * @param $idUser ID de l'utilisateur
     * @return $idCircuits Tableau contenant l'ensemble des circuits de l'utilisateur
     */
    function getCircuit($idUser){
        $sql ="SELECT id, nom
              FROM circuits
              WHERE idUser = '$idUser'";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $idCircuits = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $idCircuits;
    }
    
    /**
     * Retourne l'ensemble des vannes du circuit dont l'ID est passé en paramètre
     * @param $idCircuit ID du circuit
     * @return $dataVannesCircuit Tableau contenant l'ensemble des vannes du circuit
     */

     function getVannes($idCircuit){
         $sqlGetVannes = "SELECT id, nom
                          FROM vannes
                          WHERE idCircuit = '$idCircuit'";
        $sth = $this->dbh->prepare($sqlGetVannes);
        $sth->execute();
        $dataVannesCircuit = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $dataVannesCircuit;
     }

    /**
     * Retourne le nom du circuit passé en paremètre
     * @param $idCircuit ID du circuit
     */
    function getNom($idCircuit){
        $sql ="SELECT c.nom
               FROM circuits as c
               WHERE c.id = '$idCircuit'";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $nomCircuit = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $nomCircuit;       
    }

    /**
     * Supprime le circuit passé en paramètre
     * @param $idCircuit ID du circuit
     */
    function deleteCircuit($idCircuit){

    }
}
?>