
// bar chartjs initialization

$(function () {
    "use strict";

    var ctx = document.getElementById('bar-chart-js').getContext('2d');

    var myBarChart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales Data",
                data: [45, 65, 95, 69, 65, 92, 55, 78, 67, 61, 83, 85],
                backgroundColor: '#3da5f4',
                borderColor: '#3da5f4',
                pointBorderColor: '#ffffff',
                pointBackgroundColor: '#3da5f4',
                pointBorderWidth: 2,
                pointRadius: 4

            }, {
                label: "Cost Rate",
                data: [78, 47, 29, 59, 66, 86, 78, 59, 90, 39, 62, 58],
                backgroundColor: '#e5e8eb',
                borderColor: '#e5e8eb',
                pointBorderColor: '#ffffff',
                pointBackgroundColor: '#e5e8eb',
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
                yAxes: [{gridLines: {display: !1}, stacked: !1, ticks: {stepSize: 20}}],
                xAxes: [{
                    barPercentage: .7,
                    categoryPercentage: .5,
                    stacked: !1,
                    gridLines: {color: "rgba(0,0,0,0.01)"}
                }]
            },
            elements: {
                line: {
                    tension: 0.00001,
//              tension: 0.4,
                    borderWidth: 1
                },
                point: {
                    radius: 2,
                    hitRadius: 10,
                    hoverRadius: 3,
                    borderWidth: 2
                }
            }
        }
    });


});


