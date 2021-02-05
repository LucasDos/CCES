<?php
session_start();

$passwords = array();
if ($handle = fopen("functions/Passwords.csv", "r"))
	while ($data = fgetcsv($handle))
		array_push($passwords, array($data[0], $data[1]));

foreach ($passwords as $password)
	if (isset($_POST["username"]) && isset($_POST["password"]) && (!password_verify($_POST["username"], $password[0]) || !password_verify($_POST["password"], $password[1])))
		$_SESSION["authentificationFailure"] = true;
	else if (isset($_POST["username"]) && isset($_POST["password"]) && password_verify($_POST["username"], $password[0]) && password_verify($_POST["password"], $password[1])) {
		$_SESSION["authentificationSuccess"] = true;
		$_SESSION["authentificationFailure"] = false;
		break;
	}

if (!isset($_SESSION["authentificationSuccess"]) || isset($_SESSION["authentificationSuccess"]) && !$_SESSION["authentificationSuccess"])
	header("Location: Authentification.php");

$_SESSION["depositPage"] = true;

array_map("unlink", glob("functions/uploads/Excel/*"));
array_map("unlink", glob("functions/uploads/CSV/*"));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" href="./assets/css/drag-drop.css">
	<title>Depot</title>
</head>

<body>
	<!-- Nav Menu: top -->
    <?php require_once("utils/header.php") ?>

	<div style="float: right;">
		<p></p>
		<a class="btn btn-primary btn-lg" role="button" onclick="clearFiles()">Supprimer tous les fichiers<span class="glyphicon"></span></a> 
	</div>

	<div id="drop_file_zone" ondragover="return false">
		<div id="drag_upload_file">
			<p>Glisser les fichiers Excels ici</p>
			<p>ou</p>
			<p><input type="button" value="Sélectionner les Excels depuis le PC" onclick="file_explorer();"></p>
			<input type="file" id="selectfile" multiple>
		</div>
	</div>

	<div class="table-wrapper-scroll-y my-custom-scrollbar" id="importedFiles"></div>

	<script>
		var drop_file_zone;
		drop_file_zone = document.getElementById("drop_file_zone");
		drop_file_zone.ondragenter = function() {
			this.style.borderColor = ' #afeafc';
			this.style.backgroundColor = ' #afeafc';
			this.style.opacity = 0.7;
		}
		drop_file_zone.ondragleave = function() {

			this.style.borderColor = 'black';
			this.style.backgroundColor = 'white';
			this.style.opacity = 1;

		}
		drop_file_zone.ondrop = function() {
			upload_file(event);
			this.style.borderColor = 'black';
			this.style.backgroundColor = 'white';
			this.style.opacity = 1;
			document.getElementById("importedFiles").innerHTML = " <div class='spinner-border text-primary' role='status'><span class='visually-hidden'>Chargement...</span></div>"
		}
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="./assets/js/admin.js"></script>
</body>

</html>