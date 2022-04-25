
// chartjs initialization

$(function () {
    "use strict";

//line chart

    var ctx = document.getElementById('line_chart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Item 1", "Item 2", "Item 3", "Item 4", "Item 5"],
            datasets: [{
                label: "My First dataset",
                data: [40, 90, 210, 160, 230],
                backgroundColor: 'rgba(255,255,255,0)',
                borderColor: '#626be3',
                pointBorderColor: '#ffffff',
                pointBackgroundColor: '#626be3',
                pointBorderWidth: 2,
                pointRadius: 4

            }, {
                label: "My Second dataset",
                data: [160, 140, 20, 270, 110],
                backgroundColor: 'rgba(255,255,255,0)',
                borderColor: '#57b9d8',
                pointBorderColor: '#ffffff',
                pointBackgroundColor: '#57b9d8',
                pointBorderWidth: 2,
                pointRadius: 4
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
                        borderDash: [5,5,5],
                        zeroLineBorderDash: [5,5,5],
                        drawBorder: false
                    }
                }]

            },
            elements: {
                line: {
                    // tension: 0.00001,
             tension: 0.4,
                    borderWidth: 1
                },
                point: {
                    radius: 2,
                    hitRadius: 10,
                    hoverRadius: 6,
                    borderWidth: 4
                }
            }
        }
    });

});


