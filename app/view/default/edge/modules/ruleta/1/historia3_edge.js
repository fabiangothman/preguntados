/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
        js='js/',
        fonts = {
        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
        ],
        symbols = {
            "stage": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "width",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'txt',
                            type: 'image',
                            rect: ['177px', '530px', '150px', '45px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"txt.png",'0px','0px']
                        },
                        {
                            id: 'mancha',
                            type: 'image',
                            rect: ['74px', '32px', '352px', '384px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mancha.png",'0px','0px'],
                            transform: [[],['-21'],[],['0.55113','0.55113']]
                        },
                        {
                            id: 'der',
                            type: 'image',
                            rect: ['309px', '433px', '54px', '83px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"der.png",'0px','0px'],
                            transform: [[],['55']]
                        },
                        {
                            id: 'cuerpo',
                            type: 'image',
                            rect: ['180px', '475px', '143px', '223px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cuerpo.png",'0px','0px']
                        },
                        {
                            id: 'plima',
                            type: 'image',
                            rect: ['223px', '211px', '57px', '57px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"plima.png",'0px','0px'],
                            transform: [[],[],[],['0.68','0.68']]
                        },
                        {
                            id: 'cabeza',
                            type: 'image',
                            rect: ['194px', '371px', '115px', '95px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cabeza.png",'0px','0px']
                        },
                        {
                            id: 'papiro',
                            type: 'image',
                            rect: ['365px', '167px', '90px', '89px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"papiro.png",'0px','0px']
                        },
                        {
                            id: 'izq',
                            type: 'image',
                            rect: ['139px', '495px', '75px', '100px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"izq.png",'0px','0px']
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '500px', '530px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(255,255,255,0.00)"]
                        }
                    }
                },
                timeline: {
                    duration: 1750,
                    autoPlay: true,
                    data: [
                        [
                            "eid28",
                            "rotateZ",
                            660,
                            300,
                            "easeOutBack",
                            "${cabeza}",
                            '0deg',
                            '-6deg'
                        ],
                        [
                            "eid43",
                            "rotateZ",
                            960,
                            290,
                            "easeOutBack",
                            "${cabeza}",
                            '-6deg',
                            '3deg'
                        ],
                        [
                            "eid41",
                            "-webkit-transform-origin",
                            840,
                            0,
                            "linear",
                            "${izq}",
                            [50,0],
                            [50,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid641",
                            "-moz-transform-origin",
                            840,
                            0,
                            "linear",
                            "${izq}",
                            [50,0],
                            [50,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid642",
                            "-ms-transform-origin",
                            840,
                            0,
                            "linear",
                            "${izq}",
                            [50,0],
                            [50,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid643",
                            "msTransformOrigin",
                            840,
                            0,
                            "linear",
                            "${izq}",
                            [50,0],
                            [50,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid644",
                            "-o-transform-origin",
                            840,
                            0,
                            "linear",
                            "${izq}",
                            [50,0],
                            [50,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid645",
                            "transform-origin",
                            840,
                            0,
                            "linear",
                            "${izq}",
                            [50,0],
                            [50,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid10",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${izq}",
                            '495px',
                            '190px'
                        ],
                        [
                            "eid480",
                            "scaleY",
                            500,
                            410,
                            "linear",
                            "${mancha}",
                            '0.55113',
                            '1'
                        ],
                        [
                            "eid485",
                            "scaleY",
                            910,
                            340,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.8182'
                        ],
                        [
                            "eid488",
                            "scaleY",
                            1250,
                            310,
                            "easeOutBack",
                            "${mancha}",
                            '0.8182',
                            '1'
                        ],
                        [
                            "eid478",
                            "scaleX",
                            500,
                            410,
                            "linear",
                            "${mancha}",
                            '0.55113',
                            '1'
                        ],
                        [
                            "eid484",
                            "scaleX",
                            910,
                            340,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.8182'
                        ],
                        [
                            "eid487",
                            "scaleX",
                            1250,
                            310,
                            "easeOutBack",
                            "${mancha}",
                            '0.8182',
                            '1'
                        ],
                        [
                            "eid33",
                            "rotateZ",
                            660,
                            300,
                            "easeOutBack",
                            "${der}",
                            '0deg',
                            '40deg'
                        ],
                        [
                            "eid36",
                            "rotateZ",
                            960,
                            195,
                            "easeOutBack",
                            "${der}",
                            '40deg',
                            '55deg'
                        ],
                        [
                            "eid111",
                            "rotateZ",
                            1155,
                            545,
                            "easeOutBack",
                            "${der}",
                            '55deg',
                            '28deg'
                        ],
                        [
                            "eid18",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '0',
                            '1'
                        ],
                        [
                            "eid520",
                            "opacity",
                            340,
                            160,
                            "easeOutBack",
                            "${mancha}",
                            '0',
                            '1'
                        ],
                        [
                            "eid35",
                            "left",
                            660,
                            300,
                            "easeOutBack",
                            "${papiro}",
                            '336px',
                            '360px'
                        ],
                        [
                            "eid37",
                            "left",
                            960,
                            195,
                            "easeOutBack",
                            "${papiro}",
                            '360px',
                            '365px'
                        ],
                        [
                            "eid114",
                            "left",
                            1155,
                            545,
                            "easeOutBack",
                            "${papiro}",
                            '365px',
                            '353px'
                        ],
                        [
                            "eid4",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${papiro}",
                            '421px',
                            '116px'
                        ],
                        [
                            "eid34",
                            "top",
                            660,
                            300,
                            "easeOutBack",
                            "${papiro}",
                            '116px',
                            '145px'
                        ],
                        [
                            "eid38",
                            "top",
                            960,
                            195,
                            "easeOutBack",
                            "${papiro}",
                            '145px',
                            '167px'
                        ],
                        [
                            "eid115",
                            "top",
                            1155,
                            545,
                            "easeOutBack",
                            "${papiro}",
                            '167px',
                            '132px'
                        ],
                        [
                            "eid29",
                            "-webkit-transform-origin",
                            660,
                            300,
                            "easeOutBack",
                            "${der}",
                            [0,100],
                            [11.11,87.95],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid646",
                            "-moz-transform-origin",
                            660,
                            300,
                            "easeOutBack",
                            "${der}",
                            [0,100],
                            [11.11,87.95],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid647",
                            "-ms-transform-origin",
                            660,
                            300,
                            "easeOutBack",
                            "${der}",
                            [0,100],
                            [11.11,87.95],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid648",
                            "msTransformOrigin",
                            660,
                            300,
                            "easeOutBack",
                            "${der}",
                            [0,100],
                            [11.11,87.95],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid649",
                            "-o-transform-origin",
                            660,
                            300,
                            "easeOutBack",
                            "${der}",
                            [0,100],
                            [11.11,87.95],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid650",
                            "transform-origin",
                            660,
                            300,
                            "easeOutBack",
                            "${der}",
                            [0,100],
                            [11.11,87.95],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid42",
                            "rotateZ",
                            840,
                            410,
                            "easeOutBack",
                            "${izq}",
                            '0deg',
                            '16deg'
                        ],
                        [
                            "eid110",
                            "rotateZ",
                            1250,
                            500,
                            "easeOutBack",
                            "${izq}",
                            '16deg',
                            '-9deg'
                        ],
                        [
                            "eid8",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '371px',
                            '66px'
                        ],
                        [
                            "eid45",
                            "scaleX",
                            615,
                            225,
                            "easeOutBack",
                            "${plima}",
                            '0.68',
                            '1'
                        ],
                        [
                            "eid12",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${cuerpo}",
                            '0',
                            '1'
                        ],
                        [
                            "eid112",
                            "opacity",
                            500,
                            655,
                            "easeOutBack",
                            "${cuerpo}",
                            '1',
                            '0.99'
                        ],
                        [
                            "eid113",
                            "opacity",
                            1155,
                            545,
                            "easeOutBack",
                            "${cuerpo}",
                            '0.99',
                            '1'
                        ],
                        [
                            "eid39",
                            "rotateZ",
                            960,
                            195,
                            "easeOutBack",
                            "${papiro}",
                            '0deg',
                            '0deg'
                        ],
                        [
                            "eid116",
                            "rotateZ",
                            1155,
                            545,
                            "easeOutBack",
                            "${papiro}",
                            '0deg',
                            '8deg'
                        ],
                        [
                            "eid16",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${der}",
                            '0',
                            '1'
                        ],
                        [
                            "eid26",
                            "opacity",
                            340,
                            500,
                            "easeOutBack",
                            "${txt}",
                            '0',
                            '1'
                        ],
                        [
                            "eid24",
                            "top",
                            340,
                            500,
                            "easeOutBack",
                            "${txt}",
                            '530px',
                            '455px'
                        ],
                        [
                            "eid27",
                            "-webkit-transform-origin",
                            660,
                            0,
                            "linear",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid651",
                            "-moz-transform-origin",
                            660,
                            0,
                            "linear",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid652",
                            "-ms-transform-origin",
                            660,
                            0,
                            "linear",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid653",
                            "msTransformOrigin",
                            660,
                            0,
                            "linear",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid654",
                            "-o-transform-origin",
                            660,
                            0,
                            "linear",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid655",
                            "transform-origin",
                            660,
                            0,
                            "linear",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid47",
                            "scaleY",
                            615,
                            225,
                            "easeOutBack",
                            "${plima}",
                            '0.68',
                            '1'
                        ],
                        [
                            "eid20",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${izq}",
                            '0',
                            '1'
                        ],
                        [
                            "eid49",
                            "opacity",
                            615,
                            225,
                            "easeOutBack",
                            "${plima}",
                            '0',
                            '1'
                        ],
                        [
                            "eid2",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${cuerpo}",
                            '475px',
                            '170px'
                        ],
                        [
                            "eid482",
                            "rotateZ",
                            500,
                            410,
                            "linear",
                            "${mancha}",
                            '-21deg',
                            '0deg'
                        ],
                        [
                            "eid483",
                            "rotateZ",
                            910,
                            340,
                            "easeOutBack",
                            "${mancha}",
                            '0deg',
                            '-11deg'
                        ],
                        [
                            "eid486",
                            "rotateZ",
                            1250,
                            310,
                            "easeOutBack",
                            "${mancha}",
                            '-11deg',
                            '0deg'
                        ],
                        [
                            "eid6",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${der}",
                            '433px',
                            '128px'
                        ],
                        [
                            "eid14",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${papiro}",
                            '0',
                            '1'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("historia3_edgeActions.js");
})("EDGE-830167");
