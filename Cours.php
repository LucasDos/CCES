<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/cours.css">
    <link rel="stylesheet" href="./assets/css/modal.css">
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
    <script type="text/javascript" src="./assets/js/cours.js"></script>
</head>

<body onload="echoBasket()">
    <?php
    require_once('./functions/import.php');
    returnPage('cours');
    if (isset($_SESSION['language'])) {
        $language = $_SESSION['language'];
    }
    if ($language == "FR") { ?>
        <title>Rechercher un cours</title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Nav Menu: top -->
        <?php require_once("utils/header.php") ?>

        <table id="courseTable" style="width:100%">
            <thead>
                <tr>
                    <?php
                    if (file_exists("./MergedFile.csv")) {

                        $fileName = "./MergedFile.csv";

                        if ($file = file_get_contents($fileName)) {
                            $file = str_replace('";"', "';'", $file);
                            file_put_contents($fileName, $file);
                        }

                        if ($file = file_get_contents($fileName)) {
                            $file = str_replace('";"', "';'", $file);
                            file_put_contents($fileName, $file);
                        }

                        if ($handle = fopen($fileName, "r")) {
                            $data = fgetcsv($handle);
                            $line = explode("';'", $data[0]);
                            echo "<th>" . $line[6] . "</th>";
                            echo "<th>" . "Intitulé du cours" . "</th>";
                            echo "<th>" . "Niveau" . "</th>";
                            echo "<th>" . "Composante" . "</th>";
                            echo "<th>" . "Filière" . "</th>";
                            echo "<th>" . "Langue" . "</th>";
                            echo "<th>" . "Descriptif" . "</th>";
                            echo "<th>" . "Crédits ECTS" . "</th>";
                            echo "<th>" . "Semestre" . "</th>";
                            echo "<th>" . "Détails" . "</th>";
                            echo "<th>" . "Ajout panier" . "</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
        <?php
                            $id = 0;
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

                                if ($emptyElements != count($line)) {
                                    echo "<td>" . $line[6] . "</td>";
                                    echo "<td>" . $line[8] . "</td>";
                                    echo "<td>" . $line[22] . "</td>";
                                    echo "<td>" . $line[1] . "</td>";
                                    echo "<td>" . $line[3] . "</td>";
                                    echo "<td>" . $line[10] . "</td>";
                                    echo "<td>" . $line[11] . "</td>";
                                    echo "<td>" . $line[7] . "</td>";
                                    echo "<td>" . $line[23] . "</td>";

                                    echo "<form id='allInformation$i' action='CoursInfo.php' method='POST'>";
                                    for ($j = 0; $j < count($line); $j++)
                                        echo "<input type='hidden' name='information$j' value='$line[$j]' />";
                                    $j++;
                                    echo "<input type='hidden' name='numberInformation' value='$j' />";
                                    echo "</form>";
                                   
                                    ?>
                                    <td align=center> <a><img href="#modal<?php echo $i;?>" class="js-modal"  style="cursor: pointer;" src='assets/images/loupe.png'/></a></td>
                                    <?php
                                    echo "<td align=center>" . "<button class='btn btn-primary btn-sm' id='$id' onclick=\"addCourse('$id','$line[6]','$line[7]','$line[8]','$line[23]','$line[1]','$line[3]');stopAnimation();startAnimation();\">+</button>" . "</td>";
                                    $id++;
                                }
                                echo "</tr>";
                                ?>
                                <!-- Modal -->
                                <aside id="modal<?php echo $i;?>" class="modal"  role="dialog" aria-labelledby="title-modal" >
                                    <div class="modal-wrapper js-modal-stop">
                                        <button class="js-modal-close" style="float: right;"><img src='assets/images/close.svg'></button>
                                        <h1 id="title-modal"><?php echo $line[8] ?></h1>
                                        <!--<p><pre><?php print_r($line) ?></pre></p>-->
                                        <div class="modalBody">
                                            <div class="bodyContent">
                                                <p class="modalLabel">Composante : </p>
                                                <p><?php echo $line[1] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Filière : </p>
                                                <p><?php echo $line[3] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Code ISCED : </p>
                                                <p><?php echo $line[5] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Code Apogée : </p>
                                                <p><?php echo $line[6] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <h5 class="modalLabel">Nombre de crédits ECTS : </h5>
                                                <h5><?php echo $line[7] ?></h5>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Langue du cours (anglais, français,…) : </p>
                                                <p><?php echo $line[10] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Descriptif : </p>
                                                <p><?php echo $line[11] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Bibliographie : </p>
                                                <p><?php echo $line[13] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Volume horaire total : </p>
                                                <p><?php echo $line[14] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Volume horaire CM : </p>
                                                <p><?php echo $line[15] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Volume horaire TD : </p>
                                                <p><?php echo $line[16] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Volume horaire TP : </p>
                                                <p><?php echo $line[17] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Enseignant référent (Prénom Nom) : </p>
                                                <p><?php echo $line[18] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Enseignant référent (email ou contact) : </p>
                                                <p><?php echo $line[19] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Mode d'évaluation : </p>
                                                <p><?php echo $line[20] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Niveau : L1 / L2 / L3 / M1 / M2 : </p>
                                                <p><?php echo $line[22] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Semestre 1 ou 2 : </p>
                                                <p><?php echo $line[23] ?></p>
                                            </div>
                                            
                                        </div>
                                        <div class="modalBody">
                                                 
                                        </div>
                                    </div>
            
                                </aside>
                                <?php
                                $i++;
                            }
                            fclose($handle);
                        }
                    }
        ?>
            </tbody>
        </table>
        </div>
        <script type="text/javascript" src="./assets/tablefilter/tablefilter.js"></script>
        <script type="text/javascript" src="./assets/js/coursTableFilterRenderingFR.js"></script>
        <script type="text/javascript" src="./assets/js/modal.js"></script>
    <?php } else { ?>
        <title>Search for a course</title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php require_once('utils/header.php') ?>

        <table id="courseTable" style="width:100%">
            <thead>
                <tr>
                    <?php
                    if (file_exists("./MergedFile.csv")) {

                        $fileName = "./MergedFile.csv";

                        if ($file = file_get_contents($fileName)) {
                            $file = str_replace('";"', "';'", $file);
                            file_put_contents($fileName, $file);
                        }

                        if ($file = file_get_contents($fileName)) {
                            $file = str_replace('";"', "';'", $file);
                            file_put_contents($fileName, $file);
                        }

                        if ($handle = fopen($fileName, "r")) {
                            $data = fgetcsv($handle);
                            $line = explode("';'", $data[0]);
                            echo "<th>Course Code</th>";
                            echo "<th>Course Name</th>";
                            echo "<th>Course Level</th>";
                            echo "<th>Faculty</th>";
                            echo "<th>Degree</th>";
                            echo "<th>Language</th>";
                            echo "<th>Content</th>";
                            echo "<th>Credits</th>";
                            echo "<th>Semester</th>";
                            echo "<th>" . "More information" . "</th>";
                            echo "<th>" . "Add to basket" . "</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
        <?php
                            $id = 0;
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
                                if ($emptyElements != count($line)) {
                                    echo "<td>" . $line[6] . "</td>";
                                    echo "<td>" . $line[9] . "</td>";
                                    echo "<td>" . $line[22] . "</td>";
                                    echo "<td>" . $line[2] . "</td>";
                                    echo "<td>" . $line[4] . "</td>";
                                    echo "<td>" . str_replace($fr_language, $en_languge, strtolower($line[10])) . "</td>";
                                    echo "<td>" . $line[12] . "</td>";
                                    echo "<td>" . $line[7] . "</td>";
                                    echo "<td>" . $line[23] . "</td>";

                                    echo "<form id='allInformation$i' action='CoursInfo.php' method='POST'>";
                                    for ($j = 0; $j < count($line); $j++)
                                        echo "<input type='hidden' name='information$j' value='$line[$j]' />";
                                    $j++;
                                    echo "<input type='hidden' name='numberInformation' value='$j' />";
                                    echo "</form>";
                                    ?>
                                    <td align=center> <a><img href="#modal<?php echo $i;?>" class="js-modal"  style="cursor: pointer;" src='assets/images/loupe.png'/></a></td>
                                    <?php
                                    echo "<td align=center>" . "<button class='btn btn-primary btn-sm' id='$id' onclick=\"addCourse('$id','$line[6]','$line[7]','$line[9]','$line[23]','$line[2]','$line[4]');stopAnimation();startAnimation();\">+</button>" . "</td>";
                                    $id++;
                                }
                                echo "</tr>";


                                ?>
                                <!-- Modal -->
                                <aside id="modal<?php echo $i;?>" class="modal"  role="dialog" aria-labelledby="title-modal" >
                                    <div class="modal-wrapper js-modal-stop">
                                        <button class="js-modal-close" style="float: right;"><img src='assets/images/close.svg'></button>
                                        <h1 id="title-modal"><?php echo $line[8] ?></h1>
                                        <!--<p><pre><?php print_r($line) ?></pre></p>-->
                                        <div class="modalBody">
                                            <div class="bodyContent">
                                                <p class="modalLabel">Faculty : </p>
                                                <p><?php echo $line[2] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Degree : </p>
                                                <p><?php echo $line[4] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Field of studies ( ISCED ) : </p>
                                                <p><?php echo $line[5] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Course code : </p>
                                                <p><?php echo $line[6] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <h5 class="modalLabel">Credits : </h5>
                                                <h5><?php echo $line[7] ?></h5>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Language of instruction : </p>
                                                <p><?php echo $line[10] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Content : </p>
                                                <p><?php echo $line[12] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Bibliography : </p>
                                                <p><?php echo $line[13] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Hours (Total) : </p>
                                                <p><?php echo $line[14] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Hours of lecture : </p>
                                                <p><?php echo $line[15] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Hours of tutorials : </p>
                                                <p><?php echo $line[16] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Hours of practice : </p>
                                                <p><?php echo $line[17] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Coordinator : </p>
                                                <p><?php echo $line[18] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">E-mail coordinator : </p>
                                                <p><?php echo $line[19] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Type of evaluation : </p>
                                                <p><?php echo $line[21] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Level: </p>
                                                <p><?php echo $line[22] ?></p>
                                            </div>
                                            <div class="bodyContent">
                                                <p class="modalLabel">Calendar Period : </p>
                                                <p><?php echo $line[23] ?></p>
                                            </div>
                                            
                                        </div>
                                        <div class="modalBody">
                                                 
                                        </div>
                                    </div>
            
                                </aside>
                                <?php

                                $i++;
                            }
                            fclose($handle);
                        }
                    }
        ?>
            </tbody>
        </table>
        </div>
        <script type="text/javascript" src="./assets/tablefilter/tablefilter.js"></script>
        <script type="text/javascript" src="./assets/js/coursTableFilterRenderingEN.js"></script>
        <script type="text/javascript" src="./assets/js/modal.js"></script>
    <?php } ?>
</body>

</html>