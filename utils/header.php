<?php
    define('currentURL', $_SERVER['PHP_SELF']);

    $test = $_SERVER['PHP_SELF'];

    // Get current page
    $currentPageURL = explode('.php', currentURL);
    $currentPageURL = explode('/', $currentPageURL[0]);
    $currentPage = end($currentPageURL);

    if (isset($_SESSION['language'])){
        $lang = $_SESSION['language'] == "FR";
    } else {
        $lang = "NO";
    }
?>

<?php if($lang == "FR" || $lang == "NO") { ?>
<div id="banniere">
    <a href="https://www.univ-tours.fr/" target="_blank"><img src="./assets/images/utfr_logo.svg" alt="Logo de l'université François Rabelais" height="83" width="118">
        <span style="margin-left: 1.2em;">CCES : Catalogue de Cours pour Etudiants d’Echanges</span></a>
</div>

<!-- Header start -->
<nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <!-- Accueil btn -->
            <span class="icon-bar"></span>

            <!-- Other btn max 4-->
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

        </button>
    </div>

    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="Accueil.php"><span class="glyphicon glyphicon-home"></a></li>

        <?php if($currentPage == "Accueil" || $currentPage == "VisualisationMAJ" || $currentPage == "Cours" ) { ?>
            <li><a href="Depot.php"><span class="glyphicon glyphicon-cloud-upload"></span> Depot </a></li>
            <li><a href="Cours.php"> <span class="glyphicon glyphicon-search"></span> Cours </a></li>
            <li><a href="?language=FR"><img alt="Français" title="Français" src="/CCES/utils/images/french-flag.svg" style="width: 20px;" onclick="changeFR()"></a></li>
            <li><a href="?language=EN"><img id="img" alt="English" title="English" src="/CCES/utils/images/english-flag.svg" style="width: 20px;"></a></li>
        </ul>

            <?php if($currentPage == "Accueil") { ?>
                <div class="form-group navbar-right navbar-form">
                    <?php if (isset($_SESSION["authentificationSuccess"]) && $_SESSION["authentificationSuccess"]) { ?>
                        <button type="submit" onclick="self.location='./Depot.php'" class="btn btn-info"><span class="glyphicon glyphicon-lock"></span></button>
                    <?php } else { ?>
                        <button type="submit" onclick="self.location='./Authentification.php'" class="btn btn-info"><span class="glyphicon glyphicon-lock"></span></button>
                    <?php } ?>
                </div>
            <?php } elseif($currentPage == "VisualisationMAJ") { ?>
                <div class="form-group navbar-right navbar-form">
                    <button type="submit" onclick="goCoursPage()" class="btn btn-info" target="_blank"> Vue étudiante actuelle </button>
                </div>
            <?php } else { ?>
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
            <?php } ?>

        <?php } elseif ($currentPage == "modifierAccueil") { ?>
            <li><a href="./Depot.php"><span class="glyphicon glyphicon-edit"></span> Zone de dépot </a></li>
        </ul>

        <?php } elseif ($currentPage == "Depot") { ?>
            <li><a href="./modifierAccueil.php"><span class="glyphicon glyphicon-edit"></span> Modifier Page d'accueil </a></li>
            <li><a href="./logs.php"><span class="glyphicon glyphicon-search"></span> Statistiques </a></li>
        </ul>
        <?php } ?>

    </div>
</nav>

<?php } else { ?>
    <div id="banniere">
        <a href="https://www.univ-tours.fr/" target="_blank"><img src="./assets/images/utfr_logo.svg" alt="Logo de l'université François Rabelais" height="83" width="118">
            <span style="margin-left: 1.2em;">CCES: Course Catalogue for Exchange Students</span></a>
    </div>

    <!-- Header start -->
    <nav class="navbar navbar-default navbar-fixed" role="navigation" style="margin-bottom: 0;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <!-- Accueil btn -->
                <span class="icon-bar"></span>

                <!-- Other btn max 4-->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="Accueil.php"><span class="glyphicon glyphicon-home"></a></li>

                <?php if($currentPage == "Accueil" || $currentPage == "VisualisationMAJ" || $currentPage == "Cours" ) { ?>
                <li><a href="Cours.php"> <span class="glyphicon glyphicon-search"></span> Courses </a></li>
                <li><a href="?language=FR"><img alt="Français" title="Français" src="/CCES/utils/images/french-flag.svg" style="width: 20px;"></a></li>
                <li><a href="?language=EN"><img alt="English" title="English" src="/CCES/utils/images/english-flag.svg" style="width: 20px;"></a></li>
            </ul>

            <?php if($currentPage == "Accueil") { ?>
                <div class="form-group navbar-right navbar-form">
                    <?php if (isset($_SESSION["authentificationSuccess"]) && $_SESSION["authentificationSuccess"]) { ?>
                        <button type="submit" onclick="self.location='./Depot.php'" class="btn btn-info"><span class="glyphicon glyphicon-lock"></span></button>
                    <?php } else { ?>
                        <button type="submit" onclick="self.location='./Authentification.php'" class="btn btn-info"><span class="glyphicon glyphicon-lock"></span></button>
                    <?php } ?>
                </div>
            <?php } elseif($currentPage == "VisualisationMAJ") { ?>
                <div class="form-group navbar-right navbar-form">
                    <button type="submit" onclick="goCoursPage()" class="btn btn-info" target="_blank"> Current student view </button>
                </div>
            <?php } else { ?>
                <div class="navbar-collapse collapse">
                    <div class="form-group navbar-right navbar-form">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#myList"><span class="glyphicon glyphicon-briefcase" style="color:white;font-size:35px" id="basket" onclick="stopAnimation()"></span></a>

                        <div id="myList" class="dropdown-menu">
                            <nav class="navbar navbar-light">
                                <li class="nav-item">
                                    <span class="navbar-brand"> Your Basket </span>
                                    <span class="navbar-text"> Total Credits <span class="badge badge-light" id="basket-ECTS"></span></span>
                                </li>
                            </nav>

                            <div id="basket-content"></div>
                            <div align="center">
                                <button onClick="emptyBasket();" class="btn btn-primary btn-sm"> Empty </button>
                                <button onClick="exportBasket();" class="btn btn-primary btn-sm"> Export </button>
                                <a class="dropdown-toggle" data-toggle="collapse" data-target="#myList"><button class="btn btn-primary btn-sm"> Close </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php } elseif ($currentPage == "modifierAccueil") { ?>
                <li><a href="./Depot.php"><span class="glyphicon glyphicon-edit"></span> Zone de dépot </a></li>
                </ul>

            <?php } elseif ($currentPage == "Depot") { ?>
                <li><a href="./modifierAccueil.php"><span class="glyphicon glyphicon-edit"></span> Modifier Page d'accueil </a></li>
                <li><a href="./logs.php"><span class="glyphicon glyphicon-search"></span> Statistiques </a></li>
                </ul>
            <?php } ?>

        </div>
    </nav>
<?php } ?>
