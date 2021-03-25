<?php

$row = 1;
header('Content-Type: text/html; charset=UTF-8');

if (($handle = fopen("../MergedFile.csv", "r")) !== FALSE) {
//    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    while ($row == 1) {
        $data = fgetcsv($handle, 1000, ";");
        $num = count($data);
        $data = str_replace("\"", "", $data[0]);
        $data = str_replace("'", "", $data);
        $array = array($data);

        echo json_encode($array);
        $row++;
    }
    fclose($handle);
}
