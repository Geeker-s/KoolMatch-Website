
// vmap initialization

$(function () {
    "use strict";

    //usa map

    $('#usa_map').vectorMap({
        map: 'us_aea',
        focusOn: {
            x: 5,
            y: 1,
            scale: 1
        },
        zoomOnScroll: false,
        zoomMin: 0.65,
        hoverColor: false,

        regionStyle: {
            initial: {
                fill: '#aed9f9',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
            },
            hover: {
                fill: '#5db7f9'
            }
        },
        series: {
            regions: [{
                values: {
                    'US-CA': '#b756ff',
                    'US-WA': '#328dff',
                    'US-TX': '#6568ff'
                },
                attribute: 'fill'
            }]
        },

            backgroundColor: '#ffffff'

    });


});

