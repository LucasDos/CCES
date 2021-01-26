<?php

if (isset($_GET['language']) && $_GET['language'] == 'FR') {
    $_SESSION['language'] = 'FR';
} elseif (isset($_GET['language']) && $_GET['language'] == 'EN') {
    $_SESSION['language'] = 'EN';
}
elseif (!isset($_SESSION['language'])){
    $_SESSION['language'] = 'FR';
}
?>
