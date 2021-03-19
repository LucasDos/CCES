<?php
$fileName = "../MergedFile.csv";
$page = intval($_POST["page"]);
$language = $_POST["language"];

loadPage($fileName, $page, $language);

/** Get number of courses */
function getNbCourses($fileName){
    if (file_exists($fileName)) {
        if ($handle = fopen($fileName, "r")) {
            $i = 0;
            while($data = fgetcsv($handle)){
                $i++;
            }
        }
        $i--;

        fclose($handle);

        return $i;
    }
}

/** Send data to courses page */
function loadPage($fileName, $page, $language){
    $nbCourses = $page * 50;
    echo getNbCourses($fileName);

    if (file_exists($fileName)) {
        if ($file = file_get_contents($fileName)) {
            $file = str_replace('";"', "';'", $file);
            file_put_contents($fileName, $file);
        }

        if ($handle = fopen($fileName, "r")) {
            // Check language
            if($language == "FR") {
                // Header tab
                $data = fgetcsv($handle);
                $line = explode("';'", $data[0]);
                $res =  "<thead><th>" . $line[6] . "</th>" .
                        "<th> Intitulé du cours </th>" .
                        "<th> Niveau </th>" .
                        "<th> Composante </th>" .
                        "<th> Filière </th>" .
                        "<th> Langue</th>" .
                        "<th> Descriptif </th>" .
                        "<th> Crédits ECTS </th>" .
                        "<th> Semestre </th>" .
                        "<th> Détails </th>" .
                        "<th> Ajout panier </th></thead>";


                // Body tab
                $res .= "<tbody>";

                $id = $nbCourses - 50;
                $i = $nbCourses - 50;

                // Go to good line if is not page 1
                if ($i != 0) {
                    $tmp = $nbCourses - 50;
                    while ($tmp != 0) {
                        $data = fgetcsv($handle);
                        $tmp--;
                    }
                }

                while ($i < $nbCourses) {
                    $data = fgetcsv($handle);
                    if (empty($data)) {
                        break;
                    }
                    $res .= "<tr>";
                    $line = explode("';'", $data[0]);

                    if ($line[17] == "")
                        $line[17] = 0;

                    $emptyElements = 0;
                    foreach ($line as $value)
                        if (empty($value))
                            $emptyElements++;

                    if ($emptyElements != count($line)) {
                        $res .= "<td>" . $line[6] . "</td>" .
                            "<td>" . $line[8] . "</td>" .
                            "<td>" . $line[22] . "</td>" .
                            "<td>" . $line[1] . "</td>" .
                            "<td>" . $line[3] . "</td>" .
                            "<td>" . $line[10] . "</td>" .
                            "<td>" . substr($line[11], 0, 100) . "..." . "</td>" .
                            "<td>" . $line[7] . "</td>" .
                            "<td>" . $line[23] . "</td>";

                        $res .= "<form id='allInformation$i' action='CoursInfo.php' method='POST'>";
                        for ($j = 0; $j < count($line); $j++)
                            $res .= "<input type='hidden' name='information$j' value='$line[$j]' />";
                        $j++;
                        $res .= "<input type='hidden' name='numberInformation' value='$j' />";
                        $res .= "</form>";
                        $res .= "<td align=center>" . "<a href='#' onclick='document.getElementById(\"allInformation$i\").submit()'>" . "<img alt='detail-fr' title='détail' src='assets/images/loupe.png'/>" . "</a>" . "</td>";

                        $res .= "<td align=center>" . "<button class='btn btn-primary btn-sm' id='$id' onclick=\"addCourse('$id','$line[6]','$line[7]','$line[8]','$line[23]','$line[1]','$line[3]');stopAnimation();startAnimation();\">+</button>" . "</td>";
                        $id++;
                    }
                    $res .= "</tr>";

                    $i++;
                }

                $res .= "</tbody>";

                fclose($handle);
            } else {
                // English tab
                // Header tab
                $data = fgetcsv($handle);
                $line = explode("';'", $data[0]);
                $res =  "<thead><th> Course Code </th>".
                        "<th> Course Name </th>".
                        "<th> Course Level </th>".
                        "<th> Faculty </th>".
                        "<th> Degree </th>".
                        "<th> Language </th>".
                        "<th> Content </th>".
                        "<th> Credits </th>".
                        "<th> Semester </th>".
                        "<th> More information </th>".
                        "<th> Add to basket </th></thead>";

                // Body tab
                $res .= "<body>";

                $id = $nbCourses - 50;
                $i = $nbCourses - 50;

                // Go to good line if is not page 1
                if ($i != 0) {
                    $tmp = $nbCourses - 50;
                    while ($tmp != 0) {
                        $data = fgetcsv($handle);
                        $tmp--;
                    }
                }

                while ($i < $nbCourses) {
                    $data = fgetcsv($handle);

                    // Stop while if data empty
                    if (empty($data)) {
                        break;
                    }

                    $res .= "<tr>";
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
                        $res .= "<td>" . $line[6] . "</td>".
                                "<td>" . $line[9] . "</td>".
                                "<td>" . $line[22] . "</td>".
                                "<td>" . $line[2] . "</td>".
                                "<td>" . $line[4] . "</td>".
                                "<td>" . str_replace($fr_language, $en_languge, strtolower($line[10])) . "</td>".
                                "<td>" . substr($line[12], 0, 100) . "..." . "</td>".
                                "<td>" . $line[7] . "</td>".
                                "<td>" . $line[23] . "</td>";

                        $res .= "<form id='allInformation$i' action='CoursInfo.php' method='POST'>";
                        for ($j = 0; $j < count($line); $j++)
                            $res .= "<input type='hidden' name='information$j' value='$line[$j]' />";
                        $j++;
                        $res .= "<input type='hidden' name='numberInformation' value='$j' />";
                        $res .= "</form>";
                        $res .= "<td align=center>" . "<a href='#' onclick='document.getElementById(\"allInformation$i\").submit()'>" . "<img alt='detail-fr' title='détail' src='assets/images/loupe.png'/>" . "</a>" . "</td>";

                        $res .= "<td align=center>" . "<button class='btn btn-primary btn-sm' id='$id' onclick=\"addCourse('$id','$line[6]','$line[7]','$line[9]','$line[23]','$line[2]','$line[4]');stopAnimation();startAnimation();\">+</button>" . "</td>";
                        $id++;
                    }
                    $res .= "</tr>";

                    $i++;
                }
                $res .= "</tbody>";

                fclose($handle);
            }
        }
    }

    echo $res;
}
