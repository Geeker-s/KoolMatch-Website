
// vmap initialization

$(function () {
    "use strict";

    var cityAreaData = [
        500.70,
        410.16,
        210.69,
        120.17,
        64.31,
        150.35,
        130.22,
        120.71,
        300.32
    ]

    $('#world-map').vectorMap({
        map: 'world_mill_en',
        scaleColors: ['#C8EEFF', '#0071A4'],
        normalizeFunction: 'polynomial',
        focusOn: {
            x: 5,
            y: 1,
            scale:.95
        },
        zoomOnScroll: false,
        zoomMin: 0.65,
        hoverColor: false,
        regionStyle: {
            initial: {
                fill: '#e5e5e5',
                "fill-opacity": 1,
                stroke: '#dddddd',
                "stroke-width": 0,
                "stroke-opacity": 0
            },
            hover: {
                "fill-opacity": 0.6
            }
        },

        backgroundColor: '#ffffff',

        markers: [
            { latLng: [54.525961, 15.255119], name: 'Europe', style: {r: 20, fill:'rgba(64, 203,191, .5)', stroke: '#68aca6'}},
            { latLng: [-25.274398, 133.775136], name: 'Australia', style: {r: 12, fill:'rgba(255,196,91,.3)', stroke: '#f4bf7f'}},
            { latLng: [-4.442038, -61.326854], name: 'Latin America', style: {r: 15, fill:'rgba(122,134,255, .3)', stroke: '#4c58d4'}}
        ],

        markerStyle: {
            hover: { stroke: 'rgba(0,0,0,.05)', "stroke-width": 20, cursor: 'pointer'}
        }

    });


});

