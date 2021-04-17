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
     * Retourne les circuits pour l'utilisateur passé en paramètre
     * @param id ID de l'utilisateur
     */
    function getCircuit(idUser){
        
    }
    
    /**
     * Retourne les conditions defini pour un circuit passé en paremètre
     */
    function getDataCircuit(idCircuit){

    }
}

?>