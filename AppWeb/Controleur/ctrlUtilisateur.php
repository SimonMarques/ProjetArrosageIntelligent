<?php
    require_once('..\Modele\utilisateur.classe.php');
    $data = $_POST;
    $admin = new Utilisateur();
    session_start();
    switch($_POST['event']){
      case 'log':  
        if (empty($_POST['login']) || empty($_POST['mdp'])){
            echo json_encode(array("Check"=>"false", "Text"=>"Données vide!"));
        }
        $connectionOrNot = $admin->dataConstruct($_POST['login'],$_POST['mdp']);
        if(!$connectionOrNot){
            echo json_encode(array("Check"=>"false", "Text"=>"Erreur mot de passe ou login!"));
        } else{
            $_SESSION['login'] = $_POST['login']; 
            echo json_encode(array("Check"=>"true"));
        }
        break;
      case 'create' :
        if (empty($_POST['login']) || empty($_POST['mdp'])){
            echo json_encode(array("Check"=>"false", "Text"=>"Données vide!"));
        }
        $createOrNot = $admin->createAdmin($_POST['login'],$_POST['mdp']);
        if(!$createOrNot){
            echo json_encode(array("Check"=>"false", "Text"=>"Erreur : échec création"));
        } else{
            $_SESSION['login'] = $_POST['login']; 
            echo json_encode(array("Check"=>"true"));
        }
        break;
        case 'delete':  
            if (empty($_POST['login'])){
                echo json_encode(array("Check"=>"false", "Text"=>"Données vide!"));
            }
            $deleteOrNot = $admin->deleteAdmin($_POST['login']);
            if(!$deleteOrNot){
                echo json_encode(array("Check"=>"false", "Text"=>"Erreur de suppression de l'administrateur!"));
            } else{
                echo json_encode(array("Check"=>"true"));
            }
        break;
    }
?>