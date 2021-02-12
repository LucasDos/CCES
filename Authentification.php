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

<?php
    if(isset($_SESSION['type']) && $_SESSION['type'] == 'ADM') {
        session_unset();
        session_destroy();
    }
?>

<body>
	<title>Authentification</title>

    <!--Nav Menu: top-->
    <?php require_once("utils/header.php") ?>

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
                }
                $_SESSION['type'] = "ADM";
			?>

			<input class="btn btn-primary btn-lg" type="submit" value="Se connecter">

		</form>
	</div>

</html>