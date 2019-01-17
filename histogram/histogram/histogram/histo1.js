var chart = new Highcharts.Chart({
    chart:{
        renderTo:'container',
        type:'column',
        alignTicks:false,
        marginTop:25
    },
    exporting:{enabled:false},
    title:{text:''},
    tooltip:{
        borderWidth:1,
        formatter:function() {
            return '<b>Range:</b><br/> '+ this.x +'<br/>'+
                '<b>Count:</b> '+ this.y;
        }
    },
    plotOptions:{
        series:{
            minPointLength:1,
            shadow:false,
            marker:{enabled:false}
        },
        // area:{
        //     events:{
        //         legendItemClick: function() {
        //             if (this.name == 'Sigma Bands') {
        //                 toggleBands(chart);
        //             }
        //         }
        //     }
        // }
    },
    xAxis: {
        lineColor:'#999',
        tickColor:'#ccc'
        ,plotLines:[{"value":0.052742011049155,"width":2,"color":"#666","zIndex":10,"dashStyle":"Dash","label":{"text":"m","rotation":0,"align":"center","x":0,"y":-5,"style":{"fontSize":"10px"}}},{"value":-0.89967056903087,"width":1,"color":"#999","dashStyle":"Dash","zIndex":10,"label":{"text":"-1s","rotation":0,"align":"center","x":0,"y":-5,"style":{"fontSize":"10px"}}},{"value":1.0051545911292,"width":1,"color":"#999","dashStyle":"Dash","zIndex":10,"label":{"text":"+1s","rotation":0,"align":"center","x":0,"y":-5,"style":{"fontSize":"10px"}}},{"value":-1.8520831491109,"width":1,"color":"#999","dashStyle":"Dash","zIndex":10,"label":{"text":"-2s","rotation":0,"align":"center","x":0,"y":-5,"style":{"fontSize":"10px"}}},{"value":1.9575671712092,"width":1,"color":"#999","dashStyle":"Dash","zIndex":10,"label":{"text":"+2s","rotation":0,"align":"center","x":0,"y":-5,"style":{"fontSize":"10px"}}},{"value":-2.8044957291909,"width":1,"color":"#999","dashStyle":"Dash","zIndex":10,"label":{"text":"-3s","rotation":0,"align":"center","x":0,"y":-5,"style":{"fontSize":"10px"}}},{"value":2.9099797512892,"width":1,"color":"#999","dashStyle":"Dash","zIndex":10,"label":{"text":"+3s","rotation":0,"align":"center","x":0,"y":-5,"style":{"fontSize":"10px"}}}],plotBands:[{"from":-0.89967056903087,"to":1.0051545911292,"color":"rgba(184,210,236,.1)","zIndex":0},{"from":-1.8520831491109,"to":1.9575671712092,"color":"rgba(184,210,236,.1)","zIndex":0},{"from":-2.8044957291909,"to":2.9099797512892,"color":"rgba(184,210,236,.1)","zIndex":0}]			},
    yAxis:{
        title:{text:''},
        gridLineColor:'#e9e9e9',
        tickWidth:1,
        tickLength:3,
        tickColor:'#ccc',
        lineColor:'#ccc',
        endOnTick:false,			},
    series:[{
        name:'Sample Distribution',
        data:[[-2.3138013781265,1],[-2.0943590644815,4],[-1.8749167508365,11],[-1.6554744371915,12],[-1.4360321235466,18],[-1.2165898099016,18],[-0.99714749625658,24],[-0.77770518261159,21],[-0.55826286896661,36],[-0.33882055532162,40],[-0.11937824167663,51],[0.10006407196835,40],[0.31950638561334,42],[0.53894869925832,36],[0.75839101290331,40],[0.9778333265483,36],[1.1972756401933,23],[1.4167179538383,18],[1.6361602674833,9],[1.8556025811282,12],[2.0750448947732,3],[2.2944872084182,4]],
        pointRange:0.21944231364499,
        borderWidth:.5,
        borderColor:'#666',
        pointPadding:.015,
        groupPadding:0,
        color:'#e3e3e3'
    },{
        type:'spline',
        lineWidth:1,
        name:'Normal Distribution',
        color:'rgba(90,155,212,.75)',
        fillColor:'rgba(90,155,212,.15)',
        data:[[-3.2807020192309,0.10168053006185],[-3.0425988742109,0.23641431548771],[-2.8044957291909,0.51637633957668],[-2.5663925841709,1.0595354537927],[-2.3282894391509,2.0423080409267],[-2.0901862941309,3.6981421093266],[-1.8520831491109,6.2907516383431],[-1.6139800040909,10.052592494842],[-1.3758768590709,15.090728685704],[-1.1377737140509,21.28133847858],[-0.89967056903087,28.193192861774],[-0.66156742401087,35.086995418605],[-0.42346427899086,41.020853564556],[-0.18536113397085,45.052593912695],[0.052742011049155,46.482716760157],[0.29084515606916,45.052593912695],[0.52894830108917,41.020853564556],[0.76705144610918,35.086995418605],[1.0051545911292,28.193192861773],[1.2432577361492,21.28133847858],[1.4813608811692,15.090728685704],[1.7194640261892,10.052592494842],[1.9575671712092,6.2907516383431],[2.1956703162292,3.6981421093266],[2.4337734612492,2.0423080409267],[2.6718766062692,1.0595354537927],[2.9099797512892,0.51637633957668],[3.1480828963092,0.23641431548771]]			},{
        type:'area',
        name:'Sigma Bands',
    }]
});

// function toggleBands(chart) {
//     $.each(chart.xAxis[0].plotLinesAndBands, function(index,el){
//         if(el.svgElem != undefined) {
//             el.svgElem[ el.visible ? 'show' : 'hide' ]();
//             el.visible = !el.visible;
//         }
//     });
// }