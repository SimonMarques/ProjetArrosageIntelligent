<?php
    require_once('../Modele/circuit.classe.php');
    $data = $_POST;
    $circuit= new Circuit();
    session_start();
    switch($_POST['event']){
        case 'initCircuit' :
        break;
    }
?>