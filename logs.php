<!DOCTYPE html>
<?php
require_once('./functions/import.php');

if (!isset($_SESSION["authentificationSuccess"]) || isset($_SESSION["authentificationSuccess"]) && !$_SESSION["authentificationSuccess"])
    header("Location: Authentification.php");
?>
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
    <link rel="stylesheet" href="./assets/widgEditor/css/widgEditor.css" />
    <script src="./assets/widgEditor/scripts/widgEditor.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/utils.js"></script>

    <style>
        #charts {
            display: flex;
            justify-content: space-around;
        }
    </style>

    <script>
        var config = {
            type: 'line',
            data: {
                labels: [
                    <?php
                    $datas = array();
                    if ($handle = fopen("functions/VisitsFunctionTime.csv", 'r')) {
                        while ($data = fgetcsv($handle))
                            array_push($datas, $data);
                        fclose($handle);
                    }

                    foreach ($datas as $data)
                        echo json_encode($data[0]) . ',';
                    ?>
                ],
                datasets: [{
                    label: 'Nombre de visites en fonction du temps ',
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        <?php
                        foreach ($datas as $data)
                            echo json_encode($data[1]) . ',';
                        ?>
                    ],
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Temps'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Nombre de visites'
                        }
                    }]
                }
            }
        };

        var color = Chart.helpers.color;
        var barChartData = {
            labels: [
                <?php
                $datas = array();
                if ($handle = fopen("functions/PopularCourses.csv", 'r')) {
                    while ($data = fgetcsv($handle))
                        array_push($datas, $data);
                    fclose($handle);
                }

                foreach ($datas as $data)
                    echo json_encode($data[0]) . ',';
                ?>
            ],
            datasets: [{
                label: 'Cours populaires ',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [
                    <?php
                    foreach ($datas as $data)
                        echo json_encode($data[1]) . ',';
                    ?>
                ]
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById('visitsFunctionTime').getContext('2d');
            window.myLine = new Chart(ctx, config);
            var ctx = document.getElementById('popularCourses').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Cours'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Nombre de cours sélectionnés'
                            }
                        }]
                    }
                }
            });
        };
    </script>
</head>

<body>
    <title>Données statistiques</title>
    <div id="banniere">
        <a href="https://www.univ-tours.fr/" target="_blank"><img src="./assets/images/utfr_logo.svg" alt="Logo de l'université François Rabelais" height="83" width="118"></a>
        <span style="margin-left: 1.2em;">CCES : Catalogue de Cours pour Etudiants d’Echanges</span>
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
                <li>
                    <a href="./index.php">
                        <span class="glyphicon glyphicon-home"></span>
                    </a>
                </li>
                <li>
                    <a href="./Depot.php">
                        <span class="glyphicon glyphicon-edit"></span> Zone de dépôt
                    </a>
                </li>
            </ul>
        </div>
    </nav><!-- Fin Nav : Menu top -->
    <div id='content'>
        <h1> Données statistiques</h1>
        <div id="charts">
            <div style="width: 45%;">
                <canvas id="visitsFunctionTime"></canvas>
            </div>
            <div style="width: 45%;">
                <canvas id="popularCourses"></canvas>
            </div>
        </div>
    </div>
</body>

</html>