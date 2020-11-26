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
                            id: 'Recurso_60',
                            type: 'image',
                            rect: ['198px', '530px', '102px', '45px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"Recurso%2060.png",'0px','0px']
                        },
                        {
                            id: 'mancha',
                            type: 'image',
                            rect: ['107px', '24px', '306px', '359px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mancha.png",'0px','0px'],
                            transform: [[],[],[],['0.37','0.37']]
                        },
                        {
                            id: 'pieIzq',
                            type: 'image',
                            rect: ['198px', '713px', '39px', '83px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"pieIzq.png",'0px','0px']
                        },
                        {
                            id: 'pieder',
                            type: 'image',
                            rect: ['269px', '713px', '39px', '84px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"pieder.png",'0px','0px']
                        },
                        {
                            id: 'torso',
                            type: 'image',
                            rect: ['169px', '629px', '160px', '92px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"torso.png",'0px','0px']
                        },
                        {
                            id: 'human',
                            type: 'image',
                            rect: ['146px', '432px', '206px', '188px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"human.png",'0px','0px']
                        },
                        {
                            id: 'bot',
                            type: 'image',
                            rect: ['173px', '548px', '151px', '70px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"bot.png",'0px','0px']
                        },
                        {
                            id: 'MIzq',
                            type: 'image',
                            rect: ['95px', '583px', '60px', '156px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"MIzq.png",'0px','0px']
                        },
                        {
                            id: 'Mder',
                            type: 'image',
                            rect: ['344px', '583px', '60px', '155px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"Mder.png",'0px','0px'],
                            transform: [[],['-13']]
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
                    duration: 2115,
                    autoPlay: true,
                    data: [
                        [
                            "eid47",
                            "rotateZ",
                            500,
                            295,
                            "easeOutBack",
                            "${MIzq}",
                            '0deg',
                            '8deg'
                        ],
                        [
                            "eid54",
                            "rotateZ",
                            795,
                            255,
                            "easeOutBack",
                            "${MIzq}",
                            '8deg',
                            '0deg'
                        ],
                        [
                            "eid60",
                            "rotateZ",
                            1050,
                            200,
                            "easeOutBack",
                            "${MIzq}",
                            '0deg',
                            '8deg'
                        ],
                        [
                            "eid66",
                            "rotateZ",
                            1405,
                            265,
                            "easeOutBack",
                            "${MIzq}",
                            '8deg',
                            '27deg'
                        ],
                        [
                            "eid67",
                            "rotateZ",
                            1670,
                            270,
                            "easeOutBack",
                            "${MIzq}",
                            '27deg',
                            '2deg'
                        ],
                        [
                            "eid70",
                            "rotateZ",
                            1940,
                            175,
                            "easeOutBack",
                            "${MIzq}",
                            '2deg',
                            '7deg'
                        ],
                        [
                            "eid2",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${pieder}",
                            '713px',
                            '334px'
                        ],
                        [
                            "eid53",
                            "rotateZ",
                            795,
                            255,
                            "easeOutBack",
                            "${pieIzq}",
                            '0deg',
                            '17deg'
                        ],
                        [
                            "eid59",
                            "rotateZ",
                            1050,
                            200,
                            "easeOutBack",
                            "${pieIzq}",
                            '17deg',
                            '4deg'
                        ],
                        [
                            "eid36",
                            "scaleY",
                            345,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0.37',
                            '1'
                        ],
                        [
                            "eid41",
                            "scaleY",
                            845,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.88'
                        ],
                        [
                            "eid43",
                            "scaleY",
                            1345,
                            405,
                            "easeOutBack",
                            "${mancha}",
                            '0.88',
                            '1'
                        ],
                        [
                            "eid34",
                            "scaleX",
                            345,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0.37',
                            '1'
                        ],
                        [
                            "eid40",
                            "scaleX",
                            845,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.88'
                        ],
                        [
                            "eid42",
                            "scaleX",
                            1345,
                            405,
                            "easeOutBack",
                            "${mancha}",
                            '0.88',
                            '1'
                        ],
                        [
                            "eid24",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '0',
                            '1'
                        ],
                        [
                            "eid10",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '629px',
                            '250px'
                        ],
                        [
                            "eid26",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${human}",
                            '0',
                            '1'
                        ],
                        [
                            "eid20",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${pieIzq}",
                            '0',
                            '1'
                        ],
                        [
                            "eid8",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${bot}",
                            '548px',
                            '169px'
                        ],
                        [
                            "eid55",
                            "rotateZ",
                            795,
                            255,
                            "easeOutBack",
                            "${Mder}",
                            '0deg',
                            '-13deg'
                        ],
                        [
                            "eid57",
                            "rotateZ",
                            1050,
                            200,
                            "easeOutBack",
                            "${Mder}",
                            '-13deg',
                            '-5deg'
                        ],
                        [
                            "eid65",
                            "rotateZ",
                            1405,
                            265,
                            "easeOutBack",
                            "${Mder}",
                            '-5deg',
                            '-27deg'
                        ],
                        [
                            "eid68",
                            "rotateZ",
                            1670,
                            270,
                            "easeOutBack",
                            "${Mder}",
                            '-27deg',
                            '-1deg'
                        ],
                        [
                            "eid69",
                            "rotateZ",
                            1940,
                            175,
                            "easeOutBack",
                            "${Mder}",
                            '-1deg',
                            '-5deg'
                        ],
                        [
                            "eid45",
                            "rotateZ",
                            500,
                            295,
                            "easeOutBack",
                            "${human}",
                            '0deg',
                            '-4deg'
                        ],
                        [
                            "eid50",
                            "rotateZ",
                            795,
                            255,
                            "easeOutBack",
                            "${human}",
                            '-4deg',
                            '4deg'
                        ],
                        [
                            "eid61",
                            "rotateZ",
                            1050,
                            200,
                            "easeOutBack",
                            "${human}",
                            '4deg',
                            '-2deg'
                        ],
                        [
                            "eid49",
                            "rotateZ",
                            500,
                            295,
                            "easeOutBack",
                            "${torso}",
                            '0deg',
                            '-3deg'
                        ],
                        [
                            "eid51",
                            "rotateZ",
                            795,
                            255,
                            "easeOutBack",
                            "${torso}",
                            '-3deg',
                            '4deg'
                        ],
                        [
                            "eid58",
                            "rotateZ",
                            1050,
                            200,
                            "easeOutBack",
                            "${torso}",
                            '4deg',
                            '0deg'
                        ],
                        [
                            "eid14",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${Mder}",
                            '583px',
                            '204px'
                        ],
                        [
                            "eid16",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${pieder}",
                            '0',
                            '1'
                        ],
                        [
                            "eid12",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${human}",
                            '432px',
                            '53px'
                        ],
                        [
                            "eid6",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${pieIzq}",
                            '713px',
                            '334px'
                        ],
                        [
                            "eid22",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${bot}",
                            '0',
                            '1'
                        ],
                        [
                            "eid38",
                            "opacity",
                            345,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0',
                            '1'
                        ],
                        [
                            "eid28",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${Mder}",
                            '0',
                            '1'
                        ],
                        [
                            "eid18",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${MIzq}",
                            '0',
                            '1'
                        ],
                        [
                            "eid30",
                            "top",
                            400,
                            500,
                            "easeOutBack",
                            "${Recurso_60}",
                            '530px',
                            '455px'
                        ],
                        [
                            "eid48",
                            "rotateZ",
                            500,
                            295,
                            "easeOutBack",
                            "${bot}",
                            '0deg',
                            '-4deg'
                        ],
                        [
                            "eid56",
                            "rotateZ",
                            795,
                            255,
                            "easeOutBack",
                            "${bot}",
                            '-4deg',
                            '1deg'
                        ],
                        [
                            "eid62",
                            "rotateZ",
                            1050,
                            200,
                            "easeOutBack",
                            "${bot}",
                            '1deg',
                            '3deg'
                        ],
                        [
                            "eid32",
                            "opacity",
                            400,
                            500,
                            "easeOutBack",
                            "${Recurso_60}",
                            '0',
                            '1'
                        ],
                        [
                            "eid4",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${MIzq}",
                            '583px',
                            '204px'
                        ],
                        [
                            "eid46",
                            "rotateZ",
                            500,
                            295,
                            "easeOutBack",
                            "${pieder}",
                            '0deg',
                            '-12deg'
                        ],
                        [
                            "eid52",
                            "rotateZ",
                            795,
                            255,
                            "easeOutBack",
                            "${pieder}",
                            '-12deg',
                            '0deg'
                        ],
                        [
                            "eid39",
                            "rotateZ",
                            845,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0deg',
                            '-13deg'
                        ],
                        [
                            "eid44",
                            "rotateZ",
                            1345,
                            405,
                            "easeOutBack",
                            "${mancha}",
                            '-13deg',
                            '0deg'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("gente_edgeActions.js");
})("EDGE-3653075");
