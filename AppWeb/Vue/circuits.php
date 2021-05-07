<?php
require_once('..\Modele\circuit.classe.php');
$circuit = new Circuit();
session_start();
$circuits = $circuit->getCircuit($_SESSION["idUser"]);
$nbCircuits = count($circuits)-1;
$htmlCircuits = '';
for($i=0; $i<=$nbCircuits; $i++){
    $htmlCircuits .='<div>
                        <h2 class="h2Circuits">'.$circuits[$i]["nom"].'</h2>
                        <div class="divCircuits">
                            <img src="..\Assets\Circuit.png" alt="" id="imageCircuits">
                            <button id="btnVisualiser" onclick="getCircuit('.$circuits[$i]["id"].')">Visualiser</button>
                        </div>
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
            <nav class="headerAccueilUtilisateur">
                <img id="logo" src="../Assets/logo.png" alt="logo"/>
                <div class="titleSite"><a>SmartArro</a></div>
                <button class="primary-button" onclick="window.location.href = 'accueilConnect.php'">Retour</button>
            </nav>
            <HR class="hrCircuit">
        </header>

        <main>
            <h1>Les circuits de l'utilisateurs</h1>
            <section class="sectionCircuits">
                <?php
                echo $htmlCircuits;
                ?>
            </section>
        </main>        
    </body>
</html>