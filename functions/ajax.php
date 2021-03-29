<?php
// Load PhpSpreadsheet library.
require_once('vendor/autoload.php');

// Import classes.
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

function convertExcelToCSV($fileName)
{
    // Read the Excel file.
    $reader = IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load($fileName);

    // Export to CSV file.
    $writer = IOFactory::createWriter($spreadsheet, "Csv");
    $writer->setSheetIndex(0);   // Select which sheet to export.
    $writer->setDelimiter(';');  // Set delimiter.

    $writer->save("uploads/CSV/" . basename($fileName, ".xlsx") . ".csv");
}

session_start();

/** Checks if the files are in the good format */
$clearFiles = "";
if (isset($_SESSION["depositPage"]) && !$_SESSION["depositPage"] && isset($_SESSION["errors"]) && $_SESSION["errors"] && glob("uploads/Excel/*") && glob("uploads/CSV/*"))
    $clearFiles = " Certains des fichiers testés auparavant comportaient des erreurs. Tous les fichiers testés auparavant ont été supprimés.<br /><br />";

if (isset($_SESSION["depositPage"]) && $_SESSION["depositPage"]) {
    array_map("unlink", glob("uploads/Excel/*"));
    array_map("unlink", glob("uploads/CSV/*"));
    $_SESSION["depositPage"] = false;
}

if (isset($_SESSION["errors"]) && $_SESSION["errors"]) {
    array_map("unlink", glob("uploads/Excel/*"));
    array_map("unlink", glob("uploads/CSV/*"));
    $_SESSION["errors"] = false;
}

$files = array();

$wrongFileExtension = "";
foreach ($_FILES['file']['name'] as $key => $val) {
    $file_name = $_FILES['file']['name'][$key];

    if ((new SplFileInfo($file_name))->getExtension() == "xlsx") {
        if (!file_exists(getcwd() . '/uploads/Excel'))
            mkdir(getcwd() . '/uploads/Excel', 0777);
        if (!file_exists(getcwd() . '/uploads/CSV'))
            mkdir(getcwd() . '/uploads/CSV', 0777);

        move_uploaded_file($_FILES['file']['tmp_name'][$key], getcwd() . '/uploads/Excel/' . $file_name);
    } else
        $wrongFileExtension = " Certains fichiers qui n'étaient pas des fichiers Excel n'ont pas été pris en compte.<br /><br />";
}

/** Convert XLSX to CSV format */
foreach (glob("uploads/Excel/*.xlsx") as $file) {
    convertExcelToCSV($file);
    array_push($files, basename($file));
}

$errorsFilesExtensions = false;
foreach (glob("uploads/Excel/*.xlsx") as $file)
    $errorsFilesExtensions = true;

$columnNames = array("Remarques DRI", "Composante (nom français)", "Composante (nom anglais)", "Filière (nom français)", "Filière (nom anglais)", "Code ISCED", "Code Apogée", "Nombre de crédits ECTS", "Intitulé du cours", "Intitulé du cours en anglais (si existant)", "Langue du cours (anglais, français,…)", "Descriptif en français", "Descriptif en anglais (si disponible)", "Bibliographie", "Volume horaire total", "Volume horaire CM", "Volume horaire TD", "Volume horaire TP", "Enseignant référent (Prénom Nom)", "Enseignant référent (email ou contact)", "Mode d'évaluation", "Mode d'évaluation (version anglaise)", "Niveau :  L1 / L2 / L3 / M1 / M2", "Semestre 1 ou 2");
$columnHeaders = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$errors = "";
$warning = "";

/** Save file in MergedCSV */
foreach (glob("uploads/CSV/*.csv") as $file) {
    if ($handle = fopen($file, "r")) {
        $courseCodes = array();
        $duplicateCourseCodes = array();

        $errorsHeader = false;
        $errorsColumns = false;

        $badColumns = array();
        $columnsNotProvided = array();

        $numericalValues = array();
        $requiredFields = array();
        $sumHourlyVolumes = array();
        $levels = array();
        $terms = array();

        $i = 0;
        while ($data = fgetcsv($handle, '', ';')) {
            if ($i == 3 && !$errorsHeader) {
                for ($j = 0; $j < count($data); $j++)
                    if ($j == 6 || $j == 11) {
                        if ($data[6] != "CCES- Catalogue des Cours pour Etudiants d'Echange" || $data[11] != "Cliquez ici pour accéder à la plateforme") {
                            $errorsHeader = true;
                            break;
                        }
                    } else if (!empty($data[$j])) {
                        $errorsHeader = true;
                        break;
                    }
            } else if ($i < 6 && !$errorsHeader) {
                foreach ($data as $value)
                    if (!empty($value))
                        $errorsHeader = true;
            } else if ($i == 6  && !$errorsHeader) {
                for ($j = 0; $j < count($columnNames); $j++)
                    if (isset($data[$j]) && $columnNames[$j] != $data[$j]) {
                        array_push($badColumns, array($data[$j], $columnNames[$j], $columnHeaders[$j]));
                        $errorsColumns = true;
                    } else if (!isset($data[$j])) {
                        array_push($badColumns, array("", $columnNames[$j], $columnHeaders[$j]));
                        $errorsColumns = true;
                    }

                $j = 0;
                if (empty($badColumns))
                    foreach ($columnNames as $columnName) {
                        if ($columnName != $data[$j]) {
                            $errorsColumns = true;
                            break;
                        }
                        $j++;
                    }

                foreach ($data as $value)
                    if (!in_array($value, $columnNames) && !empty($value))
                        array_push($columnsNotProvided, $value);
            } else if ($i > 6 && !$errorsHeader && !$errorsColumns && empty($columnsNotProvided)) {
                if (in_array($data[6], $courseCodes) && !in_array($data[6], $duplicateCourseCodes))
                    array_push($duplicateCourseCodes, $data[6]);
                if (!in_array($data[6], $duplicateCourseCodes))
                    array_push($courseCodes, $data[6]);

                foreach ($data as $value)
                    if (!empty($value)) {
                        if (isset($data[7]) && $data[7] == "")
                            $data[7] = 0;
                        if (isset($data[14]) && $data[14] == "")
                            $data[14] = 0;
                        if (isset($data[15]) && $data[15] == "")
                            $data[15] = 0;
                        if (isset($data[16]) && $data[16] == "")
                            $data[16] = 0;
                        if (isset($data[17]) && $data[17] == "")
                            $data[17] = 0;

                        if (isset($data[7]) && !is_numeric($data[7]))
                            array_push($numericalValues, array($i + 1, $columnNames[7]));
                        if (isset($data[14]) && !is_numeric($data[14]))
                            array_push($numericalValues, array($i + 1, $columnNames[14]));
                        if (isset($data[15]) && !is_numeric($data[15]))
                            array_push($numericalValues, array($i + 1, $columnNames[15]));
                        if (isset($data[16]) && !is_numeric($data[16]))
                            array_push($numericalValues, array($i + 1, $columnNames[16]));
                        if (isset($data[17]) && !is_numeric($data[17]))
                            array_push($numericalValues, array($i + 1, $columnNames[17]));

                        if (isset($data[1]) && $data[1] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[1]));
                        if (isset($data[2]) && $data[2] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[2]));
                        if (isset($data[3]) && $data[3] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[3]));
                        if (isset($data[4]) && $data[4] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[4]));
                        if (isset($data[5]) && $data[5] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[5]));
                        if (isset($data[6]) && $data[6] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[6]));
                        if (isset($data[8]) && $data[8] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[8]));
                        if (isset($data[9]) && $data[9] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[9]));
                        if (isset($data[10]) && $data[10] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[10]));
                        if (isset($data[11]) && $data[11] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[11]));
                        if (isset($data[18]) && $data[18] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[18]));
                        if (isset($data[19]) && $data[19] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[19]));
                        if (isset($data[20]) && $data[20] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[20]));
                        if (isset($data[21]) && $data[21] == "")
                            array_push($requiredFields, array($i + 1, $columnNames[21]));

                        if (isset($data[14]) && isset($data[15]) && isset($data[16]) && isset($data[17]) && is_numeric($data[14]) && is_numeric($data[15]) && is_numeric($data[16]) && is_numeric($data[17]) && $data[15] + $data[16] + $data[17] != $data[14])
                            array_push($sumHourlyVolumes, $i + 1);

                        if (isset($data[22]) && $data[22] != "L1" && $data[22] != "L2" && $data[22] != "L3" && $data[22] != "M1" && $data[22] != "M2")
                            array_push($levels, $i + 1);

                        if (isset($data[23]) && $data[23] != 1 && $data[23] != 2)
                            array_push($terms, $i + 1);

                        break;
                    }
            }

            $i++;
        }

        if ($errorsHeader)
            $errors .= "<tr><th scope='row'>Fichier " . basename($file, ".csv") . ".xlsx" . "</th></tr><tr><td>L'en-tête n'est pas valide. Il doit être contenu dans les 6 premières lignes et sur les colonnes A à X.</td></tr>";

        if ($errorsColumns)
            $errors .= "<tr><th scope='row'>Fichier " . basename($file, ".csv") . ".xlsx" . "</th></tr>";
        if (!empty($badColumns)) {
            $errors .= "<tr><td>Mauvaises colonnes</td></tr><tr><td>";
            for ($i = 0; $i < count($badColumns); $i++)
                $errors .= "L'en-tête de la colonne " . $badColumns[$i][2] . " est \"" . $badColumns[$i][0] . "\" alors qu'il devrait être \"" . $badColumns[$i][1] . "\".<br />";
            $errors .= "</td></tr>";
        }
        if (count($columnsNotProvided) > count($columnNames)) {
            $errors .= "<tr><td>Colonnes non prévues</td></tr><tr><td>";
            foreach ($columnsNotProvided as $columnNotProvided)
                $errors .= $columnNotProvided . "<br />";
            $errors .= "</td></tr>";
        }

        if (!empty($numericalValues) || !empty($requiredFields) || $sumHourlyVolumes)
            $errors .= "<tr><th scope='row'>Fichier " . basename($file, ".csv") . ".xlsx" . "</th></tr>";
        if (!empty($numericalValues)) {
            $errors .= "<tr><td>Valeurs numériques</td></tr><tr><td>";
            foreach ($numericalValues as $numericalValue) {
                $error = "Ligne : ";
                foreach ($numericalValue as $value)
                    $error .= $value . ", colonne : ";
                $errors .= substr($error, 0, -12) . "<br />";
            }
            $errors .= "</td></tr>";
        }
        if (!empty($requiredFields)) {
            $errors .= "<tr><td>Champs obligatoires</td></tr><tr><td>";
            foreach ($requiredFields as $requiredField) {
                $error = "Ligne ";
                foreach ($requiredField as $value)
                    $error .= $value . ", colonne : ";
                $errors .= substr($error, 0, -12) . "<br />";
            }
            $errors .= "</td></tr>";
        }
        if (!empty($sumHourlyVolumes)) {
            $errors .= "<tr><td>Somme du volume horaire CM, TD et TP différente du volume horaire total</td></tr><tr><td>";
            foreach ($sumHourlyVolumes as $sumHourlyVolume)
                $errors .= "Ligne : " . $sumHourlyVolume . "<br />";
            $errors .= "</td></tr>";
        }
        if (!empty($levels)) {
            $errors .= "<tr><td>Niveau différent de L1, L2, L3, M1 ou M2</td></tr><tr><td>";
            foreach ($levels as $level)
                $errors .= "Ligne : " . $level . "<br />";
            $errors .= "</td></tr>";
        }
        if (!empty($terms)) {
            $errors .= "<tr><td>Semestre différent de 1 ou 2</td></tr><tr><td>";
            foreach ($terms as $term)
                $errors .= "Ligne : " . $term . "<br />";
            $errors .= "</td></tr>";
        }

        if (!empty($duplicateCourseCodes))
            $warning = "<div> </div><div> Avertissement : codes Apogée dupliqués :</div>";
        foreach ($duplicateCourseCodes as $duplicateCourseCode)
            $warning .= "<div> - " . $duplicateCourseCode . "</div>";
    }

    fclose($handle);
}

if (!empty($clearFiles) && !empty($wrongFileExtension))
    echo  " Certains des fichiers testés auparavant comportaient des erreurs. Tous les fichiers testés auparavant ont été supprimés.<br /><br /> Certains fichiers qui n'étaient pas des fichiers Excel n'ont pas été pris en compte.<br /><br />";
else
    echo $clearFiles . $wrongFileExtension;
if (count($files) != 0) {
    if (count($files) == 1)
        echo "<div class='form-group'><label for='exampleFormControlSelect2'> " . count($files) . " fichier testé</label><select multiple class='form-control' id='exampleFormControlSelect2'>";
    else
        echo "<div class='form-group'><label for='exampleFormControlSelect2'> " . count($files) . " fichiers testés</label><select multiple class='form-control' id='exampleFormControlSelect2'>";
    foreach ($files as $file)
        echo "<option>" . $file . "</option>";
    echo "</select></div>";

    if (empty($errors) && count($files))
        echo " L'importation a été effectuée avec succès.<div style='position: relative; float: right;'><p><a href='./VisualisationMAJ.php' class='btn btn-primary btn-lg' role='button' onclick='mergeCSV()'>Visualiser<span class='glyphicon glyphicon-chevron-right'></span></a></p></div>";
    else {
        echo "<label for='errors'> L'importation a échoué.</label><table class='table table-bordered table-striped mb-0' id='errors'><tbody><tr><td>" . $errors . "</td></tr></tbody></table>";
        $_SESSION["errors"] = true;
    }

    echo $warning;
}
die;
