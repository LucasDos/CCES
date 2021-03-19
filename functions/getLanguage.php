<?php
session_start();

if(isset($_SESSION["language"])){
    echo $_SESSION["language"];
} else {
    echo "FR";
}