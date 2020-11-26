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
                            id: 'mancha',
                            type: 'image',
                            rect: ['71px', '97px', '337px', '315px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mancha.png",'0px','0px'],
                            transform: [[],[],[],['0.1','0.1']]
                        },
                        {
                            id: 'txt',
                            type: 'image',
                            rect: ['197px', '535px', '106px', '45px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"txt.png",'0px','0px']
                        },
                        {
                            id: 'pieizq',
                            type: 'image',
                            rect: ['195px', '648px', '42px', '89px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"pieizq.png",'0px','0px']
                        },
                        {
                            id: 'pieder',
                            type: 'image',
                            rect: ['262px', '649px', '41px', '88px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"pieder.png",'0px','0px']
                        },
                        {
                            id: 'torso',
                            type: 'image',
                            rect: ['160px', '560px', '188px', '97px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"torso.png",'0px','0px']
                        },
                        {
                            id: 'cabeza',
                            type: 'image',
                            rect: ['144px', '30px', '220px', '220px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cabeza.png",'0px','0px']
                        },
                        {
                            id: 'bizq',
                            type: 'image',
                            rect: ['99px', '545px', '72px', '71px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"bizq.png",'0px','0px'],
                            transform: [[],['26']]
                        },
                        {
                            id: 'bder',
                            type: 'image',
                            rect: ['338px', '577px', '73px', '71px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"bder.png",'0px','0px'],
                            transform: [[],['6']]
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
                    duration: 2315,
                    autoPlay: true,
                    data: [
                        [
                            "eid48",
                            "rotateZ",
                            500,
                            310,
                            "easeOutBack",
                            "${cabeza}",
                            '0deg',
                            '-4deg'
                        ],
                        [
                            "eid50",
                            "rotateZ",
                            810,
                            240,
                            "easeOutBack",
                            "${cabeza}",
                            '-4deg',
                            '4deg'
                        ],
                        [
                            "eid61",
                            "rotateZ",
                            1500,
                            250,
                            "easeOutBack",
                            "${cabeza}",
                            '4deg',
                            '-5deg'
                        ],
                        [
                            "eid66",
                            "rotateZ",
                            1750,
                            250,
                            "easeOutBack",
                            "${cabeza}",
                            '-5deg',
                            '6deg'
                        ],
                        [
                            "eid68",
                            "rotateZ",
                            2000,
                            200,
                            "easeOutBack",
                            "${cabeza}",
                            '6deg',
                            '-6deg'
                        ],
                        [
                            "eid30",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${pieizq}",
                            '648px',
                            '346px'
                        ],
                        [
                            "eid77",
                            "rotateZ",
                            1160,
                            240,
                            "easeOutBack",
                            "${mancha}",
                            '0deg',
                            '22deg'
                        ],
                        [
                            "eid80",
                            "rotateZ",
                            1400,
                            270,
                            "easeOutBack",
                            "${mancha}",
                            '22deg',
                            '0deg'
                        ],
                        [
                            "eid26",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${bder}",
                            '577px',
                            '275px'
                        ],
                        [
                            "eid10",
                            "opacity",
                            660,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0',
                            '1'
                        ],
                        [
                            "eid8",
                            "scaleY",
                            660,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0.1',
                            '1'
                        ],
                        [
                            "eid75",
                            "scaleY",
                            1160,
                            240,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.86'
                        ],
                        [
                            "eid79",
                            "scaleY",
                            1400,
                            270,
                            "easeOutBack",
                            "${mancha}",
                            '0.86',
                            '1'
                        ],
                        [
                            "eid6",
                            "scaleX",
                            660,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0.1',
                            '1'
                        ],
                        [
                            "eid74",
                            "scaleX",
                            1160,
                            240,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.86'
                        ],
                        [
                            "eid78",
                            "scaleX",
                            1400,
                            270,
                            "easeOutBack",
                            "${mancha}",
                            '0.86',
                            '1'
                        ],
                        [
                            "eid36",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '0',
                            '1'
                        ],
                        [
                            "eid14",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '560px',
                            '258px'
                        ],
                        [
                            "eid28",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${pieizq}",
                            '195px',
                            '192px'
                        ],
                        [
                            "eid34",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${pieder}",
                            '649px',
                            '347px'
                        ],
                        [
                            "eid54",
                            "rotateZ",
                            1050,
                            300,
                            "easeOutBack",
                            "${bizq}",
                            '0deg',
                            '-30deg'
                        ],
                        [
                            "eid55",
                            "rotateZ",
                            1350,
                            255,
                            "easeOutBack",
                            "${bizq}",
                            '-30deg',
                            '17deg'
                        ],
                        [
                            "eid64",
                            "rotateZ",
                            1605,
                            345,
                            "easeOutBack",
                            "${bizq}",
                            '17deg',
                            '7deg'
                        ],
                        [
                            "eid71",
                            "rotateZ",
                            1950,
                            250,
                            "easeOutBack",
                            "${bizq}",
                            '7deg',
                            '26deg'
                        ],
                        [
                            "eid81",
                            "rotateZ",
                            2200,
                            115,
                            "easeOutBack",
                            "${bizq}",
                            '26deg',
                            '17deg'
                        ],
                        [
                            "eid38",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${bizq}",
                            '0',
                            '1'
                        ],
                        [
                            "eid42",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${bder}",
                            '0',
                            '1'
                        ],
                        [
                            "eid53",
                            "rotateZ",
                            1050,
                            300,
                            "easeOutBack",
                            "${bder}",
                            '-1deg',
                            '37deg'
                        ],
                        [
                            "eid56",
                            "rotateZ",
                            1350,
                            255,
                            "easeOutBack",
                            "${bder}",
                            '37deg',
                            '-4deg'
                        ],
                        [
                            "eid63",
                            "rotateZ",
                            1605,
                            345,
                            "easeOutBack",
                            "${bder}",
                            '-4deg',
                            '7deg'
                        ],
                        [
                            "eid70",
                            "rotateZ",
                            1950,
                            250,
                            "easeOutBack",
                            "${bder}",
                            '7deg',
                            '6deg'
                        ],
                        [
                            "eid40",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '0',
                            '1'
                        ],
                        [
                            "eid59",
                            "opacity",
                            1500,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            '1',
                            '1'
                        ],
                        [
                            "eid46",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${pieder}",
                            '0',
                            '1'
                        ],
                        [
                            "eid16",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${bizq}",
                            '99px',
                            '96px'
                        ],
                        [
                            "eid44",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${pieizq}",
                            '0',
                            '1'
                        ],
                        [
                            "eid4",
                            "opacity",
                            405,
                            500,
                            "easeOutBack",
                            "${txt}",
                            '0',
                            '1'
                        ],
                        [
                            "eid2",
                            "top",
                            405,
                            500,
                            "easeOutBack",
                            "${txt}",
                            '535px',
                            '455px'
                        ],
                        [
                            "eid18",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${bizq}",
                            '545px',
                            '243px'
                        ],
                        [
                            "eid24",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${bder}",
                            '338px',
                            '335px'
                        ],
                        [
                            "eid12",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '160px',
                            '157px'
                        ],
                        [
                            "eid32",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${pieder}",
                            '262px',
                            '259px'
                        ],
                        [
                            "eid20",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '144px',
                            '141px'
                        ],
                        [
                            "eid57",
                            "left",
                            1500,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            '141px',
                            '141px'
                        ],
                        [
                            "eid69",
                            "rotateZ",
                            1750,
                            450,
                            "easeOutBack",
                            "${torso}",
                            '0deg',
                            '-4deg'
                        ],
                        [
                            "eid22",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '332px',
                            '30px'
                        ],
                        [
                            "eid47",
                            "top",
                            500,
                            310,
                            "easeOutBack",
                            "${cabeza}",
                            '30px',
                            '10px'
                        ],
                        [
                            "eid49",
                            "top",
                            810,
                            240,
                            "easeOutBack",
                            "${cabeza}",
                            '10px',
                            '30px'
                        ],
                        [
                            "eid58",
                            "top",
                            1500,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            '30px',
                            '30px'
                        ],
                        [
                            "eid65",
                            "top",
                            1750,
                            250,
                            "easeOutBack",
                            "${cabeza}",
                            '30px',
                            '0px'
                        ],
                        [
                            "eid67",
                            "top",
                            2000,
                            200,
                            "easeOutBack",
                            "${cabeza}",
                            '0px',
                            '30px'
                        ],
                        [
                            "eid62",
                            "rotateZ",
                            1400,
                            350,
                            "easeOutBack",
                            "${pieder}",
                            '0deg',
                            '-10deg'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("social_edgeActions.js");
})("EDGE-5496357");
