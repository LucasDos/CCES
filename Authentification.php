<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./assets/css/authentificationStyle.css">
	<link rel="stylesheet" href="./assets/css/main.css">
	<link rel="stylesheet" href="./assets/css/sticky-footer.css">
	<link rel="stylesheet" href="./assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./assets/js/plugin.date.eu.js"></script>
	<script type="text/javascript" src="./assets/js/tooltip.js"></script>
	<script type="text/javascript" src="./assets/js/scrollspy.js"></script>

	<script>
		window.console = window.console || function(t) {};
	</script>

	<script>
		if (document.location.search.match(/type=embed/gi)) {
			window.parent.postMessage("resize", "*");
		}
	</script>

</head>

<body>
	<title>Authentification</title>

	<div id="banniere">
		<a href="https://www.univ-tours.fr/" target="_blank"><img src="http://cces.univ-tours.fr/res/pics/utfr_logo.svg" alt="Logo de l'université François Rabelais" height="83" width="118" />
			<span style="margin-left: 1.2em;">CCES : Catalogue de Cours pour Etudiants d’Echanges</span></a>
	</div>
	<nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0em;">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li> <a href="Accueil.php"><span class="glyphicon glyphicon-home"></span></a> </li>

				<div class="navbar-collapse collapse">
				</div>

		</div>
	</nav>

	<div id="container">
		<form action="Depot.php" method="POST">

			<h1>Connexion</h1>

			<label><b>Identifiant</b></label>
			<input type="text" placeholder="Entrez le nom d'utilisateur" name="username" required>

			<label><b>Mot de passe</b></label>
			<input type="password" placeholder="Entrez le mot de passe" name="password" required>

			<?php
			session_start();
			if (isset($_SESSION["authentificationFailure"]) && $_SESSION["authentificationFailure"]) {
				echo "<label style='color: red;'>Échec de l'authentification</label>";
				$_SESSION["authentificationFailure"] = false;
			} ?>

			<input class="btn btn-primary btn-lg" type="submit" value="Se connecter">

		</form>
	</div>

</html>