<?php
require_once('..\Modele\circuit.classe.php');
$circuit = new Circuit();
// Récupération des données
session_start();
$nomCircuit = $circuit->getNom($_GET["idCircuit"]);
$dataVannes = $circuit->getVannes($_GET["idCircuit"]);
$nbVannes = count($dataVannes);
$htmlVannes = '';
if($dataVannes != 0){
    for($i=0; $i<=$nbVannes-1; $i++){
    $htmlVannes .='<div>
                        <h3>'.$dataVannes[$i]["nom"].'</h3>
                        <img src="..\Assets\valve.png" alt="" style="width: 5%;">
                        <button onclick="getVanne('.$dataVannes[$i]["id"].')">Visualiser</button>
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
        <title><?php echo $nomCircuit ?></title>
        <link rel="icon" href="../Assets/Logo.jpg" />
        <script src="../Script/circuit.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
        </style>
    </head>
    <body >
        <header> 
          <section>
            <div >
                <h1><?php echo $nomCircuit[0]["nom"]; ?>:</h1>
            </div>
          </section>
        </header>
        <?php echo $htmlVannes ?>

</html>
