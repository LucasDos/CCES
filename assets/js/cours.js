/** Load Data Course */
window.onload = loadData("1");

// function init() {
//     $.ajax({
//         url: './functions/infosCourses.php',
//         type: 'post',
//         success: function (data) {
//             let cours = parseInt(data);
//
//             // Nb Cours
//             document.getElementById("nb-cours").innerHTML += cours;
//
//             // Nb Pages
//             document.getElementById("nb-page").innerHTML = Math.ceil(cours/50);
//
//         }
//     });
//
//     loadData("0");
// }

function previousPage() {
    let currentPage = document.getElementById("current-page").innerText;
    currentPage--;
    if(currentPage > 0){
        loadData(currentPage.toString());
    }

}

function nextPage() {
    let currentPage = document.getElementById("current-page").innerText;
    currentPage++;
    if(currentPage <= parseInt(document.getElementById("nb-page").innerText)){
        loadData(currentPage.toString());
    }

}

function loadData(page){
    $.ajax({
        url: './functions/loadData.php',
        data: {
            page : page
        },
        type: 'post',
        success: function (data) {
            let parsedData = getNbPage(data);
            let nbCourses = parseInt(parsedData[0]);
            let tab = parsedData[1];

            // Nb Cours
            document.getElementById("nb-cours").innerHTML = nbCourses;

            // Nb Pages
            document.getElementById("nb-page").innerHTML = Math.ceil(nbCourses/50);

            // Load tab
            document.getElementById("test").innerHTML = tab;
            document.getElementById("current-page").innerHTML = page;
            var tf = new TableFilter('test', filtersConfig);
            tf.init();

        }
    });
}

function getNbPage(data) {
    let nbCourses = data.split("<", 1);
    let cleanData = data.replace(nbCourses, "");

    return [nbCourses, cleanData];
}


/** Student */
function computeECTS() {
    $.ajax({
        url: './functions/basket.php',
        data: {
            action: 'getECTS'
        },
        type: 'post',
        success: function (data) {
            $("#basket-ECTS").html(data);
        }
    });
}

function addCourse(id, courseID, courseECTS, courseTitle, courseSemester, faculty, degree) {
    $.ajax({
        url: './functions/basket.php',
        data: {
            action: 'addCourse',
            id: id,
            codeCourse: courseID,
            courseECTS: courseECTS,
            courseTitle: courseTitle,
            courseSemester: courseSemester,
            faculty: faculty,
            degree: degree
        },
        type: 'post',
        success: function (data) {
            $("#basket-content").html(data);
            computeECTS();
            setDisabledButtons();
        }
    });
}

function removeCourse(id) {
    $.ajax({
        url: './functions/basket.php',
        data: {
            action: 'removeCourse',
            id: id
        },
        type: 'post',
        success: function (data) {
            $("#basket-content").html(data);
            computeECTS();
        }
    });
}

function echoBasket() {
    $.ajax({
        url: './functions/basket.php',
        data: {
            action: 'getBasket'
        },
        type: 'post',
        success: function (data) {
            $("#basket-content").html(data);
            computeECTS();
            setDisabledButtons();
        }
    });

}

function emptyBasket() {
    $.ajax({
        url: './functions/basket.php',
        data: {
            action: 'emptyBasket'
        },
        type: 'post',
        success: function (data) {
            $("#basket-content").html(data);
            computeECTS();
            resetDisabledButtons();
        }
    });
}

function exportBasket() {
    $.ajax({
        url: './functions/basket.php',
        data: {
            action: 'exportExcel'
        },
        type: 'post',
        success: function (data) {
            fetch('./functions/panier_export.xlsx').then(function (t) {
                return t.blob().then((b) => {
                    var a = document.createElement("a");
                    a.href = URL.createObjectURL(b);
                    a.setAttribute("download", "panier_export.xlsx");
                    a.click();
                });
            });
        }
    });
}

function enableButton(id) {
    document.getElementById(id).disabled = false;
}

function resetDisabledButtons() {
    var courseTable = document.getElementById("courseTable");
    for (var i = 2, row; row = courseTable.rows[i]; i++) {
        button = row.cells[10].firstChild;
        button.disabled = false;
    }
}

function setDisabledButtons() {
    $.ajax({
        url: './functions/basket.php',
        data: {
            action: 'getDisabledButtons'
        },
        type: 'post',
        success: function (data) {
            buttonsIDs = JSON.parse(data);
            for (var i = 0; i < buttonsIDs.length; i++) {
                id = parseInt(buttonsIDs[i]);
                if (document.getElementById(id).disabled !== true) {
                    document.getElementById(id).disabled = true;
                }
            }
        }
    });
}

function startAnimation() {
    var element = document.getElementById('basket');
    element.classList.remove("animate");
    void element.offsetWidth;
    element.classList.add("animate")
    element.style.animation = 'animation 4s';

}

function stopAnimation() {
    document.getElementById('basket').style.animation = "none";
    document.getElementById('basket').style.opacity = 1;

}