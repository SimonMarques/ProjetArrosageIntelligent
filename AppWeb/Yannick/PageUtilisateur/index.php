<!DOCTYPE html>
<html>
<!-- Onglet -->
    <head>
        <title>Arrosage</title>
        <link href="style/style.css" rel="stylesheet" type="text/css">
        <link rel="icon" href="favicon.ico" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>

    <body onload="onload()">

        <header> 
            <nav>
                <img id="logo" src="assets/logo.png" alt="logo"/>
                <div class="titleSite"><a>SmartArro</a></div>
                <button class="primary-button" onclick="window.location.href = '../login/index.php'">Deconnexion</button>
            </nav>
        </header>

        <div id="fonction-meteo">
            <a class="weatherwidget-io" href="https://forecast7.com/fr/44d352d58/rodez/" data-label_1="RODEZ" data-theme="original" >RODEZ</a>
            <script>
                !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
            </script>
        </div>
        
        <div id="fonctionAppli-wrapper">
            <intput class="fonctionAppli-item" onclick="window.location.href = '../login/index.php'">      
                <img src="assets/ConsomationEau.png" />
                <h3 class="fonctionAppli-name">Consommation d'eau</h3><br>
                <p class="fonctionAppli-description">Consultez votre consomation</p>
            </intput>

            <intput class="fonctionAppli-item" onclick="window.location.href = '../login/index.php'">      
                <img src="assets/Circuit.png" />
                <h3 class="fonctionAppli-name">Circuit</h3><br>
                <p class="fonctionAppli-description">Mettez en place votre circuit</p>
            </intput>  

            <intput class="fonctionAppli-item" onclick="window.location.href='https://forecast7.com/fr/44d352d58/rodez/'">      
                <img src="assets/meteo.png" />
                <h3 class="fonctionAppli-name">Meteo</h3><br>
                <p class="fonctionAppli-description">Visualisez la meteo</p>
            </intput>  

            <intput class="fonctionAppli-item" onclick="window.location.href = '../login/index.php'">      
                <img src="assets/Parametre.png" />
                <h3 class="fonctionAppli-name">Parametre</h3><br>
                <p class="fonctionAppli-description">Parametrez votre circuit</p>
            </intput>  
        </div>
    </body>
</html>

<!-- Autre facon de mettre la meteo 
<iframe id="widget_autocomplete_preview"  width="100%" height="350" frameborder="0" src="https://meteofrance.com/widget/prevision/122020##2196F3BF"></iframe>
 -->