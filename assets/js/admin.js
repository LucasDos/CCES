var fileobj;
function upload_file(e) {
    e.preventDefault();
    ajax_file_upload(e.dataTransfer.files);
}

function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function () {
        files = document.getElementById('selectfile').files;
        ajax_file_upload(files);
        document.getElementById("importedFiles").innerHTML = " <div class='spinner-border text-primary' role='status'><span class='visually-hidden'>Chargement...</span></div>"
    };
}

function ajax_file_upload(file_obj) {
    if (file_obj != undefined) {
        var form_data = new FormData();
        for (i = 0; i < file_obj.length; i++) {
            form_data.append('file[]', file_obj[i]);
        }
        $.ajax({
            type: 'POST',
            url: 'functions/ajax.php',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                document.getElementById("importedFiles").innerHTML = response;
                $('#selectfile').val('');
            }
        });
    }
}

function clearFiles() {
    $.ajax({
        type: 'POST',
        url: 'functions/ClearFiles.php',
        contentType: false,
        processData: false,
        success: function () {
            document.getElementById("importedFiles").innerHTML = "";
        }
    });
}

function mergeCSV() {
    $.ajax({
        type: 'POST',
        url: 'functions/MergeCSV.php',
        contentType: false,
        processData: false
    });
}

function moveMergedFile() {
    $.ajax({
        type: 'POST',
        url: 'functions/MoveMergedFile.php',
        contentType: false,
        processData: false
    });
}