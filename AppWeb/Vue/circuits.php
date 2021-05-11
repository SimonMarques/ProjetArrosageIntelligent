<?php
require_once('../Modele/circuit.classe.php');
$circuit = new Circuit();
session_start();
$circuits = $circuit->getCircuit($_SESSION["idUser"]);
$nbCircuits = count($circuits)-1;
$htmlCircuits = '';
for($i=0; $i<=$nbCircuits; $i++){
    $htmlCircuits .='<div class="fonctionAppli-item-circuit">
                        <h2 class="h2Circuits">'.$circuits[$i]["nom"].'</h2>
                        <img src="..\Assets\CircuitWeb.png" alt="" id="imageCircuits">
                        <button id="btnVisualiser" onclick="getCircuit('.$circuits[$i]["id"].')">Selectionner</button>
                    </div>';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Circuit</title>
        <link href="../Style/style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="../Assets/Logo.jpg" />
        <script src="../Script/circuit.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    </head>

    <body >
        <header class="headerAccueilCircuit"> 
            <nav class="headerAccueilUtilisateur">
                <img id="logo" src="../Assets/logo.png" alt="logo"/>
                <div class="titleSite"onclick="window.location.href = 'accueilConnect.php'"><a>SmartArro</a></div>
                <button class="primary-button" onclick="window.location.href = 'accueilConnect.php'">Retour</button>
            </nav>
            <HR class="hrCircuit">
        </header>

        <main>
            <h1><a class="titreCircuit">Visualisation de votre circuit</a></h1>
            <h2 class="titre2Circuit">Veuillez sélectionner un circuit afin de le visualiser</h2>
            <img src="..\Assets\CircuitPetit.png" alt="" id="imageCircuitsPetit">

            <section class="sectionCircuits">
                <?php
                echo $htmlCircuits;
                ?>
            </section>
        </main>        
    </body>
</html>