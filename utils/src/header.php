<?php $isLog = ($_SESSION["authentificationSuccess"] == true) ? "" : "hidden"; ?>

<script>
    function logOut() {
        <?php
            $_SESSION["authentificationSuccess"] = false;
        ?>

        window.location.reload();
    }
</script>


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
            <button type="submit" onclick="goCoursPage()" class="btn btn-info" target="_blank">Vue étudiante actuelle</button>
            <button type="button" class="btn btn-info <?php $isLog ?>" onclick="logOut()"><span class="glyphicon glyphicon-off"></span></button>
        </div>
    </div>
</nav>