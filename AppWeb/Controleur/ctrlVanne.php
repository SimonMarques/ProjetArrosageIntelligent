<?php
    require_once('..\Modele\vanne.classe.php');
    $data = $_POST;
    $vanne= new Vanne();
    session_start();
    switch($_POST['event']){
        case 'changeStatut' :
        $result = $vanne->changeStatut($_POST['idVanne'], $_POST['statut']);
        if($result){
            echo json_encode(array("Check"=>"true"));
        } else {
            echo json_encode(array("Check"=>"false", "Text"=>"Erreur lors du changement de statut de la vanne !"));
        }
        break;
        case 'programmeDate' :
        $result = $vanne->programmeDate($_POST['idVanne'],$_POST['date'],$_POST['heureD'],$_POST['heureF']);
        if($result){
            echo json_encode(array("Check"=>"true"));
        } else {
            echo json_encode(array("Check"=>"false", "Text"=>"Erreur lors de la programmation d'arrosage!"));
        }
        break;
    }
?>