window.onload = function() {
    let formElement = document.getElementById("btnform");
    if (formElement) {
        formElement.onclick = function() { checkform(); }
    }
    let editBtn = document.getElementById("edit");
    if (editBtn) {
        editBtn.onclick = function() {

            editAction("bi bi-pencil-square replaceable_icon")
            editBtn.style.color = "red";
        };
    }
    let deleteBtn = document.getElementById("delete");
    if (deleteBtn) {
        deleteBtn.onclick = function() {

            deleteBtn.style.color = "red";
            deleteAction("bi bi-x-circle replaceable_icon")
        };
    }
}


function editAction(aClass) {
    let instances = document.getElementsByClassName("instance");
    for (let i = 0; i < instances.length; i++) {
        instances[i].querySelector(".replaceable_icon").className = aClass;
        ref = instances[i].querySelector("a");
        ref.onclick = function(e) {
            e.preventDefault();
            location.replace("cycle-form" + ref.getAttribute('href').slice(9));
        };
    }
}

function deleteAction(aClass) {
    let instances = document.getElementsByClassName("instance");
    for (let i = 0; i < instances.length; i++) {
        instances[i].querySelector(".replaceable_icon").className = aClass;
        instances[i].querySelector("a").onclick = function(e) {
            e.preventDefault();
            location.replace("save_milestone" + instances[i].querySelector("a").getAttribute('href').slice(9) + "&del=1");
        };
    }
}

function checkform() {
    let flag = 0;
    let aform = document.querySelector("form");
    let name = document.querySelector("#milestoneName");
    let bottles = document.querySelector("#numOfPlastics");
    let cans = document.querySelector("#numOfCans");
    let boxes = document.querySelector("#numOfBoxes");
    let date = aform.querySelector('#endDate');

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


    if (date.value != "" && !date.classList.contains('is-valid')) {
        date.classList.add('is-valid');
    }

    if (flag == 1) {
        event.preventDefault();
    }


};






function diagram(yValues) {
    var xValues = ["Finished", "Did not finish", "Did not participated"];
    var barColors = [
        "#62c462",
        "#46a546",
        "#468847"
    ];

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Students statistics"
            }
        }
    });
}


document.addEventListener('DOMContentLoaded', () => {
    const icons = document.querySelectorAll('.icon-list i');
    icons.forEach((icon, index) => {
        icon.classList.add('move-' + (index + 1));
    });
});