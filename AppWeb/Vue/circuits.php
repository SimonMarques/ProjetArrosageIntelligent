<?php
require_once('..\Modele\circuit.classe.php');
$circuit = new Circuit();
session_start();
$circuits = $circuit->getCircuit($_SESSION["idUser"]);
$nbCircuits = count($circuits)-1;
$htmlCircuits = '';
for($i=0; $i<=$nbCircuits; $i++){
    $htmlCircuits .='<div>
                        <h3>'.$circuits[$i]["nom"].'</h3>
                        <img src="..\Assets\Circuit.png" alt="" style="width: 5%;">
                        <button onclick="getCircuit('.$circuits[$i]["id"].')">Visualiser</button>
                     </div>';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Circuit</title>
        <link rel="icon" href="../Assets/Logo.jpg" />
        <script src="../Script/circuit.js"></script>
    </head>
    <body >
        <header> 
          <section>
            <div >
                <h1>CIRCUITS :</h1>
            </div>
          </section>
        </header>
        <main>
            <section>
                <h3>Les circuits de l'utilisateurs</h3>
                <div>
                <?php
                echo $htmlCircuits;
                ?>
                </div>
            </section>
        </main>        
    </body>
</html>