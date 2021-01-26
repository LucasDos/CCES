<html lang="fr">

<head></head>
<?php
require_once('./functions/import.php');
$page = $_SESSION['returnPage'];

if (!isset($_SESSION["allInformation"]))
    $_SESSION["allInformation"] = array();

if (isset($_POST["numberInformation"])) {
    $_SESSION["allInformation"] = array();
    for ($i = 0; $i < $_POST["numberInformation"]; $i++)
        if (isset($_POST["information" . $i]))
            array_push($_SESSION["allInformation"], $_POST["information" . $i]);
}
?>

<body>

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

        <script>
            window.console = window.console || function(t) {};
        </script>

        <script>
            if (document.location.search.match(/type=embed/gi)) {
                window.parent.postMessage("resize", "*");
            }
        </script>

    </head>

    <script>
        function returnToPage() {
            var url = <?php
                        echo json_encode($page);
                        ?>


            if (url == 'cours') {
                window.location.href = "cours.php";
            } else {
                window.location.href = "VisualisationMAJ.php";
            }

        }
    </script>

    <?php
    require_once('./functions/import.php');
    if (isset($_SESSION['language'])) {
        $language = $_SESSION['language'];
    }

    if ($language == "FR") { ?>

        <title>Plus d'informations</title>
        <div id="banniere">
            <a href="https://www.univ-tours.fr/" target="_blank"><img src="http://cces.univ-tours.fr/res/pics/utfr_logo.svg" alt="Logo de l'université François Rabelais" height="83" width="118" />
                <span style="margin-left: 1.2em;">CCES : Catalogue de Cours pour Etudiants d’Echanges</span></a>
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
                    <li> <a href="Accueil.php"><span class="glyphicon glyphicon-home"></span></a> </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Langue <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="?language=FR">Français</a></li>
                            <li><a href="?language=EN">Anglais</a></li>
                        </ul>
                    </li>
                    <div class="navbar-collapse collapse">
                    </div>

            </div>
        </nav>


        </nav><!-- Fin Nav : Menu top -->
        <div class="jumbotron other-color">
            <h1>
                <td>
                    <?php
                    if (isset($_SESSION["allInformation"][8]))
                        echo $_SESSION["allInformation"][8];
                    ?>
                </td>
            </h1>
        </div>
        <style>
            table {
                width: 100%;
            }

            table tr:nth-child(2n+1) {
                background-color: #f0f0f0;
            }

            td {
                margin: 2px;
            }
        </style>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p> Composante</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][1]))
                                echo $_SESSION["allInformation"][1];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Filière</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][3]))
                                echo $_SESSION["allInformation"][3];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Code ISCED</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][5]))
                                echo $_SESSION["allInformation"][5];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Code Apogée</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][6]))
                                echo $_SESSION["allInformation"][6];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Nombre de crédits ECTS</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][7]))
                                echo $_SESSION["allInformation"][7];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Intitulé du cours</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][8]))
                                echo $_SESSION["allInformation"][8];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Langue du cours (anglais, français,…)</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][10]))
                                echo $_SESSION["allInformation"][10];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Descriptif</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][11]))
                                echo $_SESSION["allInformation"][11];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Bibliographie</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][13]))
                                echo $_SESSION["allInformation"][13];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Volume horaire total</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][14]))
                                echo $_SESSION["allInformation"][14];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Volume horaire CM</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][15]))
                                echo $_SESSION["allInformation"][15];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Volume horaire TD</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][16]))
                                echo $_SESSION["allInformation"][16];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Volume horaire TP</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][17]))
                                echo $_SESSION["allInformation"][17];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Enseignant référent (Prénom Nom)</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][18]))
                                echo $_SESSION["allInformation"][18];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Enseignant référent (email ou contact)</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][19]))
                                echo $_SESSION["allInformation"][19];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Mode d'évaluation</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][20]))
                                echo $_SESSION["allInformation"][20];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Niveau : L1 / L2 / L3 / M1 / M2</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][22]))
                                echo $_SESSION["allInformation"][22];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Semestre 1 ou 2</p>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION["allInformation"][23]))
                                echo $_SESSION["allInformation"][23];
                            ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="container">
            <hr>

            <footer>

            </footer>
        </div> <!-- /container -->
        <!--</div> #rubrique_deco -->
        <div align="right"'>
    <p><a href="javascript:returnToPage();"  class="btn btn-primary btn-lg" role="button">Retour<span class="glyphicon glyphicon-chevron-right"></span></a></p>
</div>
</body></html>

<?php } else { ?>

    <title>More Information</title>
    <div id="banniere">
        <a href="https://www.univ-tours.fr/" target="_blank"><img src="http://cces.univ-tours.fr/res/pics/utfr_logo.svg" alt="Logo de l' université François Rabelais" height="83" width="118" />
        <span style="margin-left: 1.2em;">CCES: Course Catalogue for Exchange Students</span></a>
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
                    <li> <a href="Accueil.php"><span class="glyphicon glyphicon-home"></span></a> </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Language <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="?language=FR">French</a></li>
                            <li><a href="?language=EN">English</a></li>
                        </ul>
                    </li>
                    <div class="navbar-collapse collapse">
                    </div>

            </div>
        </nav>


        </nav><!-- Fin Nav : Menu top -->
        <div class="jumbotron other-color">
            <h1>
                <?php
                if (isset($_SESSION["allInformation"][9]))
                    echo $_SESSION["allInformation"][9];
                ?>
            </h1>
        </div>
        <style>
            table {
                width: 100%;
            }

            table tr:nth-child(2n+1) {
                background-color: #f0f0f0;
            }

            td {
                margin: 2px;
            }
        </style>
        <div>
            <div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <p> Faculty</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][2]))
                                    echo $_SESSION["allInformation"][2];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Degree</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][4]))
                                    echo $_SESSION["allInformation"][4];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Field of studies ( ISCED )</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][5]))
                                    echo $_SESSION["allInformation"][5];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Course code</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][6]))
                                    echo $_SESSION["allInformation"][6];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Credits</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][7]))
                                    echo $_SESSION["allInformation"][7];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p> Course name</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][9]))
                                    echo $_SESSION["allInformation"][9];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p> Language of instruction</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][10]))
                                    echo $_SESSION["allInformation"][10];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Content</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][12]))
                                    echo $_SESSION["allInformation"][12];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Bibliography</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][13]))
                                    echo $_SESSION["allInformation"][13];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Hours (Total)</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][14]))
                                    echo $_SESSION["allInformation"][14];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Hours of lecture</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][15]))
                                    echo $_SESSION["allInformation"][15];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Hours of tutorials</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][16]))
                                    echo $_SESSION["allInformation"][16];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Hours of practice</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][17]))
                                    echo $_SESSION["allInformation"][17];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Coordinator</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][18]))
                                    echo $_SESSION["allInformation"][18];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> E-mail coordinator</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][19]))
                                    echo $_SESSION["allInformation"][19];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Type of evaluation</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][21]))
                                    echo $_SESSION["allInformation"][21];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Level</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][22]))
                                    echo $_SESSION["allInformation"][22];
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p> Calendar Period</p>
                            </td>
                            <td>
                                <?php
                                if (isset($_SESSION["allInformation"][23]))
                                    echo $_SESSION["allInformation"][23];
                                ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <hr>

            <footer>

            </footer>
        </div> <!-- /container -->
        <!--</div> #rubrique_deco -->
        <div align="right"'>
    <p><a href="javascript:returnToPage();"  class="btn btn-primary btn-lg" role="button">Back<span class="glyphicon glyphicon-chevron-right"></span></a></p>
</div>
</body></html>


<?php } ?>