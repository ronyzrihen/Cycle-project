window.onload = function() {
    let formElement = document.getElementById("btnform");
    if (formElement) {
        formElement.onclick = function() { checkform(); }
    }
}

function checkform() {
    let flag = 0;
    let galleryRadio = document.querySelectorAll("#gallery input");
    let name = document.querySelector("#Name");
    let bottles = document.querySelector("#numOfPlastics");
    let cans = document.querySelector("#numOfCans");
    let boxes = document.querySelector("#numOfBoxes");
    let date = document.querySelector('#endDate');
    let radioFlag = 0;

    for (let i = 0; i < galleryRadio.length; i++) {
        if (galleryRadio[i].checked) {
            radioFlag = 1;
        }
    }
    if (!radioFlag) {
        flag = 1;
        let indicator = document.getElementById("badgeIndicator");
        if (indicator.classList.contains("d-none")) {
            indicator.classList.remove("d-none");
        }
    }

    if (name.value == "") {
        if (!name.classList.contains('is-invalid'))
            name.classList.add('is-invalid');
        flag = 1;
    } else {
        if (name.classList.contains('is-invalid'))
            name.classList.remove('is-invalid');

        if (!name.classList.contains('is-valid'))
            name.classList.add('is-valid');
    }

    if (bottles.value == 0 && cans.value == 0 && boxes.value == 0) {




        if (!bottles.classList.contains('is-invalid'))
            bottles.classList.add('is-invalid');

        if (!cans.classList.contains('is-invalid'))
            cans.classList.add('is-invalid');

        if (!boxes.classList.contains('is-invalid'))
            boxes.classList.add('is-invalid');

        flag = 1;
    } else {

        if (bottles.classList.contains('is-valid'))
            bottles.classList.remove('is-valid');

        if (!bottles.classList.contains('is-valid'))
            bottles.classList.add('is-valid');

        if (cans.classList.contains('is-valid'))
            cans.classList.remove('is-valid');

        if (!cans.classList.contains('is-valid'))
            cans.classList.add('is-valid');

        if (boxes.classList.contains('is-valid'))
            boxes.classList.remove('is-valid');
    }
    if (!boxes.classList.contains('is-valid'))
        boxes.classList.add('is-valid');

    if (date) {

        if (date.value != "" && !date.classList.contains('is-valid')) {
            date.classList.add('is-valid');
        }
    }

    if (flag == 1) {
        event.preventDefault();
    }


};


///////////////////////////////////////////////////////////////////////////////////////
function galleryCheck() {

    let photo = document.querySelectorAll('#gallery>label');



}