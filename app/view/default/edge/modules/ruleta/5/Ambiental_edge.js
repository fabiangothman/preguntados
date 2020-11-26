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
                            rect: ['64px', '57px', '371px', '380px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mancha.png",'0px','0px'],
                            transform: [[],['-15'],[],['0.61','0.61']]
                        },
                        {
                            id: 'txt',
                            type: 'image',
                            rect: ['162px', '532px', '176px', '45px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"txt.png",'0px','0px']
                        },
                        {
                            id: 'torso',
                            type: 'image',
                            rect: ['149px', '527px', '163px', '164px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"torso.png",'0px','0px']
                        },
                        {
                            id: 'cabeza',
                            type: 'image',
                            rect: ['149px', '369px', '159px', '148px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cabeza.png",'0px','0px']
                        },
                        {
                            id: 'bizq',
                            type: 'image',
                            rect: ['97px', '255px', '87px', '62px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"bizq.png",'0px','0px'],
                            transform: [[],['-10']]
                        },
                        {
                            id: 'bder',
                            type: 'image',
                            rect: ['325px', '275px', '78px', '86px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"bder.png",'0px','0px'],
                            transform: [[],['-17']]
                        },
                        {
                            id: 'capsula',
                            type: 'image',
                            rect: ['39px', '328px', '112px', '147px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"capsula.png",'0px','0px']
                        },
                        {
                            id: 'hoja',
                            type: 'image',
                            rect: ['65px', '148px', '61px', '56px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"hoja.png",'0px','0px'],
                            transform: [[],[],[],['0.36','0.36']]
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
                    duration: 2175,
                    autoPlay: true,
                    data: [
                        [
                            "eid42",
                            "rotateZ",
                            500,
                            370,
                            "easeOutBack",
                            "${cabeza}",
                            '0deg',
                            '-8deg'
                        ],
                        [
                            "eid51",
                            "rotateZ",
                            870,
                            420,
                            "easeOutBack",
                            "${cabeza}",
                            '-8deg',
                            '11deg'
                        ],
                        [
                            "eid59",
                            "rotateZ",
                            1290,
                            405,
                            "easeOutBack",
                            "${cabeza}",
                            '11deg',
                            '-2deg'
                        ],
                        [
                            "eid30",
                            "rotateZ",
                            500,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '-15deg',
                            '0deg'
                        ],
                        [
                            "eid33",
                            "rotateZ",
                            1000,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0deg',
                            '-4deg'
                        ],
                        [
                            "eid36",
                            "rotateZ",
                            1500,
                            445,
                            "easeOutBack",
                            "${mancha}",
                            '-4deg',
                            '17deg'
                        ],
                        [
                            "eid41",
                            "rotateZ",
                            1945,
                            230,
                            "easeOutBack",
                            "${mancha}",
                            '17deg',
                            '0deg'
                        ],
                        [
                            "eid76",
                            "scaleX",
                            1945,
                            230,
                            "easeOutBack",
                            "${hoja}",
                            '0.36',
                            '1'
                        ],
                        [
                            "eid8",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${bder}",
                            '540px',
                            '259px'
                        ],
                        [
                            "eid49",
                            "top",
                            500,
                            370,
                            "easeOutBack",
                            "${bder}",
                            '259px',
                            '248px'
                        ],
                        [
                            "eid57",
                            "top",
                            870,
                            420,
                            "easeOutBack",
                            "${bder}",
                            '248px',
                            '275px'
                        ],
                        [
                            "eid60",
                            "top",
                            1290,
                            405,
                            "easeOutBack",
                            "${bder}",
                            '275px',
                            '255px'
                        ],
                        [
                            "eid14",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '0',
                            '1'
                        ],
                        [
                            "eid10",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${bizq}",
                            '0',
                            '1'
                        ],
                        [
                            "eid12",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '0',
                            '1'
                        ],
                        [
                            "eid72",
                            "top",
                            1750,
                            250,
                            "easeOutBack",
                            "${capsula}",
                            '328px',
                            '119px'
                        ],
                        [
                            "eid28",
                            "scaleY",
                            500,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0.61',
                            '1'
                        ],
                        [
                            "eid35",
                            "scaleY",
                            1000,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.86608'
                        ],
                        [
                            "eid38",
                            "scaleY",
                            1500,
                            445,
                            "easeOutBack",
                            "${mancha}",
                            '0.86608',
                            '0.92823'
                        ],
                        [
                            "eid40",
                            "scaleY",
                            1945,
                            230,
                            "easeOutBack",
                            "${mancha}",
                            '0.92823',
                            '1'
                        ],
                        [
                            "eid74",
                            "opacity",
                            1750,
                            250,
                            "easeOutBack",
                            "${capsula}",
                            '0',
                            '1'
                        ],
                        [
                            "eid67",
                            "rotateZ",
                            1695,
                            250,
                            "easeOutBack",
                            "${bizq}",
                            '-10deg',
                            '6deg'
                        ],
                        [
                            "eid32",
                            "opacity",
                            500,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0',
                            '1'
                        ],
                        [
                            "eid16",
                            "opacity",
                            0,
                            500,
                            "easeOutBack",
                            "${bder}",
                            '0',
                            '1'
                        ],
                        [
                            "eid6",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${cabeza}",
                            '369px',
                            '88px'
                        ],
                        [
                            "eid70",
                            "left",
                            1750,
                            250,
                            "easeOutBack",
                            "${capsula}",
                            '39px',
                            '38px'
                        ],
                        [
                            "eid43",
                            "rotateZ",
                            500,
                            370,
                            "easeOutBack",
                            "${torso}",
                            '0deg',
                            '-8deg'
                        ],
                        [
                            "eid50",
                            "rotateZ",
                            870,
                            420,
                            "easeOutBack",
                            "${torso}",
                            '-8deg',
                            '11deg'
                        ],
                        [
                            "eid58",
                            "rotateZ",
                            1290,
                            405,
                            "easeOutBack",
                            "${torso}",
                            '11deg',
                            '-2deg'
                        ],
                        [
                            "eid44",
                            "left",
                            500,
                            370,
                            "easeOutBack",
                            "${cabeza}",
                            '185px',
                            '149px'
                        ],
                        [
                            "eid53",
                            "left",
                            870,
                            420,
                            "easeOutBack",
                            "${cabeza}",
                            '149px',
                            '179px'
                        ],
                        [
                            "eid46",
                            "left",
                            500,
                            370,
                            "easeOutBack",
                            "${bizq}",
                            '110px',
                            '54px'
                        ],
                        [
                            "eid54",
                            "left",
                            870,
                            420,
                            "easeOutBack",
                            "${bizq}",
                            '54px',
                            '129px'
                        ],
                        [
                            "eid62",
                            "left",
                            1290,
                            405,
                            "easeOutBack",
                            "${bizq}",
                            '129px',
                            '97px'
                        ],
                        [
                            "eid24",
                            "opacity",
                            370,
                            500,
                            "easeOutBack",
                            "${txt}",
                            '0',
                            '1'
                        ],
                        [
                            "eid80",
                            "opacity",
                            1945,
                            230,
                            "easeOutBack",
                            "${hoja}",
                            '0',
                            '1'
                        ],
                        [
                            "eid2",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${bizq}",
                            '545px',
                            '264px'
                        ],
                        [
                            "eid47",
                            "top",
                            500,
                            370,
                            "easeOutBack",
                            "${bizq}",
                            '264px',
                            '276px'
                        ],
                        [
                            "eid55",
                            "top",
                            870,
                            420,
                            "easeOutBack",
                            "${bizq}",
                            '276px',
                            '255px'
                        ],
                        [
                            "eid63",
                            "top",
                            1290,
                            405,
                            "easeOutBack",
                            "${bizq}",
                            '255px',
                            '267px'
                        ],
                        [
                            "eid48",
                            "left",
                            500,
                            370,
                            "easeOutBack",
                            "${bder}",
                            '339px',
                            '281px'
                        ],
                        [
                            "eid56",
                            "left",
                            870,
                            420,
                            "easeOutBack",
                            "${bder}",
                            '281px',
                            '356px'
                        ],
                        [
                            "eid61",
                            "left",
                            1290,
                            405,
                            "easeOutBack",
                            "${bder}",
                            '356px',
                            '325px'
                        ],
                        [
                            "eid45",
                            "left",
                            500,
                            370,
                            "easeOutBack",
                            "${torso}",
                            '185px',
                            '149px'
                        ],
                        [
                            "eid52",
                            "left",
                            870,
                            420,
                            "easeOutBack",
                            "${torso}",
                            '149px',
                            '179px'
                        ],
                        [
                            "eid22",
                            "top",
                            370,
                            500,
                            "easeOutBack",
                            "${txt}",
                            '532px',
                            '455px'
                        ],
                        [
                            "eid68",
                            "rotateZ",
                            1695,
                            250,
                            "easeOutBack",
                            "${bder}",
                            '-17deg',
                            '9deg'
                        ],
                        [
                            "eid78",
                            "scaleY",
                            1945,
                            230,
                            "easeOutBack",
                            "${hoja}",
                            '0.36',
                            '1'
                        ],
                        [
                            "eid26",
                            "scaleX",
                            500,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '0.61',
                            '1'
                        ],
                        [
                            "eid34",
                            "scaleX",
                            1000,
                            500,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '0.86608'
                        ],
                        [
                            "eid37",
                            "scaleX",
                            1500,
                            445,
                            "easeOutBack",
                            "${mancha}",
                            '0.86608',
                            '0.92823'
                        ],
                        [
                            "eid39",
                            "scaleX",
                            1945,
                            230,
                            "easeOutBack",
                            "${mancha}",
                            '0.92823',
                            '1'
                        ],
                        [
                            "eid4",
                            "top",
                            0,
                            500,
                            "easeOutBack",
                            "${torso}",
                            '527px',
                            '246px'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("Ambiental_edgeActions.js");
})("EDGE-4649614");
