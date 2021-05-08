<?php
    require_once('../Modele/utilisateur.classe.php');
    $data = $_POST;
    $user= new Utilisateur();
    session_start();
    switch($_POST['event']){
      case 'log':  
        if (empty($_POST['login']) || empty($_POST['mdp'])){
            echo json_encode(array("Check"=>"false", "Text"=>"Données vide!"));
        }
        $connectionOrNot = $user->dataConstruct($_POST['login'],$_POST['mdp']);
        if(!$connectionOrNot){
            echo json_encode(array("Check"=>"false", "Text"=>"Erreur mot de passe ou login!"));
        } else{
            $id = $user->getId($_POST['login']);
            $_SESSION['idUser'] = $id['id'];
            echo json_encode(array("Check"=>"true"));
        }
        break;
      case 'create' :
        if (empty($_POST['login']) || empty($_POST['mdp'])){
            echo json_encode(array("Check"=>"false", "Text"=>"Données vide!"));
        }
        $createOrNot = $user->createAdmin($_POST['login'],$_POST['mdp']);
        if(!$createOrNot){
            echo json_encode(array("Check"=>"false", "Text"=>"Erreur : échec création"));
        } else{
            $id = $user->getId($_POST['login']);
            $_SESSION['idUser'] = $id['id'];
            echo json_encode(array("Check"=>"true"));
        }
        break;
        case 'delete':  
            if (empty($_POST['login'])){
                echo json_encode(array("Check"=>"false", "Text"=>"Données vide!"));
            }
            $deleteOrNot = $user->deleteAdmin($_POST['login']);
            if(!$deleteOrNot){
                echo json_encode(array("Check"=>"false", "Text"=>"Erreur de suppression de l'administrateur!"));
            } else{
                echo json_encode(array("Check"=>"true"));
            }
        break;
    }
?>