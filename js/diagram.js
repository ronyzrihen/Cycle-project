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