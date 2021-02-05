<?php
    define('currentURL', $_SERVER['PHP_SELF'], true);

    // Get current page
    $currentPageURL = explode('.php', currentURL);
    $currentPageURL = explode('/', $currentPageURL[0]);
    $currentPage = end($currentPageURL)

?>

<?php switch ($currentPage) {
    case "Accueil":
?>
    <nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0em;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="Depot.php"><span class="glyphicon glyphicon-home"></span> Depot </a></li>
                <li><a href="Cours.php"> <span class="glyphicon glyphicon-search"></span> Cours </a></li>
                <li><a href="?language=FR"><img alt="Français" title="Français" src="/CCES/utils/images/french-flag.svg" style="width: 20px;"></a></li>
                <li><a href="?language=EN"><img alt="English" title="English" src="/CCES/utils/images/english-flag.svg" style="width: 20px;"></a></li>
            </ul>

            <div class="form-group navbar-right navbar-form">
                <?php if (isset($_SESSION["authentificationSuccess"]) && $_SESSION["authentificationSuccess"]) { ?>
                    <button type="submit" onclick="self.location='./Depot.php'" class="btn btn-info"><span class="glyphicon glyphicon-lock"></span></button>
                <?php } else { ?>
                    <button type="submit" onclick="self.location='./Authentification.php'" class="btn btn-info"><span class="glyphicon glyphicon-lock"></span></button>
                <?php } ?>
            </div>

        </div>
    </nav>

<?php
        break;
    case "modifierAccueil":
?>
    <nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0em;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="./index.php"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="./Depot.php"><span class="glyphicon glyphicon-edit"></span> Zone de dépot </a></li></ul>
        </div>
    </nav>

<?php
        break;
    case "Authentification":
?>
    <nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0em;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li> <a href="Accueil.php"><span class="glyphicon glyphicon-home"></span></a> </li>
                <div class="navbar-collapse collapse"></div>

        </div>
    </nav>
<?php
        break;
    case "VisualisationMAJ":
?>
    <nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0em;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="Depot.php"><span class="glyphicon glyphicon-home"></span> Depot </a></li>
                <li><a href="Cours.php"> <span class="glyphicon glyphicon-search"></span> Cours </a></li>
                <li><a href="?language=FR"><img alt="Français" title="Français" src="/CCES/utils/images/french-flag.svg" style="width: 20px;"></a></li>
                <li><a href="?language=EN"><img alt="English" title="English" src="/CCES/utils/images/english-flag.svg" style="width: 20px;"></a></li>
            </ul>
            <div class="form-group navbar-right navbar-form">
                <button type="submit" onclick="goCoursPage()" class="btn btn-info" target="_blank"> Vue étudiante actuelle </button>
            </div>
        </div>
    </nav>
<?php
        break;
    case "Cours":
?>
    <nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0em;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="Depot.php"><span class="glyphicon glyphicon-home"></span> Depot </a></li>
                <li><a href="Cours.php"> <span class="glyphicon glyphicon-search"></span> Cours </a></li>
                <li><a href="?language=FR"><img alt="Français" title="Français" src="/CCES/utils/images/french-flag.svg" style="width: 20px;"></a></li>
                <li><a href="?language=EN"><img alt="English" title="English" src="/CCES/utils/images/english-flag.svg" style="width: 20px;"></a></li>
            </ul>

            <div class="navbar-collapse collapse">
                <div class="form-group navbar-right navbar-form">
                    <a class="dropdown-toggle" data-toggle="collapse" data-target="#myList"><span class="glyphicon glyphicon-briefcase" style="color:white;font-size:35px" id="basket" onclick="stopAnimation()"></span></a>

                    <div id="myList" class="dropdown-menu">
                        <nav class="navbar navbar-light">
                            <li class="nav-item">
                                <span class="navbar-brand">Votre Panier</span>
                                <span class="navbar-text"> Total ECTS <span class="badge badge-light" id="basket-ECTS"></span></span>
                            </li>
                        </nav>

                        <div id="basket-content"></div>
                            <div align="center">
                                <button onClick="emptyBasket();" class="btn btn-primary btn-sm">Vider</button>
                                <button onClick="exportBasket();" class="btn btn-primary btn-sm">Exporter</button>
                                <a class="dropdown-toggle" data-toggle="collapse" data-target="#myList"><button class="btn btn-primary btn-sm">Fermer</button></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<?php
        break;
    case "Depot":
?>
    <nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0em;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="./index.php"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="./modifierAccueil.php"><span class="glyphicon glyphicon-edit"></span> Modifier Page d'accueil </a></li>
                <li><a href="./logs.php"><span class="glyphicon glyphicon-search"></span> Statistiques </a></li>
            </ul>
        </div>
    </nav>
<?php
        break;
?>


    <?php }
?>