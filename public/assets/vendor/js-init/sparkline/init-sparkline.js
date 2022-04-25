
// sparkline initialization

$(function () {
    "use strict";

    var Script = function () {
        $(".sparkline").each(function(){
            var $data = $(this).data();

            $data.valueSpots = {'0:': $data.spotColor};

            $(this).sparkline( $data.data || "html", $data,
                {
                    tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
                    '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
                });
        });


        // unique visitors

        $("#unique_visitors").sparkline([102,109,90,120,70,99,110,80,87,50,65,114], {
            type: 'bar',
            height: '20',
            barWidth: 2,
            barSpacing: 3,
            barColor: '#ffffff'
        });

        // total visitors

        $("#total_visitors").sparkline([102,109,90,120,110,99,110,80,87,65,74], {
            type: 'bar',
            height: '20',
            barWidth: 2,
            barSpacing: 3,
            barColor: '#ffffff'
        });


        // Customized line 1

        $('#custom_line_1').sparkline('html', {
            height: '25px',
            width: '200px',
            lineColor: '#e5d1e4',
            fillColor: '#f3e8f2',
            minSpotColor: true,
            maxSpotColor: true,
            spotColor: '#e2a8df',
            spotRadius: 1
        });

        // Customized line 2

        $('#custom_line_2').sparkline('html', {
            height: '25px',
            width: '200px',
            lineColor: '#ecd1a4',
            fillColor: '#f9f0e0',
            minSpotColor: true,
            maxSpotColor: true,
            spotColor: '#ecd1a4',
            spotRadius: 1
        });
        // Customized line 3

        $('#custom_line_3').sparkline('html', {
            height: '25px',
            width: '200px',
            lineColor: '#939fff',
            fillColor: '#e3e6ff',
            minSpotColor: true,
            maxSpotColor: true,
            spotColor: '#939fff',
            spotRadius: 1
        });


        // active users

        $("#active_users").sparkline([80,109,170,99,110,80,87,74,102,109,120,99,110,80,87,74], {
            type: 'bar',
            height: '100',
            barWidth: 9,
            barSpacing: 10,
            barColor: 'rgba(255,255,255,.3)'
        });


        // bar widget

        $("#bar_widget").sparkline([79,110,80,102,109,120,87,74,99,110,80,102,109,120,87,74], {
            type: 'bar',
            height: '130',
            barWidth: 12,
            barSpacing: 8,
            barColor: '#31c3b2'
        });



    }();


});

