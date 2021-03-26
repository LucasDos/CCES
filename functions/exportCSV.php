<?php

//function outputCsv() {
//    $data = generateCsv();
//    $fp = fopen( 'php://output', 'w' );
//
//    foreach ( $data AS $values ):
//        fputcsv( $fp, $values );
//    endforeach;
//
//    fclose( $fp );
//
//    exit();
//}


if (file_exists("../MergedFile.csv")) {

    $fileName = "../MergedFile.csv";

//    if ($file = file_get_contents($fileName)) {
//        $file = str_replace('";"', "';'", $file);
//        file_put_contents($fileName, $file);
//    }
//
//    if ($file = file_get_contents($fileName)) {
//        $file = str_replace('";"', "';'", $file);
//        file_put_contents($fileName, $file);
//    }

    if ($handle = fopen($fileName, "r")) {
        $id = 0;
        $i = 0;
        $data = "";
        $specialCar = ["'", "\""];
        while ($dataTmp = fgetcsv($handle)) {
            echo $dataTmp[0];
            $line = explode("';'", $dataTmp[0]);

//            if (strcmp($line[17], ""))
//                $line[17] = 0;


            $emptyElements = 0;
            foreach ($line as $value) {
                if (empty($value)) {
                    $emptyElements++;
                }
            }

            $length = count($line);
//            echo "\n====> " . $length . "\n";
            for ($i = 0; $i <$length; $i++) {
                if(strcmp($line[$i], "") == 0) {
                    $line[$i] = "Aucunes informations...";
                }

                $data .= strval($line[$i]) . ";";
//                echo "-------------\n" . $line[$i] . "\n-------------\n";
//                $data .= str_replace($specialCar, "", $line[$i]);
//                foreach ($line as $item) {
//                    echo $item;
//                }
            }
            $data .= "\n";
            echo $data . "\n";

            $i++;


        }
        fclose($handle);
    }
}

//echo $data;
//
//    return outputCsv($data);
//}
