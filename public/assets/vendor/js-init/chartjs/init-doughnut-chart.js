
// chartjs initialization

$(function () {
    "use strict";


// doughnut_chart

    var ctx = document.getElementById("doughnut_chart");
    var data = {
        labels: [
            "Reopen", "Declain", "Pending", "Solved "
        ],
        datasets: [{
            data: [40, 10, 10, 40],
            backgroundColor: [
                "#3da5f4",
                "#fab63f",
                "#18b9d4",
                "#626be3"
            ],
            borderWidth: [
                "0px",
                "0px",
                "0px",
                "0px"
            ],
            borderColor: [
                "#3da5f4",
                "#fab63f",
                "#18b9d4",
                "#626be3"
            ]
        }]
    };

    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            legend: {
                display: false
            }
        }
    });


});


