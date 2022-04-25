//bubble chart init

$(window).on("load", function(){

    var ctx = $("#bubble_chart");

    var randomScalingFactor = function() {
        return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
    };

    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                display: false,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: false,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        },
        title:{
            display:false,
            text:'Chart.js Bubble Chart'
        }
    };

    // Chart Data
    var chartData = {
        animation: {
            duration: 10000
        },
        datasets: [{
            label: "Test 1",
            backgroundColor: "#5eb5ef",
            borderColor: "rgba(255,255,255,.0)",
            data: [
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
            ]
        }, {
            label: "Test 2",
            backgroundColor: "#ff829d",
            borderColor: "rgba(255,255,255,.0)",
            data: [
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
            ]
        },{
            label: "Test 3",
            backgroundColor: "#ffd778",
            borderColor: "rgba(255,255,255,.0)",
            data: [
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
            ]
        }, {
            label: "Test 4",
            backgroundColor: "#6fcdcd",
            borderColor: "rgba(255,255,255,.0)",
            data: [
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
            ]
        },{
            label: "Test 5",
            backgroundColor: "#ecedf1",
            borderColor: "rgba(255,255,255,.0)",
            data: [
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
                { x: randomScalingFactor(), y: randomScalingFactor(), r: Math.abs(randomScalingFactor()) / 5},
            ]
        }]
    };

    var config = {
        type: 'bubble',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var bubbleChart = new Chart(ctx, config);

    // Randomize bubble chart data
    window.setInterval(function(){
        var zero = Math.random() < 0.2 ? true : false;
        colors = ["#5eb5ef","#ff829d","#ffd778","#6fcdcd","#5eb5ef"];
        $.each(chartData.datasets, function(i, dataset) {
            dataset.backgroundColor = colors[i];
            dataset.borderColor = colors[i];
            dataset.data = dataset.data.map(function() {
                return {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5
                };
            });
        });
        bubbleChart.update();
    },2000);
});