<!DOCTYPE html>
<html>
	<!-- Onglet -->
	<head>
		<title>Arrosage</title>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="../Style/style.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="../Assets/Logo.jpg" />
		<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
		<script src="https://kit.fontawesome.com/a076d05399.js"> </script>
  		<script src="../Script/connect.js" defer></script>
	</head>

	<body>
	<header>
	<input type="image" class="imageLogo" alt="Login"src="../Assets/Logo.jpg">	
	</header>
		<div class="miseEnPage">
			<div class="wave">
				<img class="imageGrande" src="../Assets/FondAccueil.JPG">
			</div>

			<div class="container">

				<div class="logo">
					<i class="fas fa-user"></i>
				</div>

				<div class="tab-body" data-id="connexion">
					<form>
						<div class="row">
							<i class="far fa-user"></i>
							<input type="email" class="input" placeholder="Adresse Mail" id="login">
						</div>
						<div class="row">
							<i class="fas fa-lock"></i>
							<input placeholder="Mot de Passe" type="password" class="input" id="password">
						</div>
						<a href="#" class="link">Mot de passe oublié ?</a>
						<button class="btn" type="button" onclick="connection()">Connexion</button>
					</form>
				</div>

				<div class="tab-body" data-id="inscription">
					<form>
						<div class="row">
							<i class="far fa-user"></i>
							<input type="email" class="input" placeholder="Adresse Mail" id="loginCreate">
						</div>
						<div class="row">
							<i class="fas fa-lock"></i>
							<input type="password" class="input" placeholder="Mot de Passe" id="passwordCreate">
						</div>
						<div class="row">
							<i class="fas fa-lock"></i>
							<input type="password" class="input" placeholder="Confirmer Mot de Passe" id="passwordConfirmCreate">
						</div>
						<button class="btn" type="button" onclick="create()">Inscription</button>
					</form>
				</div>

				<div class="tab-footer">
					<a class="tab-link active" data-ref="connexion" href="javascript:void(0)">Connexion</a>
					<a class="tab-link" data-ref="inscription" href="javascript:void(0)">Inscription</a>
				</div>
			</div>
		</div>
	</body>
</html>