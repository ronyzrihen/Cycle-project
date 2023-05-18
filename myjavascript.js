window.onload() = () => {

    document.getElementById("share-btn").onclick(checkform());

};

function checkform() {
    let flag = 0;
    let name = document.getElementById("milstoneName");
    let bottles = document.getElementById("bottles");
    let cans = document.getElementById("cans");
    let boxes = document.getElementById("boxes");


    if (name.value == "") {
        if (!name.classList.contains('is-invalide'))
            name.classList.add('is-invalid');
        flag = 1;
    }

    if (bottles.value == 0 && cans.value == 0 && boxes.value == 0) {
        if (!bottles.classList.contains('is-invalide'))
            bottles.classList.add('is-invalid');
       
            if (!cans.classList.contains('is-invalide'))
            cans.classList.add('is-invalid');
      
            if (!cans.classList.contains('is-invalide'))
            cans.classList.add('is-invalid');
            flag = 1;
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