
// flot initialization

$(function () {
    "use strict";


    var data = [{
        label: 'Bar 1', // green
        data: [
            [600, 1],
            [380, 2],
            [750, 3],
            [700, 4]
        ]
    }, {
        label: 'Bar 2', // blue
        data: [
            [440, 1],
            [260, 2],
            [440, 3],
            [450, 4]
        ]
    }, {
        label: 'Bar 3', // yellow
        data: [
            [280, 1],
            [160, 2],
            [300, 3],
            [180, 4]
        ]
    }, ];

    var options = {
        series: {
            stack: 1,
            bars: {
                order: 1,
                show: 1,
                barWidth: 0.05,
                fill: 0.8,
                align: 'center',
                horizontal: true
            }
        },
        grid: {
            hoverable: true,
            borderWidth: 1,
            tickColor: "#e8f1fb",
            borderColor: "#fff"
        },
            colors: ["#626be3", "#5ddcff", "#26c11d"],
        tooltip: true,
        tooltipOpts: {
            cssClass: "flotTip",
            content: "%s: %y",
            defaultTheme: false
        },
        legend: {
            show: false
        },
        xaxis: {
//                ticks: [] // hide xaxis grid bar with value
        },
        yaxis: {
            ticks: [
                [1, 'Data 1'],
                [2, 'Data 2'],
                [3, 'Data 3'],
                [4, 'Data 4']
            ]
        }
    };

    $.plot($("#hbar-placeholder"), data, options);


});

