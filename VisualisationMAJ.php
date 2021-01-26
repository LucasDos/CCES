<?php
require_once('./functions/import.php');
returnPage('VisualisationMAJ.php');
if (!isset($_SESSION["authentificationSuccess"]) || isset($_SESSION["authentificationSuccess"]) && !$_SESSION["authentificationSuccess"])
	header("Location: Authentification.php");

if (!file_exists("functions/uploads/MergedFile.csv"))
	header("Location: Depot.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./assets/css/visualisationMAJ.css">
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
	<script type="text/javascript" src="./assets/js/admin.js"></script>

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
// Load PhpSpreadsheet library.
require_once('functions/vendor/autoload.php');

// Import classes.
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

?>
<script>
	function goCoursPage() {
		window.open('./Cours.php');
	}
</script>

<body>
	<title>VisualisationMise A Jour</title>

	<?php
	if (isset($_SESSION['language'])) {
		$language = $_SESSION['language'];
	}
	if ($language == "FR") { ?>
		<div id="banniere">
			<a href="https://www.univ-tours.fr/" target="_blank"><img src="http://cces.univ-tours.fr/res/pics/utfr_logo.svg" alt="Logo de l'université François Rabelais" height="83" width="118" />
				<span style="margin-left: 1.2em">CCES : Catalogue de Cours pour Etudiants d’Echanges</span></a>
		</div>
		<!--Nav Menu: top-->
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
					<li> <a href="Depot.php"><span class="glyphicon glyphicon-home"></span> Depot</a> </li>
					<li>
						<a href="Cours.php">
							<span class="glyphicon glyphicon-search"></span> Cours
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Langue <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="?language=FR">Français</a></li>
							<li><a href="?language=EN">Anglais</a></li>
						</ul>
					</li>
				</ul>
				<div class="form-group navbar-right navbar-form">
					<button type="submit" onclick="goCoursPage()" class="btn btn-info" target="_blank">Vue étudiante actuelle</button>
				</div>
			</div>
		</nav>

		<div class="valider">
			<p><a href="./Cours.php" class="btn btn-primary btn-lg" role="button" onclick="moveMergedFile()">Valider<span class="glyphicon glyphicon-chevron-right"></span></a></p>
		</div>

		<table id="demo">
			<thead>
				<tr>
					<?php

					if (file_exists("./functions/uploads/MergedFile.csv"));

					$fileName = "./functions/uploads/MergedFile.csv";

					if ($file = file_get_contents($fileName)) {
						$file = str_replace('";"', "';'", $file);
						file_put_contents($fileName, $file);
					}

					if ($handle = fopen($fileName, "r")) {
						$data = fgetcsv($handle);
						$line = explode("';'", $data[0]);

						echo "<th>" . $line[6] . "</th>";
						echo "<th>" . $line[8] . "</th>";
						echo "<th>" . $line[22] . "</th>";
						echo "<th>" . $line[1] . "</th>";
						echo "<th>" . $line[10] . "</th>";
						echo "<th>" . $line[7] . "</th>";
						echo "<th>" . $line[23] . "</th>";
					?>
						<th>Plus d' informations</th>
				</tr>
			</thead>
			<tbody>
			<?php
						$rowCount = 0;
						$i = 0;
						while ($data = fgetcsv($handle)) {
							echo "<tr>";
							$line = explode("';'", $data[0]);

							if ($line[17] == "")
								$line[17] = 0;

							$emptyElements = 0;
							foreach ($line as $value)
								if (empty($value))
									$emptyElements++;
							if ($emptyElements != count($line))
								$rowCount  = $rowCount + 1;
							echo "<td>" . $line[6] . "</td>";
							echo "<td>" . $line[8] . "</td>";
							echo "<td>" . $line[22] . "</td>";
							echo "<td>" . $line[1] . "</td>";
							echo "<td>" . $line[10] . "</td>";
							echo "<td>" . $line[7] . "</td>";
							echo "<td>" . $line[23] . "</td>";

							echo "<form id='allInformation$i' action='CoursInfo.php' method='POST'>";
							for ($j = 0; $j < count($line); $j++)
								echo "<input type='hidden' name='information$j' value='$line[$j]' />";
							$j++;
							echo "<input type='hidden' name='numberInformation' value='$j' />";
							echo "</form>";
							echo "<td>" . "<a href='#' onclick='document.getElementById(\"allInformation$i\").submit()'>" . "<img src='assets/images/afficher.png'/>" . "</a>" . "</td>";

							echo "</tr>";

							$i++;
						}
						echo "<em><p>Nombre de cours disponibles : " . $rowCount . "</p></em>";
						fclose($handle);
					}

			?>
			</tbody>
		</table>

		<div class="valider">
			<p><a href="./Cours.php" class="btn btn-primary btn-lg" role="button" onclick="moveMergedFile()">Valider<span class="glyphicon glyphicon-chevron-right"></span></a></p>
		</div>


		<script src=' assets/tablefilter/tablefilter.js'> </script>
		<script id="rendered-js">
			var filtersConfig = {
				// instruct TableFilter location to import ressources from
				base_path: 'assets/tablefilter/',

				col_2: 'select',
				col_3: 'select',
				col_4: 'select',
				col_6: 'select',
				col_7: 'none',
				help_instructions: false,
				clear_filter_text: 'Vide',
				auto_filter: {},
				alternate_rows: true,
				btn_reset: true,
				loader: true,
				mark_active_columns: true,
				highlight_keywords: true,
				no_results_message: true,
				extensions: [{
					name: 'sort'
				}]
			};

			var tf = new TableFilter('demo', filtersConfig);
			tf.init();
		</script>

</html>
<?php } else { ?>
	<div id="banniere">
		<a href="https://www.univ-tours.fr/" target="_blank"><img src="http://cces.univ-tours.fr/res/pics/utfr_logo.svg" alt="Logo de l'université François Rabelais" height="83" width="118" />
			<span style="margin-left: 1.2em">CCES : Catalogue de Cours pour Etudiants d’Echanges</span></a>
	</div>
	<!--Nav Menu: top-->
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
				<li> <a href="Depot.php"><span class="glyphicon glyphicon-home"></span> Depot</a> </li>
				<li>
					<a href="Cours.php">
						<span class="glyphicon glyphicon-search"></span> Cours
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Langue <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="?language=FR">Français</a></li>
						<li><a href="?language=EN">Anglais</a></li>
					</ul>
				</li>
			</ul>
			<div class="form-group navbar-right navbar-form">
				<button type="submit" onclick="goCoursPage()" class="btn btn-info" target="_blank">Vue étudiante actuelle</button>
			</div>
		</div>
	</nav>

	<div class="valider">
		<p><a href="./Cours.php" class="btn btn-primary btn-lg" role="button" onclick="moveMergedFile()">Valider<span class="glyphicon glyphicon-chevron-right"></span></a></p>
	</div>

	<table id="demo">
		<thead>
			<tr>
				<?php

				if (file_exists("./functions/uploads/MergedFile.csv"));

				$fileName = "./functions/uploads/MergedFile.csv";

				if ($file = file_get_contents($fileName)) {
					$file = str_replace('";"', "';'", $file);
					file_put_contents($fileName, $file);
				}

				if ($handle = fopen($fileName, "r")) {
					$data = fgetcsv($handle);
					$line = explode("';'", $data[0]);
				?>
					<th>Course code</th>
					<th>Course name</th>
					<th>Course Level</th>
					<th>Faculty</th>
					<th>Language</th>
					<th>Credits</th>
					<th>Calendar Period</th>
					<th>More</th>
			</tr>
		</thead>
		<tbody>
		<?php
					$rowCount = 0;
					$i = 0;
					while ($data = fgetcsv($handle)) {
						echo "<tr>";
						$line = explode("';'", $data[0]);

						if ($line[17] == "")
							$line[17] = 0;

						$emptyElements = 0;
						foreach ($line as $value)
							if (empty($value))
								$emptyElements++;

						$fr_language = array("francais", "anglais", "espagnol", "portugais", "italien", "chinois", "allemand");
						$en_languge = array("French", "English", "Spanish", "Portuguese", "Italian", "Chinese", "German");

						if ($emptyElements != count($line))
							$rowCount  = $rowCount + 1;
						echo "<td>" . $line[6] . "</td>";
						echo "<td>" . $line[9] . "</td>";
						echo "<td>" . $line[22] . "</td>";
						echo "<td>" . $line[2] . "</td>";
						echo "<td>" . str_replace($fr_language, $en_languge, strtolower($line[10])) . "</td>";
						echo "<td>" . $line[7] . "</td>";
						echo "<td>" . $line[23] . "</td>";

						echo "<form id='allInformation$i' action='CoursInfo.php' method='POST'>";
						for ($j = 0; $j < count($line); $j++)
							echo "<input type='hidden' name='information$j' value='$line[$j]' />";
						$j++;
						echo "<input type='hidden' name='numberInformation' value='$j' />";
						echo "</form>";
						echo "<td>" . "<a href='#' onclick='document.getElementById(\"allInformation$i\").submit()'>" . "<img src='assets/images/afficher.png'/>" . "</a>" . "</td>";

						echo "</tr>";

						$i++;
					}
					echo "<em><p>Nombre de cours disponibles : " . $rowCount . "</p></em>";
					fclose($handle);
				}

		?>
		</tbody>
	</table>

	<div class="valider">
		<p><a href="./Cours.php" class="btn btn-primary btn-lg" role="button" onclick="moveMergedFile()">Valider<span class="glyphicon glyphicon-chevron-right"></span></a></p>
	</div>


	<script src=' assets/tablefilter/tablefilter.js'> </script>
	<script id="rendered-js">
		var filtersConfig = {
			// instruct TableFilter location to import ressources from
			base_path: 'assets/tablefilter/',

			col_2: 'select',
			col_3: 'select',
			col_4: 'select',
			col_6: 'select',
			col_7: 'none',
			help_instructions: false,
			auto_filter: {},
			alternate_rows: true,
			btn_reset: true,
			loader: true,
			mark_active_columns: true,
			highlight_keywords: true,
			no_results_message: true,
			extensions: [{
				name: 'sort'
			}]
		};

		var tf = new TableFilter('demo', filtersConfig);
		tf.init();
	</script>

	</html>

<?php } ?>