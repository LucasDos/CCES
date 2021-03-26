var fileobj;
function upload_file(e) {
    e.preventDefault();
    ajax_file_upload(e.dataTransfer.files);
}

function exportCSV() {
    // $.ajax({
    //     url: './MergedFile.csv',
    //     dataType: 'text',
    // }).done(successFunction);
    return $.ajax({
        url: 'functions/exportCSV.php',
        type: 'GET',
    });


}

function downloadCSV() {
    return $.ajax({
        url: '/CCES/MergedFile.csv',
        type: 'POST',
        success: function (data) {
            // console.log(data);
            let formmatedData = formatData(data);
            var downloadLink = document.createElement("a");
            var fileData = ['\ufeff' + formmatedData];

            var blobObject = new Blob(fileData,{
                type: "text/csv;charset=utf-8;"
            });

            var url = URL.createObjectURL(blobObject);
            downloadLink.href = url;
            downloadLink.download = "AllCourses.csv";

            /*
             * Actually download CSV
             */
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    });
}

function formatData(data) {
    let removeSimpleQuote = data.replace(/'/g, "");
    let removeDoubleQuote = removeSimpleQuote.replace(/"/g, "");
    let removeEqual = removeDoubleQuote.replace(/-/g, "");
    let changeBlank = removeEqual.replace(/;;/g, "; Aucunes informations...");

    return changeBlank;
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