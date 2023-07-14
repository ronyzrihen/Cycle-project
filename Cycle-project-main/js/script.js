// window.onload = () => {

//     document.getElementById('formId').onsubmit(checkform);
// }

function checkform() {
    let flag = 0;
    let name = document.getElementById("milstoneName");
    let bottles = document.getElementById("numOfPlastics");
    let cans = document.getElementById("numOfCans");
    let boxes = document.getElementById("numOfBoxes");

    let date = document.getElementById('endDate');


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






function diagram() {


    var xValues = ["Finished", "Did not finish", "Did not participated"];
    var yValues = [57, 9, 23];
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
    // Get the icon elements
    const icons = document.querySelectorAll('.middle-list i');

    // Add a special class to each icon to trigger the movement
    icons.forEach((icon, index) => {
        icon.classList.add('move-' + (index + 1));
    });
});

