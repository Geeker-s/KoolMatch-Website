$(function () {
    "use strict";

    var ctx = document.getElementById('mixed_chart').getContext('2d');

    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["Item 1", "Item 2", "Item 3", "Item 4", "Item 5", "Item 6", "Item 7", "Item 8", "Item 9", "Item 10", "Item 11", "Item 12"],
            datasets: [{
                label: "My First dataset",
                data: [40, 90, 210, 160, 230, 140, 190, 210, 160, 230, 55, 70],
                backgroundColor: 'rgba(0,0,0,.2)',
                borderColor: '#626bcc',
                pointBorderColor: '#ffffff',
                pointBackgroundColor: '#626bcc',
                hoverBackgroundColor: 'rgba(0,0,0,.5)',
                pointBorderWidth: 2,
                pointRadius: 4

            } , {

                type: 'line',  // override the default type
                data: [160, 150, 350, 300, 380, 180, 210, 290, 190, 280, 165, 140],
                backgroundColor: 'rgba(255,255,255,0)',
                borderColor: 'rgba(255,255,255,.3)',
                pointBorderColor: 'rgba(255,255,255,.4)',
                pointBackgroundColor: 'rgba(255,255,255,1)',
                pointBorderWidth: 1,
                pointRadius: 3
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
                    display: false,
                    barThickness : 10

                }],
                yAxes: [{
                    display: false
                }]

            },
            elements: {
                line: {
                    tension: 0.00001,
                    //  tension: 0.4,
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