<?php 
/**
 * Classe permettant de gérer les vannes d'arrosages et leur données
 */
class Vanne{

    function __construct() {
        $dsn = 'mysql:dbname=arrosageintelligent;host=projet18ddns.net;port:44480';
        $user = 'projet18';
        $password = 'Projet18';
        // $dsn = 'mysql:dbname=arrosageintelligent;host=127.0.0.1';
        // $user = 'root';
        // $password = '';
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
         $sqlGetDataVannes = "SELECT v.nom, dv.date, dv.debitEau,v.statut , c.nom as nomCircuit
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
      * Change le statut de la vanne passé en paramètre (ON ou OFF)
      * @param $idCircuit ID de la vannne
      * @param $statut Statut à changer
      * @return BOOL True : Succès | False : Erreur
      */
    function changeStatut($idVanne, $statut){
        $sql = "UPDATE vannes
                SET statut = '$statut'
                WHERE id = '$idVanne'";
        $nbLine = $this->dbh->exec($sql);
        if ($nbLine != 1){
            return false;
        } else {
            return true;
        }
    }

    /**
      * Programmation d'une date d'arrosage passé en paramètre
      * @param $idCircuit ID de la vannne
      * @param $date Date
      * @param $heureD Heure de début
      * @param $heureF Heure de fin
      * @return BOOL True : Succès | False : Erreur
      */
    function programmeDate($idVanne, $date, $heureD, $heureF){
        $array = Array (
            "idVanne" => $idVanne,
            "date" => $date,
            "heureDebut" => $heureD,
            "heureFin" => $heureF
        );
        
        // encode array to json
        $json = json_encode($array);
        $bytes = file_put_contents("../Json/Vanne".$idVanne."_".$date.".json", $json);
        if(is_int($bytes)){
            return true;
        } else {
            return false;
        }
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