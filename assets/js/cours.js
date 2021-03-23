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