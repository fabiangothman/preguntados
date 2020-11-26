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
                            rect: ['116px', '86px', '268px', '332px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mancha.png",'0px','0px']
                        },
                        {
                            id: 'txt',
                            type: 'image',
                            rect: ['168px', '530px', '164px', '45px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"txt.png",'0px','0px']
                        },
                        {
                            id: 'ruedas',
                            type: 'image',
                            rect: ['137px', '541px', '228px', '163px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"ruedas.png",'0px','0px']
                        },
                        {
                            id: 'aguja',
                            type: 'image',
                            rect: ['224px', '584px', '27px', '20px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"aguja.png",'0px','0px'],
                            transform: [[],['122']]
                        },
                        {
                            id: 'mizq',
                            type: 'image',
                            rect: ['161px', '466px', '34px', '53px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mizq.png",'0px','0px']
                        },
                        {
                            id: 'mder',
                            type: 'image',
                            rect: ['310px', '466px', '33px', '53px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mder.png",'0px','0px']
                        },
                        {
                            id: 'torso',
                            type: 'image',
                            rect: ['188px', '488px', '125px', '48px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"torso.png",'0px','0px']
                        },
                        {
                            id: 'cabeza',
                            type: 'image',
                            rect: ['195px', '93px', '108px', '71px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cabeza.png",'0px','0px']
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
                    duration: 2305,
                    autoPlay: true,
                    data: [
                        [
                            "eid67",
                            "rotateZ",
                            500,
                            1045,
                            "easeOutBack",
                            "${cabeza}",
                            '0deg',
                            '-6deg'
                        ],
                        [
                            "eid68",
                            "rotateZ",
                            1545,
                            205,
                            "easeOutBack",
                            "${cabeza}",
                            '-6deg',
                            '4deg'
                        ],
                        [
                            "eid90",
                            "rotateZ",
                            960,
                            290,
                            "easeOutBack",
                            "${mancha}",
                            '0deg',
                            '13deg'
                        ],
                        [
                            "eid91",
                            "rotateZ",
                            1250,
                            200,
                            "easeOutBack",
                            "${mancha}",
                            '13deg',
                            '0deg'
                        ],
                        [
                            "eid12",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${mder}",
                            '466px',
                            '147px'
                        ],
                        [
                            "eid82",
                            "opacity",
                            250,
                            250,
                            "easeOutBack",
                            "${mancha}",
                            '0',
                            '1'
                        ],
                        [
                            "eid16",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${mizq}",
                            '466px',
                            '147px'
                        ],
                        [
                            "eid78",
                            "scaleX",
                            250,
                            250,
                            "easeOutBack",
                            "${mancha}",
                            '0.64',
                            '1'
                        ],
                        [
                            "eid85",
                            "scaleX",
                            960,
                            235,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '1.22'
                        ],
                        [
                            "eid87",
                            "scaleX",
                            1195,
                            255,
                            "easeOutBack",
                            "${mancha}",
                            '1.22',
                            '1'
                        ],
                        [
                            "eid26",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '0',
                            '1'
                        ],
                        [
                            "eid4",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '488px',
                            '169px'
                        ],
                        [
                            "eid6",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${ruedas}",
                            '137px',
                            '136px'
                        ],
                        [
                            "eid14",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${mizq}",
                            '161px',
                            '160px'
                        ],
                        [
                            "eid8",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${ruedas}",
                            '541px',
                            '222px'
                        ],
                        [
                            "eid10",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${mder}",
                            '310px',
                            '309px'
                        ],
                        [
                            "eid18",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '195px',
                            '194px'
                        ],
                        [
                            "eid65",
                            "left",
                            1360,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            '194px',
                            '194px'
                        ],
                        [
                            "eid20",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '423px',
                            '104px'
                        ],
                        [
                            "eid42",
                            "top",
                            500,
                            250,
                            "easeOutBack",
                            "${cabeza}",
                            '104px',
                            '94px'
                        ],
                        [
                            "eid43",
                            "top",
                            750,
                            250,
                            "easeOutBack",
                            "${cabeza}",
                            '94px',
                            '104px'
                        ],
                        [
                            "eid66",
                            "top",
                            1360,
                            185,
                            "easeOutBack",
                            "${cabeza}",
                            '104px',
                            '93px'
                        ],
                        [
                            "eid69",
                            "top",
                            1545,
                            205,
                            "easeOutBack",
                            "${cabeza}",
                            '93px',
                            '103px'
                        ],
                        [
                            "eid30",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${mder}",
                            '0',
                            '1'
                        ],
                        [
                            "eid58",
                            "rotateZ",
                            500,
                            190,
                            "easeOutBack",
                            "${aguja}",
                            '122deg',
                            '-12deg'
                        ],
                        [
                            "eid59",
                            "rotateZ",
                            690,
                            165,
                            "easeOutBack",
                            "${aguja}",
                            '-12deg',
                            '15deg'
                        ],
                        [
                            "eid60",
                            "rotateZ",
                            855,
                            220,
                            "easeOutBack",
                            "${aguja}",
                            '15deg',
                            '-16deg'
                        ],
                        [
                            "eid61",
                            "rotateZ",
                            1075,
                            245,
                            "easeOutBack",
                            "${aguja}",
                            '-16deg',
                            '28deg'
                        ],
                        [
                            "eid62",
                            "rotateZ",
                            1320,
                            180,
                            "easeOutBack",
                            "${aguja}",
                            '28deg',
                            '-17deg'
                        ],
                        [
                            "eid34",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '0',
                            '1'
                        ],
                        [
                            "eid63",
                            "opacity",
                            1360,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            '1',
                            '1'
                        ],
                        [
                            "eid36",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${aguja}",
                            '0',
                            '1'
                        ],
                        [
                            "eid76",
                            "opacity",
                            250,
                            250,
                            "easeOutBack",
                            "${txt}",
                            '0',
                            '1'
                        ],
                        [
                            "eid74",
                            "top",
                            250,
                            250,
                            "easeOutBack",
                            "${txt}",
                            '530px',
                            '455px'
                        ],
                        [
                            "eid28",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${ruedas}",
                            '0',
                            '1'
                        ],
                        [
                            "eid39",
                            "rotateZ",
                            500,
                            250,
                            "easeOutBack",
                            "${mder}",
                            '0deg',
                            '18deg'
                        ],
                        [
                            "eid45",
                            "rotateZ",
                            750,
                            500,
                            "easeOutBack",
                            "${mder}",
                            '18deg',
                            '-19deg'
                        ],
                        [
                            "eid46",
                            "rotateZ",
                            1250,
                            250,
                            "easeOutBack",
                            "${mder}",
                            '-19deg',
                            '9deg'
                        ],
                        [
                            "eid71",
                            "rotateZ",
                            1500,
                            250,
                            "easeOutBack",
                            "${mder}",
                            '9deg',
                            '15deg'
                        ],
                        [
                            "eid93",
                            "rotateZ",
                            1750,
                            555,
                            "easeOutBack",
                            "${mder}",
                            '15deg',
                            '3deg'
                        ],
                        [
                            "eid2",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '188px',
                            '187px'
                        ],
                        [
                            "eid24",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${aguja}",
                            '584px',
                            '265px'
                        ],
                        [
                            "eid22",
                            "left",
                            0,
                            500,
                            "easeOutBack",
                            "${aguja}",
                            '224px',
                            '223px'
                        ],
                        [
                            "eid40",
                            "rotateZ",
                            500,
                            250,
                            "easeOutBack",
                            "${mizq}",
                            '0deg',
                            '-23deg'
                        ],
                        [
                            "eid44",
                            "rotateZ",
                            750,
                            500,
                            "easeOutBack",
                            "${mizq}",
                            '-23deg',
                            '15deg'
                        ],
                        [
                            "eid47",
                            "rotateZ",
                            1250,
                            250,
                            "easeOutBack",
                            "${mizq}",
                            '15deg',
                            '-7deg'
                        ],
                        [
                            "eid70",
                            "rotateZ",
                            1500,
                            250,
                            "easeOutBack",
                            "${mizq}",
                            '-7deg',
                            '-26deg'
                        ],
                        [
                            "eid92",
                            "rotateZ",
                            1750,
                            555,
                            "easeOutBack",
                            "${mizq}",
                            '-26deg',
                            '-8deg'
                        ],
                        [
                            "eid80",
                            "scaleY",
                            250,
                            250,
                            "easeOutBack",
                            "${mancha}",
                            '0.64',
                            '1'
                        ],
                        [
                            "eid86",
                            "scaleY",
                            960,
                            235,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '1.22'
                        ],
                        [
                            "eid88",
                            "scaleY",
                            1195,
                            255,
                            "easeOutBack",
                            "${mancha}",
                            '1.22',
                            '1'
                        ],
                        [
                            "eid32",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${mizq}",
                            '0',
                            '1'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("eficiencia_edgeActions.js");
})("EDGE-2463338");
