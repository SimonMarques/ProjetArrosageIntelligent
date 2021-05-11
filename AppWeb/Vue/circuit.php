<?php
require_once('../Modele/circuit.classe.php');
$circuit = new Circuit();
// Récupération des données
session_start();
$nomCircuit = $circuit->getNom($_GET["idCircuit"]);
$dataVannes = $circuit->getVannes($_GET["idCircuit"]);
$nbVannes = count($dataVannes);
$htmlVannes = '';
if($dataVannes != 0){
    for($i=0; $i<=$nbVannes-1; $i++){
    $htmlVannes .=' <div class="fonctionAppli-item-Vanne">
                        <h2 class="h2Vanne">'.$dataVannes[$i]["nom"].'</h2>
                        <img src="../Assets/valve.png" alt="" id="imageVanne">
                        <button id="btnVisualiserVanne" onclick="getVanne('.$dataVannes[$i]["id"].')">Visualiser</button>
                    </div>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <title><?php echo $nomCircuit[0]["nom"]; ?></title>
        <link rel="icon" href="../Assets/Logo.jpg" />
        <script src="../Script/circuit.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
        <link href="../Style/style.css" rel="stylesheet" type="text/css">
        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
        </style>
    </head>
    <body >
        <header class="headerAccueilCircuit"> 
            <nav class="headerAccueilUtilisateur">
                <img id="logo" src="../Assets/logo.png" alt="logo"/>
                <div class="titleSite" onclick="window.location.href = 'accueilConnect.php'"><a>SmartArro</a></div>
                <button class="primary-button" onclick="window.location.href = 'accueilConnect.php'">Retour</button>
            </nav>
        <HR class="hrCircuit">
        </header>

        <main>
            <h1><a class="titreVanne">Visualisation de votre circuit <?php echo $nomCircuit[0]["nom"]; ?> </a></h1>
            <h2 class="titre2Vanne">Veuillez sélectionner une vanne afin de le visualiser sa consommation</h2>
            <img src="../Assets/CircuitPetit.png" alt="" id="imageCircuitsPetit">
            <section class="sectionVanne">
                <?php echo $htmlVannes ?>
            </section>
        </main>
</html>
