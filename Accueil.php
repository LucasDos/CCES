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
</head>

<body>
	<?php
	require_once('./functions/import.php');

	$datas = array();
	if ($handle = fopen("functions/VisitsFunctionTime.csv", 'r')) {
		while ($data = fgetcsv($handle))
			array_push($datas, $data);
		fclose($handle);
	}

	$datas[date('m') - 1][1]++;

	$fp = fopen("functions/VisitsFunctionTime.csv", 'w');
	foreach ($datas as $data)
		fputcsv($fp, $data);
	fclose($fp);

	if (isset($_SESSION['language'])) {
		$language = $_SESSION['language'];
	}

	if ($language == "FR") { ?>
		<title>Accueil</title>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->

		<!-- Nav Menu: top -->
        <?php require_once('utils/header.php') ?>

		<div class="accueil other-color fr">
			<?php include("./functions/uploads/HTML/AccueilContentFR.html"); ?>
			<p><a href="./Cours.php" class="btn btn-primary btn-lg" role="button">Commencer<span class="glyphicon glyphicon-chevron-right"></span></a></p>
		</div>

		<div class="container">
			<div id="scroll-able" class="col-md-9" height="800px">
			</div>
			<div class="col-xs-8 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
			</div>
		</div>

		<div class="container">
			<hr>
			<footer>
			</footer>
		</div>

	<?php } else { ?>
		<title>Home</title>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

		<!--Nav Menu: top-->
        <?php require_once('utils/header.php') ?>

		<div class="accueil other-color en">
			<?php include("./functions/uploads/HTML/AccueilContentEN.html"); ?>
			<p><a href="./cours.php" class="btn btn-primary btn-lg" role="button">Start<span class="glyphicon glyphicon-chevron-right"></span></a></p>
		</div>
		<div class="container">
			<div id="scroll-able" class="col-md-9" height="800px">
			</div>
			<div class="col-xs-8 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
			</div>
		</div>

		<div class="container">
			<hr>
			<footer>
			</footer>
		</div>
	<?php } ?>
</body>

</html>
