<?php 
/**
 * Classe permettant de gérer les vannes d'arrosages et leur données
 */
class Vanne{

    function __construct() {
        $dsn = "mysql:host=localhost;dbname=arrosageintelligent";
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
        $bytes = file_put_contents("../Json/Json_Date/Vanne".$idVanne."_".$date.".json", $json);
        if(is_int($bytes)){
            chmod("../Json/Json_Date/Vanne".$idVanne."_".$date.".json", 0777);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gestion de la suppresion des date de programmation eau en fonction de la vanne passé en paramètre
     * @param $idVanne ID de la vanne 
     * @return $dataProg Tableau contenant les nom des fichiers
     */
    function gestionDateProg($idVanne){

        $d = dir("../Json/Json_Date/");
        $search = "Vanne".$idVanne;
        $mot = trim($search);
        $data = Array();
        $static = null;
        $compteur = 0;
        while($entry = $d->read()) { 
            if(preg_match("#($mot+?)#s", $entry, $new) === 1){
                $static = $entry;
                $json = strstr($static, ".json");
                if ($json != false){
                    $data[$compteur] = $static;
                    $compteur++;
                };
            }
            
        } 
        $d->close();
        $dataProg = Array();
        for($i=0;$i<=($compteur-1);$i++){
            $url = "../Json/Json_Date/".$data[$i];
            $json = file_get_contents($url);
            $dataProg[$i] = json_decode($json);
        }
        return $dataProg;
    }

    /**
     * Suppression de la programmation d'une date pour une vanne passé en paramètre
     */
    function deleteDateProg($idVanne, $date){
        $d = dir("../Json/Json_Date/");
        $search = "Vanne".$idVanne."_".$date;
        $mot = trim($search);
        $data = Array();
        $static = null;
        $compteur = 0;
        while($entry = $d->read()) { 
            preg_match("#($mot+?)#s", $entry, $new);
            $static = $entry;
            $json = strstr($static, ".json");
            if ($json != false){
                $data[$compteur] = $static;
                $compteur++;
            };
        } 
        if($compteur != 0){
            if(unlink("../Json/Json_Date/".$data[0])){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

}
?>