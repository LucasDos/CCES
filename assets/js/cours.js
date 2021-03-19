/** Load Data Course */
window.onload = getSessionLanguage().then(res => {
    document.getElementById("language").value = res;
    loadData("1", res);
});

function getSessionLanguage() {
    let lang = "";
    return $.ajax({
        url: './functions/getLanguage.php',
        type: 'post'
    });
}

function getInputLanguage() {
    return document.getElementById("language").value;
}

function previousPage(element) {
    let currentPage = parseInt(element.innerText);
    currentPage--;
    if(currentPage > 0){
        loadData(currentPage.toString(), getInputLanguage());
    }

}

function nextPage(element) {
    let currentPage = parseInt(element.innerText);
    let lang = getInputLanguage();
    currentPage++;
    if(lang === "FR") {
        if (currentPage <= parseInt(document.getElementById("nb-page").innerText)) {
            loadData(currentPage.toString(), lang);
        }
    } else {
        if (currentPage <= parseInt(document.getElementById("nb-pages").innerText)) {
            loadData(currentPage.toString(), lang);
        }
    }
}

function loadData(page, language){
    console.log(language);
    $.ajax({
        url: './functions/loadData.php',
        data: {
            page : page,
            language : language
        },
        type: 'post',
        success: function (data) {
            let parsedData = getNbPage(data);
            let nbCourses = parseInt(parsedData[0]);
            let tab = parsedData[1];

            if(language === "FR") {
                // Nb Cours
                document.getElementById("nb-cours").innerHTML = nbCourses.toString();

                // Nb Pages
                document.getElementById("nb-page").innerHTML = Math.ceil(nbCourses / 50).toString();

                // Load tab
                document.getElementById("tabFR").innerHTML = tab;
                document.getElementById("page-courante").innerHTML = page;

                var tf = new TableFilter('tabFR', filtersConfig);
                tf.init();
            } else {
                // Nb Cours
                document.getElementById("nb-courses").innerHTML = nbCourses.toString();

                // Nb Pages
                document.getElementById("nb-pages").innerHTML = Math.ceil(nbCourses / 50).toString();

                // Load tab
                document.getElementById("tabEN").innerHTML = tab;
                document.getElementById("current-page").innerHTML = page;

                var tf = new TableFilter('tabEN', filtersConfig);
                tf.init();
            }
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