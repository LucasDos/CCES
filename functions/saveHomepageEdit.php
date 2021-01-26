<?php
try {
    $language = $_POST["language"];
    $modifiedContent = $_POST["editor"];
    $dom = new DOMDocument();
    $dom->loadHTML("<?xml encoding='UTF-8'>" . $modifiedContent);
    if ($language == "Français") {
        $dom->saveHTMLFile("./uploads/HTML/AccueilContentFR.html");
    } else {
        $dom->saveHTMLFile("./uploads/HTML/AccueilContentEN.html");
    }
    echo "OK";
} catch (Exception $ex) {
    echo "KO";
}
