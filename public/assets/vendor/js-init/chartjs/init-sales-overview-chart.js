
// chartjs initialization

$(function () {
    "use strict";

    // sales_overview_chart

    var ctx = document.getElementById('sales_overview_chart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['A', 'B', 'C', 'D', 'E', 'F'],
            datasets: [{
                label: "Sales Overview 1",
                type: 'line',
                data: [0, 22, 4, 25, 8, 5, 18],
                fill: true,
                backgroundColor: 'rgba(98,107,227,.2)',
                borderColor: '#626be3',
                pointBorderColor: '#626be3',
                pointBackgroundColor: '#fff',
                pointBorderWidth: 0,

                borderWidth: 1,
                borderJoinStyle: 'miter',
                // pointHoverRadius: 2,
                pointHoverBackgroundColor: '#626be3',
                pointHoverBorderColor: '#626be3',
                pointHoverBorderWidth: 1,
                pointRadius: 3

            }, {
                label: "Sales Overview 2",
                type: 'line',
                data: [17, 7, 58, 4, 24, 5, 10],
                fill: true,
                // borderDash: [5, 5],
                backgroundColor: 'rgba(61,165,244,.3)',
                borderColor: '#3da5f4',
                pointBorderColor: '#3da5f4',
                pointBackgroundColor: '#3da5f4',
                pointBorderWidth: 0,

                borderWidth: 1,
                borderJoinStyle: 'miter',
                pointHoverBackgroundColor: '#3da5f4',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 1,
                pointRadius: 3
            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            legend: {
                display: true
            },

            scales: {
                xAxes: [{
                    display: true
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        zeroLineColor: '#f1f3f5',
                        color: '#f1f3f5',
                        //drawBorder: false
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
                    hoverRadius: 6,
                    borderWidth: 4
                }
            }
        }
    });

});


