<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/cours.css">
    <link rel="stylesheet" href="./assets/css/sticky-footer.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./assets/js/plugin.date.eu.js"></script>
    <script type="text/javascript" src="./assets/js/tooltip.js"></script>
    <script type="text/javascript" src="./assets/js/scrollspy.js"></script>
    <script type="text/javascript" src="./assets/js/cours.js"></script>
</head>

<body onload="echoBasket()">
    <input id="language" type="hidden" value="">
    <?php
    require_once('./functions/import.php');
    returnPage('cours');
    if (isset($_SESSION['language'])) {
        $language = $_SESSION['language'];
    }

    if ($language == "FR") { ?>
        <title>Rechercher un cours</title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Nav Menu: top -->
        <?php require_once("utils/header.php") ?>

        <!-- Nav tab -->
        <div class="table-nav" style="display: flex; flex-direction: row; justify-content: space-between; margin: 2px 0 2px 0;">
            <span> Nombre de cours : <span id="nb-cours"></span></span>
            <button onclick="previousPage(document.getElementById('page-courante'))"> Previous page </button>

            <button onclick="nextPage(document.getElementById('page-courante'))"> Next page </button>

            <div class="vis-pages">
                <span> Page: </span>
                <span id="page-courante"></span>
                <span > / </span>
                <span id="nb-page"></span>
            </div>
        </div>
        <table id="tabFR" style="width: 100%;"></table>

        </div>
        <script type="text/javascript" src="./assets/tablefilter/tablefilter.js"></script>
        <script type="text/javascript" src="./assets/js/coursTableFilterRenderingFR.js"></script>
    <?php } else { ?>
        <title>Search for a course</title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php require_once('utils/header.php') ?>

        <div class="table-nav" style="display: flex; flex-direction: row; justify-content: space-between; margin: 2px 0 2px 0;">
            <span> Number of courses : <span id="nb-courses"></span></span>
            <button onclick="previousPage(document.getElementById('current-page'))"> Previous </button>

            <button onclick="nextPage(document.getElementById('current-page'))"> Next </button>

            <div class="vis-pages">
                <span> Page: </span>
                <span id="current-page"></span>
                <span > / </span>
                <span id="nb-pages"></span>
            </div>
        </div>
        <table id="tabEN" style="width: 100%;"></table>

        <script type="text/javascript" src="./assets/tablefilter/tablefilter.js"></script>
        <script type="text/javascript" src="./assets/js/coursTableFilterRenderingEN.js"></script>
    <?php } ?>
</body>

</html>