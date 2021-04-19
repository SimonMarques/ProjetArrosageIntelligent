<?php 

/**
 * Classe des utilisateurs
 */

class Utilisateur{
    public $login = null;
    public $password = null;
    public $dbh =null;

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
 * Constructeur de l'utilisateur avec les variables passées en parem
 * @param : $login Login de l'utilisateur
 * @param : $login Login de l'utilisateur
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
 * Etablit la connection de l'utilisateur
 * @param $login Login de l'utilisateur
 * @param : $login Login de l'utilisateur
 * 
 * @return : Connection réussi : True, Erreur de connection : false
 */
function tryConnection($login,$password){
try{
    $sql = "SELECT login, mdp 
    FROM utilisateurs
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
 * Retourne l'ID de la personne qui s'est connecté ou crée
 * @param $login Login de l'utilisateur
 */
function getId($login){
    $sql="SELECT id
          FROM utilisateurs
          WHERE login = '$login'";
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $id = $sth->fetch(PDO::FETCH_ASSOC);
    return $id;     
}

/**
 * Créer un utilisateur
 * @param $login Login de l'utilisateur à créer
 * @param $mdp Mot de pas de l'utilisateur à créer
 * 
 * @return $successCreate succès : true , erreur : false
 */
function createAdmin($login, $mdp){
    try{
    $passwordHash = password_hash($mdp, PASSWORD_BCRYPT);
    $sqlCreate = "INSERT INTO utilisateurs (login,mdp)
                VALUES('$login','$passwordHash')";
    $successCreate = $this->dbh->exec($sqlCreate); 
    return $successCreate;
} catch(PDOException $e) {
    echo $e->getMessage();
    return false;
}
}

/**
 * Suppression d'un utilisateur
 * @param $login Login de l'utilisateur à supprimer
 * 
 * @return $successDelete succès : true , erreur : false
 */
function deleteAdmin($login){
    try{
        $sqlDelete = "DELETE 
                    FROM utilisateurs
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

