<?php
require_once('..\Modele\vanne.classe.php');
$vanne = new Vanne();
// Récupération des données
session_start();
$data = "";
$nomCircuit = "";
$nomVanne = "";
$dataVanne = $vanne->getDataVanne($_GET["idVanne"]);
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
// var_dump($dataVanne);
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
                <h1><?php echo $nomVanne." du ".$nomCircuit ?>:</h1>
            </div>
          </section>
        </header>
        <div>
            <canvas id="graphiqueEau" width="300" height="100"></canvas>
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
                text: 'Consomation d\'eau sur les 7 dernier jours'
                },
                scales:     {
                xAxes: [{
                    type:       "time",
                    time:       {
                        format: timeFormat,
                        tooltipFormat: 'll'
                    },
                    scaleLabel: {
                        display:     true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display:     true,
                        labelString: 'value'
                    }
                }]
            }
            }
            };
            var ctx = document.getElementById("graphiqueEau").getContext("2d");
            window.myLine = new Chart(ctx, config);
    </script>
</html>