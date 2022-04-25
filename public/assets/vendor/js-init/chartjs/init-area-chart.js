
// chartjs initialization

$(function () {
    "use strict";

// area_chart

    var ctx = document.getElementById('area_chart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Item 1", "Item 2", "Item 3", "Item 4", "Item 5", "Item 6", "Item 7"],
            datasets: [{
                label: "My First dataset",
                backgroundColor: 'rgba(86,187,255,.05)',
                borderColor: '#56bbff',
                pointBackgroundColor: "#ffffff",
                pointRadius: 3,
                data: [52, 30, 70, 40, 180, 90,60]
            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            scales: {
                xAxes: [{
                    display: false
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        zeroLineColor: '#fff',
                        color: '#fff',
                        borderDash: [2,2,2],
                        zeroLineBorderDash: [2,2,2],
                        drawBorder: false
                    }
                }]

            },
            elements: {
                line: {
                    // tension: 0.00001,
             tension: 0.6,
                    borderWidth: 1
                },
                point: {
                    radius: 5,
                    hitRadius: 10,
                    hoverRadius: 4,
                    borderWidth: 1
                }
            }
        }
    });

});


