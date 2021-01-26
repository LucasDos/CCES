<?php
require_once('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

@session_start();

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'addCourse':
            if (isset($_POST['id']) && isset($_POST['codeCourse']) && isset($_POST['courseECTS']) && isset($_POST['courseTitle']) && isset($_POST['courseSemester']) && isset($_POST['faculty']) && isset($_POST['degree'])) {
                $id = $_POST['id'];
                $courseCode = $_POST['codeCourse'];
                $courseECTS = $_POST['courseECTS'];
                $courseTitle = $_POST['courseTitle'];
                $courseSemester = $_POST['courseSemester'];
                $faculty = $_POST['faculty'];
                $degree = $_POST['degree'];
                addCourseToBasket($id, $courseCode, $courseECTS, $courseTitle, $courseSemester, $faculty, $degree);

                $datas = array();
                if ($handle = fopen("PopularCourses.csv", 'r')) {
                    while ($data = fgetcsv($handle))
                        $datas[$data[0]] = $data[1];
                    fclose($handle);
                }

                if (isset($datas[$courseCode]))
                    $datas[$courseCode]++;
                else
                    $datas[$courseCode] = 1;

                arsort($datas);

                $fp = fopen("PopularCourses.csv", 'w');
                foreach ($datas as $courseCode => $data)
                    fputcsv($fp, array($courseCode, $data));
                fclose($fp);
            }
            break;
        case 'removeCourse':
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                removeCourseFromBasket($id);
            }
            break;
        case 'emptyBasket':
            emptyBasket();
            break;
        case 'getECTS':
            computeTotalECTS();
            break;
        case 'getBasket':
            echoBasket();
            break;
        case 'getDisabledButtons':
            getDisabledButtons();
            break;
        case 'exportExcel':
            exportInExcel();
            break;
    }
}

function addCourseToBasket($id, $courseCode, $courseECTS, $courseTitle, $courseSemester, $faculty, $degree)
{
    $_SESSION['basket'][] = array($id, $courseCode, $courseECTS, $courseTitle, $courseSemester, $faculty, $degree);
    echoBasket();
}

function removeCourseFromBasket($id)
{
    foreach ($_SESSION['basket'] as $key => $course) {
        if ($course[0] == $id) {
            //on efface la valeur
            unset($_SESSION['basket'][$key]);
        }
    }
    //on réindexe le tableau en partant de 0
    $_SESSION['basket'] = array_values($_SESSION['basket']);
    echoBasket();
}

function emptyBasket()
{
    $_SESSION['basket'] = array();
    echoBasket();
}

function computeTotalECTS()
{
    $sum = 0;
    foreach ($_SESSION['basket'] as $course) {
        $sum += $course[2];
    }
    echo $sum;
}

function echoBasket()
{
    if ($_SESSION['language'] == "FR") {
        if (!empty($_SESSION['basket'])) {
            echo "<table class='table'>
                    <thead>
                      <tr>
                        <th scope='col' class='text-center'>Code Apogée</th>
                        <th scope='col' class='text-center'>Intitulé</th>
                        <th scope='col' class='text-center'>Crédits ECTS</th>
                        <th scope='col class='text-center'>Retirer</th> 
                      </tr>
                    </thead>
                <tbody>";
            foreach ($_SESSION['basket'] as $course) {
                echo "<tr>
                        <td align=center>" . $course[1] . "</td>
                        <td align=center>" . $course[3] . "</td>
                        <td align=center>" . $course[2] . "</td>
                        <td align=center><buttton type='button' class='btn btn btn-primary btn-sm' onclick=\"enableButton('$course[0]');removeCourse('$course[0]');\">-</button></td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
    } else {
        if (!empty($_SESSION['basket'])) {
            echo "<table class='table'>
                    <thead>
                      <tr>
                        <th scope='col' class='text-center'>Course Code</th>
                        <th scope='col' class='text-center'>Course Name</th>
                        <th scope='col' class='text-center'>Credits</th>
                        <th scope='col class='text-center'>Remove</th> 
                      </tr>
                    </thead>
                <tbody>";
            foreach ($_SESSION['basket'] as $course) {
                echo "<tr>
                        <td align=center>" . $course[1] . "</td>
                        <td align=center>" . $course[3] . "</td>
                        <td align=center>" . $course[2] . "</td>
                        <td align=center><buttton type='button' class='btn btn btn-primary btn-sm' onclick=\"enableButton('$course[0]');removeCourse('$course[0]');\">-</button></td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
    }
}

function getDisabledButtons()
{
    $disabledIDs = array();
    foreach ($_SESSION['basket'] as $course) {
        $disabledIDs[] = $course[0];
    }
    echo json_encode($disabledIDs);
}

function exportInExcel()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Titre des colonnes
    $sheet->setCellValue('A1', 'Composante');
    $sheet->setCellValue('B1', 'Filière');
    $sheet->setCellValue('C1', 'Code');
    $sheet->setCellValue('D1', 'Titre');
    $sheet->setCellValue('E1', 'Semestre');
    $sheet->setCellValue('F1', 'Crédits ECTS');

    // auto fit column to content
    foreach (range('A', 'F') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }

    //charger les données
    $data = array();
    foreach ($_SESSION['basket'] as $course) {
        $data[] = explode(';', trim($course[5]) . ";" . trim($course[6]) . ";" . trim($course[1]) . ";" . trim($course[3]) . ";" . trim($course[4]) . ";" . trim($course[2]));
    }
    //calcul total ects
    $sum = 0;
    foreach ($_SESSION['basket'] as $course) {
        $sum += $course[2];
    }
    $data[] = explode(';', " " . ";" . " " . ";" . " " . ";" . " " . ";" . " " . ";" . "Total : " . $sum);

    //remplir les lignes du fichier
    $x = 2;
    foreach ($data as $get) {
        $sheet->setCellValue('A' . $x, $get[0]);
        $sheet->setCellValue('B' . $x, $get[1]);
        $sheet->setCellValue('C' . $x, $get[2]);
        $sheet->setCellValue('D' . $x, $get[3]);
        $sheet->setCellValue('E' . $x, $get[4]);
        $sheet->setCellValue('F' . $x, $get[5]);
        $x++;
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save('panier_export.xlsx');


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="panier_export.xlsx"');

    readfile('panier_export.xlsx');

    echoBasket();
}
