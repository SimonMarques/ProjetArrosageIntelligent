<!DOCTYPE html>
<html>
  <head>
      <title>Arrosage</title>
      <link href="./Style/style.css" rel="stylesheet" type="text/css">
      <link rel="icon" href="./Assets/logo.png" />
  </head>

  <body>  
    <header class="headerIndexAccueil"> 
      <nav class="navIndexAccueil">
        <img id="logo" src="./Assets/Logo.jpg" alt="logo"/>
        <div class="titleSite"><a href="index.php">SmartArro</a></div>
        <button class="primary-button" onclick="window.location.href = './Vue/login.php'"><img id="moncompte" src="./Assets/MonCompte .JPG" alt="logo"/>      Mon compte</button>
      </nav>
        <section id="landing-section">
          <div id="main-text-wrapper">
            <h1>
              Bienvenue chez SmartArro
            </h1>
          </div>
        </section>
    </header>
        
        <main class="mainPage1">
          <section id="products-section">
            
            <div id="product" class="product-item">
              <img src="./Assets/EconomieEau.jpg" alt="Economie d'eau"/>
              <h3> Economie d'eau</h3>
              <p class="product-description">
                Avec le systeme d'arrosage goutte-a-goutte, 
                vous fournissez a chaque plante la juste quantite 
                d'eau necessaire et de facon ciblee au niveau des racines. 
                Cette methode de distribution precise de l'eau permet d'economiser l'eau goutte apres goutte.
              </p>
            </div>

            <div id="product" class="product-item">
              <img src="./Assets/SantePlante.jpg" alt="Economie d'eau"/>
              <h3> Sante des plantes </h3>
              <p class="product-description">
                 Un jardin bien arrose c'est l'assurance de recolter des concombres croquants, des fraises sucrees, 
                 de voir pousser vos plantes vertes et d'avoir de belles floraisons. 
                 Vos plantes seront en bonne sante et les recoltes abondantes !
              </p>
            </div>

            <div id="product" class="product-item">
              <img src="./Assets/GainTemps.jpg" alt="Economie d'eau"/>
              <h3> Gain de temps </h3>
              <p class="product-description">
                Un systeme d'arrosage automatique permet de toujours offrir une quantite d'eau optimale a vos plantes. 
                Une fois installe et programme, vous n'aurez plus à vous soucier de l'arrosage de vos plantes, 
                vous laissant ainsi profiter pleinement de votre temps libre.
              </p>
            </div>
          </section>

        <section class="fonctionAppli-section-Accueil">
          <h3>Creer vous un compte et laissez-vous guider</h3>
          <p id="fonctionAppli-desc">Voici toutes les fonctionnalites que l'on propose</p>

          <div class="fonctionAppli-wrapper-Accueil">
              <div class="fonctionAppli-item-Accueil">
                  <img src="./Assets/ConsomationEau.png" />
                  <h3 class="fonctionAppli-name-Accueil">Consommation d'eau</h3><br>
                  <p class="fonctionAppli-description">Permet de voir la consommation effectue dans les dernier jours grace a des graphiques</p>
              </div>
              
              <div class="fonctionAppli-item-Accueil">
                  <img src="./Assets/Circuit.png" />
                  <h3 class="fonctionAppli-name-Accueil">Circuit</h3><br>
                  <p class="fonctionAppli-description">Une partie pour faire son circuit personnalise de son jardin</p>
              </div>

              <div class="fonctionAppli-item-Accueil">
                <img src="./Assets/meteo.png" />
                <h3 class="fonctionAppli-name-Accueil">Meteo</h3><br>
                <p class="fonctionAppli-description">Possibilite de visualiser la meteo de la journee et des journees a venir pour permettre un programmation 
                  optimal de son jardin</p>
              </div>

              <div class="fonctionAppli-item-Accueil">
                  <img src="./Assets/Parametre.png" />
                  <h3 class="fonctionAppli-name-Accueil">Parametre</h3><br>
                  <p class="fonctionAppli-description">Tout ceci est parametrable dans cette derniere partie</p>
              </div>
          </div>
        </section>
      </main>
    </body>
    <script>
      function changeHeader(){
        document.getElementByTagName('header').style.background-image = "url('./Assets/tablette.jpg')";
      }
    </script>
</html>