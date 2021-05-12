<?php
require_once('../Modele/vanne.classe.php');
$vanne = new Vanne();
// Récupération des données
session_start();
$data = "";
$nomCircuit = "";
$nomVanne = "";
$cssStatut ="background-color : red;
font-style : Copperplate;
width: 80px;
height: 30px;
border-top-right-radius: 10px;
border-top-left-radius: 10px;
border-bottom-left-radius: 10px;
border-bottom-right-radius: 10px;";
$txtStatut ="OFF";
$idVanneCurrent = $_GET["idVanne"];
$dataVanne = $vanne->getDataVanne($_GET["idVanne"]);
$statutVanne = $dataVanne[0]["statut"];
if($dataVanne != 0){
    $nomVanne = $dataVanne[0]["nom"];
    $nomCircuit = $dataVanne[0]["nomCircuit"];
    $idCircuit = $dataVanne[0]["idCircuit"];
    for($i=0; $i<=count($dataVanne)-1; $i++){
        $date = new DateTime($dataVanne[$i]["date"]);
        $dataVanne[$i]["date"] = $date->format('d/m/Y');
        if($i==0){
            $data .="{ x :\"".$dataVanne[$i]["date"]."\", y :".$dataVanne[$i]["debitEau"]."}";
        } else {
            $data .=",{ x :\"".$dataVanne[$i]["date"]."\", y :".$dataVanne[$i]["debitEau"]."}";
        }
    }
} 

// Gestion de l'affichage des statuts
if($statutVanne == 1){
    $cssStatut = "background-color : green;
    font-style : Copperplate;
    width: 80px;
    height: 30px;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;";
    $txtStatut ="ON";
}

//Programmation horaire par jour pour la vanne sélectionner
$dataProg = $vanne->gestionDateProg($_GET["idVanne"]);
$htmlProgHoraires = '';
if($dataProg){
   for($i=0;$i<=count($dataProg)-1;$i++){
        $htmlProgHoraires .= "<tr>
                                <td>".$dataProg[$i]->date."</td>
                                <td>".$dataProg[$i]->heureDebut."</td>
                                <td>".$dataProg[$i]->heureFin."</td>
                                <td><button style=\"background-color : red;\" onclick=\"deleteDateVanne(".$dataProg[$i]->idVanne.",'".$dataProg[$i]->date."')\">Suppression</button></td>
                             </tr>";
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
        <title><?php echo $nomVanne ?></title>
        <link rel="icon" href="../Assets/Logo.jpg" />
        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
        <link href="../Style/style.css" rel="stylesheet" type="text/css">
        <script src="../Script/vanne.js"></script>
        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
        </style>
    </head>
    <body> 
        <header class="headerAccueilCircuit"> 
            <nav class="headerAccueilUtilisateur">
                <img id="logo" src="../Assets/logo.png" alt="logo"/>
                <div class="titleSite"onclick="window.location.href = 'accueilConnect.php'"><a>SmartArro</a></div>
                <button class="primary-button" onclick="window.location.href = 'circuit.php?idCircuit=<?php echo $idCircuit; ?>'">Retour</button>
            </nav>
            <HR class="hrCircuit">
        </header>

        <div>
            <h1><a class="titreVanne">Visualisation de votre <?php echo $nomVanne." du ".$nomCircuit ?> </a></h1>
        </div>

        <section class="mettreenplace">
            <div class="reglageVanne">
                <h1 class="titreVanne">Paramétrage </h2>

                <div class="reglageVanne1">
                    <div class="reglageVanneInstante">
                        <button id="btnChngerStatue" onclick="changeStatutVanne(<?php  echo $idVanneCurrent.','.$statutVanne; ?>)">Changer le statut</button>
                        <div id="statut" style="<?php echo $cssStatut;?>">
                            <?php echo $txtStatut; ?>
                        </div>
                    </div> 

                    <form class="reglageVanneProgrammer">
                        <div id="progSemaine">
                            Programmation Eau :
                        </div> 
                        <div class="ParaVanneProg">
                            <label class="texteVanneProg" for="start">Date :</label>
                            <input class="saisieVanneProg" type="date" id="date">
                        </div> 
                        <div class="ParaVanneProg">
                            <label class="texteVanneProg" for="appt">Heure de début :</label>
                            <input class="saisieVanneProg" type="time" id="heureD">
                        </div> 
                        <div class="ParaVanneProg">
                            <label class="texteVanneProg" for="appt">Heure de fin :</label>
                            <input class="saisieVanneProg" type="time" id="heureF">
                        </div> 
                        <button type="button" id="btnProgDate" onclick="programmeDateVanne(<?php  echo $idVanneCurrent; ?>)">Programmer date</button>
                    </form>  
                </div>
            </div>
            <div>
                <table>
                    <caption id="progSemaine">Dates programmées :</caption>
                    <tr>
                        <th>Jour</th>
                        <th>Heure de début </th>
                        <th>Heure de fin</th>
                        <th>Suppression</th>
                    </tr>
                    <tr><?php echo $htmlProgHoraires; ?></tr>
                </table>
            </div> 
        </section> 
        <div class="graphique">
            <h1 id="progSemaine">Consommation d'eau </h2>
            <canvas id="graphiqueEau" width="300" height="100"></canvas>
        </div> 

    </body>
    <script>
        var config = {
            type: 'line',
            data: {
                datasets: [{ 
                    label: "Courbe:",
                    data: [<?php echo $data; ?>],
                    borderColor: "#3e95cd",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                display: true,
                text: 'Consommation d\'eau sur les 14 derniers jours'
                },
                scales:     {
                xAxes: [{
                    type:       "time",
                    scaleLabel: {
                        display:     true,
                        labelString: 'Date du jour'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display:     true,
                        labelString: 'ml'
                    }
                }]
            }
            }
            };
            var ctx = document.getElementById("graphiqueEau").getContext("2d");
            window.myLine = new Chart(ctx, config);
    </script>
</html>