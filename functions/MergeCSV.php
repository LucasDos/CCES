<?php

$firstFile = true;
$mergedFile = "";

foreach (glob("uploads/CSV/*.csv") as $file) {
    if ($handle = fopen($file, "r")) {
        if ($firstFile) {
            for ($i = 0; $i < 6; $i++)
                fgets($handle);
        }
        else {
            for ($i = 0; $i < 7; $i++)
                fgets($handle);
        }

        while ($data = fgets($handle)){
            $mergedFile .= $data;

        }

        $firstFile = false;
    }

    fclose($handle);

    file_put_contents("uploads/MergedFile.csv", $mergedFile);
}

?>
