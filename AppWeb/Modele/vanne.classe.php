<?php 
/**
 * Classe permettant de gérer les vannes d'arrosages et leur données
 */
class Vanne{

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
     * Retourne l'ensemble des données d'une vanne d'un circuit dont l'ID de la vanne est passé en paramètre
     * @param $idCircuit ID de la vannne
     * @return $dataVanne Tableau contenant l'ensemble des données de la vanne
     */

     function getDataVanne($idVanne){
         $sqlGetDataVannes = "SELECT v.nom, dv.date, dv.debitEau, c.nom as nomCircuit 
                          FROM vannes as v
                          INNER JOIN datavanne as dv ON v.id = dv.idVanne
                          INNER JOIN circuits as c ON v.idCircuit = c.id
                          WHERE v.id = '$idVanne'
                          ORDER BY dv.date";
        $sth = $this->dbh->prepare($sqlGetDataVannes);
        $sth->execute();
        $dataVanne = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $dataVanne;
     }

    /**
     * Supprime la vanne passé en paramètre
     * @param $idVanne ID de la vanne
     */
    function deleteVannne($idVanne){

    }

    /**
     * Créer une vanne 
     * @param $nom Nom de la vanne
     * @param $idCircuit ID du circuit
     */
    function createVanne($nom, $idCircuit){

    }
}
?>