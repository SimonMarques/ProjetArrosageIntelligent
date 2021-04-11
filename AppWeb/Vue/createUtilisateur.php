<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <link href="../Style/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="../Script/connect.js"></script>
    </head>
    <body>
        <header id="headerAdmin"> 
        </header>
        <main class="login-main">
            <section id="login-section">
                <div class ="loginBox">
                    <div class ="login-title">S'incrire</div>
                    <div>
                        <label>Entrez votre nom d'utilisateur</label>
                        <input id="login" value="">
                    </div>
                    <div>
                        <label>Entrez votre mot de passe</label>
                        <input type="password" id="password" value="">
                    </div>
                    <div>
                        <button id="login" onclick="create()" class="button-login">Enregistrer</button>
                    </div>
                    <div>
                        <p>
                            Déjà admin ? <a href="login.php">Log in</a>
                        </p>
                    </div>  
                    </div>  
            </section>
        </main>
    </body>
    <script type="text/javascript">
        function changeHeader(){
            document.getElementById("headerAdmin").style.backgroundImage = "url()";
            document.getElementById("headerAdmin").style.opacity = "1";
            document.getElementById("headerAdmin").style.height = "77px";
            document.getElementById("headerAdmin").style.borderBottom = "solid 2px";
        }
    </script>
</html>