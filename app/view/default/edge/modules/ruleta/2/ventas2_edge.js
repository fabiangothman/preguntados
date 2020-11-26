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
                            rect: ['67px', '125px', '284px', '256px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"mancha.png",'0px','0px'],
                            transform: [[],[],[],['0.55','0.55']]
                        },
                        {
                            id: 'cuerpo',
                            type: 'image',
                            rect: ['105px', '469px', '208px', '254px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cuerpo.png",'0px','0px']
                        },
                        {
                            id: 'cabeza',
                            type: 'image',
                            rect: ['164px', '394px', '89px', '66px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cabeza.png",'0px','0px']
                        },
                        {
                            id: 'bizq',
                            type: 'image',
                            rect: ['82px', '531px', '45px', '119px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"bizq.png",'0px','0px']
                        },
                        {
                            id: 'bder',
                            type: 'image',
                            rect: ['313px', '544px', '155px', '132px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"bder.png",'0px','0px']
                        },
                        {
                            id: 'txt',
                            type: 'image',
                            rect: ['192px', '537px', '116px', '45px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"txt.png",'0px','0px']
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
                    duration: 2000,
                    autoPlay: true,
                    data: [
                        [
                            "eid39",
                            "rotateZ",
                            415,
                            400,
                            "easeOutBack",
                            "${cabeza}",
                            '0deg',
                            '-9deg'
                        ],
                        [
                            "eid40",
                            "rotateZ",
                            815,
                            355,
                            "easeOutBack",
                            "${cabeza}",
                            '-9deg',
                            '2deg'
                        ],
                        [
                            "eid122",
                            "rotateZ",
                            415,
                            1045,
                            "easeOutBack",
                            "${mancha}",
                            '0deg',
                            '6deg'
                        ],
                        [
                            "eid127",
                            "rotateZ",
                            1460,
                            540,
                            "easeOutBack",
                            "${mancha}",
                            '6deg',
                            '0deg'
                        ],
                        [
                            "eid24",
                            "scaleY",
                            585,
                            415,
                            "easeOutBack",
                            "${mancha}",
                            '0.55',
                            '1'
                        ],
                        [
                            "eid124",
                            "scaleY",
                            1000,
                            460,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '1.1'
                        ],
                        [
                            "eid126",
                            "scaleY",
                            1460,
                            540,
                            "easeOutBack",
                            "${mancha}",
                            '1.1',
                            '1'
                        ],
                        [
                            "eid6",
                            "opacity",
                            0,
                            415,
                            "easeOutBack",
                            "${bizq}",
                            '0',
                            '1'
                        ],
                        [
                            "eid31",
                            "-webkit-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid368",
                            "-moz-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid369",
                            "-ms-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid370",
                            "msTransformOrigin",
                            415,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid371",
                            "-o-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid372",
                            "transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid32",
                            "-webkit-transform-origin",
                            930,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid373",
                            "-moz-transform-origin",
                            930,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid374",
                            "-ms-transform-origin",
                            930,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid375",
                            "msTransformOrigin",
                            930,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid376",
                            "-o-transform-origin",
                            930,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid377",
                            "transform-origin",
                            930,
                            0,
                            "easeOutBack",
                            "${bizq}",
                            [100,0],
                            [100,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid30",
                            "rotateZ",
                            415,
                            515,
                            "easeOutBack",
                            "${bizq}",
                            '0deg',
                            '37deg'
                        ],
                        [
                            "eid37",
                            "rotateZ",
                            930,
                            570,
                            "easeOutBack",
                            "${bizq}",
                            '37deg',
                            '26deg'
                        ],
                        [
                            "eid12",
                            "opacity",
                            0,
                            415,
                            "easeOutBack",
                            "${bder}",
                            '0',
                            '1'
                        ],
                        [
                            "eid16",
                            "top",
                            0,
                            415,
                            "easeOutBack",
                            "${cabeza}",
                            '394px',
                            '83px'
                        ],
                        [
                            "eid10",
                            "opacity",
                            0,
                            415,
                            "easeOutBack",
                            "${cuerpo}",
                            '0',
                            '1'
                        ],
                        [
                            "eid38",
                            "-webkit-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid378",
                            "-moz-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid379",
                            "-ms-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid380",
                            "msTransformOrigin",
                            415,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid381",
                            "-o-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid382",
                            "transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid4",
                            "opacity",
                            415,
                            415,
                            "easeOutBack",
                            "${txt}",
                            '0',
                            '1'
                        ],
                        [
                            "eid2",
                            "top",
                            415,
                            415,
                            "easeOutBack",
                            "${txt}",
                            '537px',
                            '455px'
                        ],
                        [
                            "eid14",
                            "top",
                            0,
                            415,
                            "easeOutBack",
                            "${bizq}",
                            '531px',
                            '220px'
                        ],
                        [
                            "eid34",
                            "rotateZ",
                            415,
                            515,
                            "easeOutBack",
                            "${bder}",
                            '0deg',
                            '-14deg'
                        ],
                        [
                            "eid35",
                            "rotateZ",
                            930,
                            415,
                            "easeOutBack",
                            "${bder}",
                            '-14deg',
                            '-1deg'
                        ],
                        [
                            "eid36",
                            "rotateZ",
                            1345,
                            405,
                            "easeOutBack",
                            "${bder}",
                            '-1deg',
                            '-5deg'
                        ],
                        [
                            "eid121",
                            "rotateZ",
                            1750,
                            250,
                            "easeOutBack",
                            "${bder}",
                            '-5deg',
                            '3deg'
                        ],
                        [
                            "eid33",
                            "-webkit-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bder}",
                            [0,0],
                            [0,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid383",
                            "-moz-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bder}",
                            [0,0],
                            [0,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid384",
                            "-ms-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bder}",
                            [0,0],
                            [0,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid385",
                            "msTransformOrigin",
                            415,
                            0,
                            "easeOutBack",
                            "${bder}",
                            [0,0],
                            [0,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid386",
                            "-o-transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bder}",
                            [0,0],
                            [0,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid387",
                            "transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${bder}",
                            [0,0],
                            [0,0],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid18",
                            "top",
                            0,
                            415,
                            "easeOutBack",
                            "${cuerpo}",
                            '469px',
                            '158px'
                        ],
                        [
                            "eid22",
                            "scaleX",
                            585,
                            415,
                            "easeOutBack",
                            "${mancha}",
                            '0.55',
                            '1'
                        ],
                        [
                            "eid123",
                            "scaleX",
                            1000,
                            460,
                            "easeOutBack",
                            "${mancha}",
                            '1',
                            '1.1'
                        ],
                        [
                            "eid125",
                            "scaleX",
                            1460,
                            540,
                            "easeOutBack",
                            "${mancha}",
                            '1.1',
                            '1'
                        ],
                        [
                            "eid8",
                            "opacity",
                            0,
                            415,
                            "easeOutBack",
                            "${cabeza}",
                            '0',
                            '1'
                        ],
                        [
                            "eid26",
                            "opacity",
                            585,
                            415,
                            "easeOutBack",
                            "${mancha}",
                            '0',
                            '1'
                        ],
                        [
                            "eid20",
                            "top",
                            0,
                            415,
                            "easeOutBack",
                            "${bder}",
                            '544px',
                            '233px'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("ventas2_edgeActions.js");
})("EDGE-1928514");
