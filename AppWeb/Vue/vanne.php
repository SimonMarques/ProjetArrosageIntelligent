<?php
require_once('../Modele/vanne.classe.php');
$vanne = new Vanne();
// Récupération des données
session_start();
$data = "";
$nomCircuit = "";
$nomVanne = "";
$cssStatut ="background-color : red;font-style : Copperplate;";
$txtStatut ="OFF";
$idVanne = $_GET["idVanne"];
$dataVanne = $vanne->getDataVanne($_GET["idVanne"]);
$statutVanne = $dataVanne[0]["statut"];
if($dataVanne != 0){
    $nomVanne = $dataVanne[0]["nom"];
    $nomCircuit = $dataVanne[0]["nomCircuit"];
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
if($statutVanne == 0){
    $cssStatut ="background-color : green;font-style : Copperplate;";
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
        <title><?php echo $nomCircuit ?></title>
        <link rel="icon" href="../Assets/Logo.jpg" />
        <script src="../Script/vanne.js"></script>
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
            <div>
                <h1><?php echo $nomVanne." du ".$nomCircuit ?>: </h1>
            </div>
          </section>
        </header>
        <div>
            <canvas id="graphiqueEau" width="300" height="100"></canvas>
        </div> 
        <button onclick="changeStatutVanne(<?php  echo $idVanne.','.$statutVanne; ?>)">Changer le statut</button>
        <div id="statut" style="<?php echo $cssStatut;?>">
            <?php echo $txtStatut; ?>
        </div> 
        <form id="parameterVanne">
            <div id="progSemaine">
                Programmation Eau :
            </div> 
            <div>
                <label for="start">Date :</label>
                <input type="date" id="date" name="trip-start">
            </div> 
            <div>
                <label for="appt">Heure de début :</label>

                <input type="time" id="heureD" name="appt">
            </div> 
            <div>
                <label for="appt">Heure de fin :</label>

                <input type="time" id="heureF" name="appt">
            </div> 
        </form>  
        <button onclick="programmeDateVanne(<?php  echo $idVanne; ?>)">Programmer date</button>
        <div>
        <table style="border : 1px solid;border-collapse: separate; text-align : center; ">
            <caption>Dates programmées :</caption>
            <tr>
                <th>Jour</th>
                <th>Heure de début </th>
                <th>Heure de fin</th>
                <th>Suppression</th>
            </tr>
            <?php echo $htmlProgHoraires; ?>
            </table>
        </div> 
    </body>
    <script>
        var timeFormat = 'DD/MM/YYYY';
        var config = {
            type: 'line',
            data: {
                datasets: [{ 
                    label: "Courbe:",
                    data: [<?php echo $data ?>],
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
                    time:       {
                        format: timeFormat,
                        tooltipFormat: 'D MMM YYYY',
                        displayFormats: {
                            quarter: 'D MMM YYYY'
                        }
                    },
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