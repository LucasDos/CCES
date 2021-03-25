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
    exportCSV().then(res => {
        formatData(res);
        //define the heading for each row of the data
        // var heads = "";
        //
        // var csv = 'Lucas, TEST DES TRUCS\n';
        //
        // //merge the data with CSV
        // res.forEach(function(row) {
        //     csv += row.join(';');
        //     csv += "\n";
        // });
        //
        // //display the created CSV data on the web browser
        // document.write(csv);
        //
        // var hiddenElement = document.createElement('a');
        // hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
        // hiddenElement.target = '_blank';
        //
        // //provide the name for the CSV file to be downloaded
        // hiddenElement.download = 'Famous Personalities.csv';
        // hiddenElement.click();
    })
}

function formatData(data) {
    let formattedData = data.replace("[", "");
    console.log(formattedData);
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