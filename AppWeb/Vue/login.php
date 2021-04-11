<!DOCTYPE html>
<html>
    <head>
        <title>Utilisateur</title>
        <link href="../Style/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="../Script/connect.js"></script>
    </head>
    <body>
        <header id="headerAdmin"> 
        </header>
        <main class="login-main">
            <section id="login-section">
                <div class ="loginBox">
                    <div class ="login-title">Utilisateur</div>
                    <div>
                        <label>Nom d'utilisateur</label>
                        <input id="login" value="">
                    </div>
                    <div>
                        <label>Mot de passe</label>
                        <input type="password" id="password" value="">
                    </div>
                    <div>
                        <button id="login" onclick="connection()" class="button-login">Log In</button>
                    </div>
                    <div>
                        <p>
                            Devenir membre ? <a href="createUtilisateur.php">Sign in</a>
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