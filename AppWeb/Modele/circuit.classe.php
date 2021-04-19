<?php 
/**
 * Classe permettant de gérer les circuits d'arrosages et leur données
 */
class Circuit{

    function __construct() {
        $dsn = 'mysql:dbname=arrosageintelligent;host=127.0.0.1';
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
     * @param idUser ID de l'utilisateur
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
     * Retourne les conditions defini pour un circuit passé en paremètre
     * @param $idCircuit ID du circuit
     */
    function getDataCircuit($idCircuit){
        $sqlGetData ="SELECT c.nom, dc.date, dc.debitEau
               FROM circuits as c
               INNER JOIN datacircuit as dc on c.id = dc.idCircuit
               WHERE c.id = '$idCircuit'";
        $sth = $this->dbh->prepare($sqlGetData);
        $sth->execute();
        $dataCircuit = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $dataCircuit;       
    }

    /**
     * Supprime le circuit passé en paramètre
     * @param $idCircuit ID du circuit
     */
    function deleteCircuit($idCircuit){

    }
}
?>