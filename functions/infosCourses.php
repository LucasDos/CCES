<?php
$fileName = "../MergedFile.csv";

if (file_exists($fileName)) {
    if ($handle = fopen($fileName, "r")) {
        $i = 0;
        while($data = fgetcsv($handle)){
            $i++;
        }
    }
    $i--;

    fclose($handle);

    echo $i;
}