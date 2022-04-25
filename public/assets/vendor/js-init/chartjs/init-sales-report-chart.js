
// chartjs initialization

$(function () {
    "use strict";

    // sales_report_chart

    var ctx = document.getElementById('sales_report_chart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            // labels: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K','L','M','N','O'],
            labels: ['M', 'O', 'S', 'A', 'D', 'D', 'E', 'K', 'H', 'O','S','S','A','I','N'],
            datasets: [{
                label: "Sales Overview 1",
                type: 'line',
                // data: [34, 46, 76, 50, 37, 45, 70, 40, 50, 30],
                data: [0, 10, 50, 0, 10, 0, 12, 0, 20, 1, 0, 10, 0,2, 0],
                fill: true,
                backgroundColor: 'rgba(122,134,255,.5)',
                borderColor: '#626be3',
                pointBorderColor: '#626be3',
                pointBackgroundColor: '#626be3',
                pointBorderWidth: 2,
                borderWidth: 1,
                borderJoinStyle: 'miter',
                pointHoverBackgroundColor: '#7a86ff',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 1,
                pointRadius: 0

            }, {
                label: "Sales Overview 2",
                type: 'line',
                // data: [70, 65, 125, 70, 90, 60, 110, 60,81,72],
                data: [0, 20, 10, 5, 40, 10, 76, 15, 25, 10, 23, 6, 2, 0, 0],
                fill: true,
                //borderDash: [5, 5],
                backgroundColor: 'rgba(24,185,212,.5)',
                borderColor: '#18b9d4',
                pointBorderColor: '#18b9d4',
                pointBackgroundColor: '#18b9d4',
                pointBorderWidth: 2,
                borderWidth: 1,
                borderJoinStyle: 'miter',
                pointHoverBackgroundColor: '#18b9d4',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 1,
                pointRadius: 0
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
                    display: true,
                    gridLines: {
                        zeroLineColor: '#e7ecf0',
                        color: '#e7ecf0',
                        borderDash: [5,5,5],
                        zeroLineBorderDash: [5,5,5],
                        drawBorder: false
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        zeroLineColor: '#e7ecf0',
                        color: '#e7ecf0',
                        borderDash: [5,5,5],
                        zeroLineBorderDash: [5,5,5],
                        drawBorder: false
                    }
                }]

            },
            elements: {
                line: {
                    //tension: 0.00001,
                    tension: 0.4,
                    borderWidth: 1
                },
                point: {
                    radius: 2,
                    hitRadius: 10,
                    hoverRadius: 3,
                    borderWidth: 4
                }
            }
        }
    });


});


