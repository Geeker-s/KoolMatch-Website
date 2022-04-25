
// c3 initialization

$(function () {
    "use strict";

    var chart = c3.generate({
        bindto: '#d_profit',
        data: {
            columns: [
                ['Data A', 33],
                ['Data B', 33],
                ['Data C', 33]
            ],

            type : 'donut',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        },
        donut: {
            label: {
                show: false
            },
            title:"Profit",
            width:5
        },

        legend: {
            hide: true
            //or hide: 'data1'
            //or hide: ['data1', 'data2']
        },
        color: {
            pattern: ['#fec364', '#706cc7', '#2fc5d9']
        }
    });

});
