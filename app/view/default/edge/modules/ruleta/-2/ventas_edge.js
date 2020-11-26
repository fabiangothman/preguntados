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
                            fill: ["rgba(255,255,255,0.00)",[270,[['rgba(81,44,139,0.00)',0],['rgba(255,255,255,1.00)',100]]]]
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
                            "eid20",
                            "top",
                            0,
                            415,
                            "easeOutBack",
                            "${bder}",
                            '544px',
                            '233px'
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
                            "eid328",
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
                            "eid329",
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
                            "eid330",
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
                            "eid331",
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
                            "eid332",
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
                            "eid333",
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
                            "eid334",
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
                            "eid335",
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
                            "eid336",
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
                            "eid337",
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
                            "eid338",
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
                            "eid339",
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
                            "eid340",
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
                            "eid341",
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
                            "eid342",
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
                            "eid343",
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
                            "eid344",
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
                            "eid345",
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
                            "eid346",
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
                            "eid347",
                            "transform-origin",
                            415,
                            0,
                            "easeOutBack",
                            "${cabeza}",
                            [50,100],
                            [50,100],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("ventas_edgeActions.js");
})("EDGE-1928514");
