<!DOCTYPE html>
<?php
require_once('./functions/import.php');

if (!isset($_SESSION["authentificationSuccess"]) || isset($_SESSION["authentificationSuccess"]) && !$_SESSION["authentificationSuccess"])
    header("Location: Authentification.php");
?>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/main.css">
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
    <link rel="stylesheet" href="./assets/widgEditor/css/widgEditor.css" />
    <script src="./assets/widgEditor/scripts/widgEditor.js"></script>
    <script type="text/javascript">
        function submitEdit(language, editor) {
            $.ajax({
                url: './functions/saveHomepageEdit.php',
                data: {
                    language: language,
                    editor: editor
                },
                type: 'post',
                success: function(data) {
                    if (data == "OK") {
                        alert("Contenu modifié avec succès.")
                    } else {
                        alert("Contenu non modifié. Merci d'essayer plus tard.")
                    }
                }
            });
        }
    </script>
</head>

<body>
    <title>Zone d'édition de la page d'accueil</title>

    <!-- Nav Menu: top -->
    <?php require_once('utils/header.php') ?>

    <div id='content'>
        <form onsubmit="submitEdit(document.getElementById('language').value,document.getElementById('editor').value);" method="POST">
            <fieldset>
                <div>
                    <label for="language">
                        Langue de la page :
                    </label>
                    <select id="language" name="language">
                        <option>Français</option>
                        <option>Anglais</option>
                    </select>
                </div>
                <div>
                    <label for="editor">
                        Zone d'édition de la page d'accueil :
                    </label>
                    <textarea id="editor" name="editor" class="widgEditor nothing">Selectionner la langue puis saisir ici le texte voulu pour la page d'accueil</textarea>
                </div>
            </fieldset>
            <fieldset class="submit" align='center'>
                <input type="submit" class='btn btn-primary btn-lg'></button>
            </fieldset>
        </form>
    </div>
</body>

</html>