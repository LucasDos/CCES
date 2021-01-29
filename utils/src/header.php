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
            <li> <a href="Depot.php"><span class="glyphicon glyphicon-home"></span> Depot</a> </li>
            <li>
                <a href="Cours.php">
                    <span class="glyphicon glyphicon-search"></span> Cours
                </a>
            </li>
            <li> <a href="?language=FR"> <img src="/utils/images/french-flag.svg"> </a> </li>
            <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Langue <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="?language=FR">Français</a></li>
                    <li><a href="?language=EN">Anglais</a></li>
                </ul>
            </li>-->
        </ul>
        <div class="form-group navbar-right navbar-form">
            <button type="submit" onclick="goCoursPage()" class="btn btn-info" target="_blank">Vue étudiante actuelle</button>
        </div>
    </div>
</nav>