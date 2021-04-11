<?php 

class Administrateur{
    public $login = null;
    public $password = null;
    public $dbh =null;

    function __construct() {
        $dsn = 'mysql:dbname=projet_web_3il;host=127.0.0.1';
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
 * Constructeur de l'administrateur avec les variables passées en parem
 * @param : $login Login de l'administrateur
 * @param : $login Login de l'administrateur
 */
function dataConstruct($login,$password){
    $mdpAdmin = $this->tryConnection($login,$password);
    if($mdpAdmin == false){
        return false;
    }
    $this->login = $login;
    $this->password = $mdpAdmin;
    return true;
}

/**
 * Etablit la connection de l'administrateur
 * @param $login Login de l'administrateur
 * @param : $login Login de l'administrateur
 * 
 * @return : Connection réussi : True, Erreur de connection : false
 */
function tryConnection($login,$password){
try{
    $dataAdministrateur = array();
    $sql = "SELECT login, mdp 
    FROM administrateur 
    WHERE login = '$login'";
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $dataAdmin = $sth->fetchAll(PDO::FETCH_ASSOC);
    if(empty($dataAdmin[0])){
        return false;
    }
    if(password_verify($password, $dataAdmin[0]['mdp']) && $dataAdmin[0]['login'] == $login){
        return $dataAdmin[0]['mdp'];
    } else{
        return false;
    }
} catch(PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    return false;
}
}

/**
 * Créer un administrateur
 * @param $login Login de l'administrateur à créer
 * @param $mdp Mot de pas de l'utilisateur à créer
 * 
 * @return $successCreate succès : true , erreur : false
 */
function createAdmin($login, $mdp){
    try{
    $passwordHash = password_hash($mdp, PASSWORD_BCRYPT);
    $sqlCreate = "INSERT INTO administrateur (login,mdp)
                VALUES('$login','$passwordHash')";
    $successCreate = $this->dbh->exec($sqlCreate); 
    return $successCreate;
} catch(PDOException $e) {
    echo $e->getMessage();
    return false;
}
}

/**
 * Suppression d'un administrateur
 * @param $login Login de l'administrateur à supprimer
 * 
 * @return $successDelete succès : true , erreur : false
 */
function deleteAdmin($login){
    try{
        $sqlDelete = "DELETE 
                    FROM administrateur
                    WHERE login = '$login'";
        $successDelete = $this->dbh->exec($sqlDelete);
        return $successDelete;
    } catch(PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

/**
 * Retourne le login de l'admin connecté
 * 
 * @return Login de l'admin
 * 
 */
function getLoginCurrent(){
    return $this->login;
}

}
?>

