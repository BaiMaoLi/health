// var data=[];
// var n_divde=30;
// var score=[];
// var mean_value;
// var std_value;
// var density_value=[];
// function  readCsv() {
//     var k=0;
//     Papa.parse("data_2.csv", {
//         download: true,
//         step: function(row) {
//             data[k]=row.data;
//             k++;
//         },
//         complete: function(result) {
//             data.shift();
//             score=getData(data);
//             mean_value=getMean(score);
//             std_value=getStd(mean_value,score);
//             var hist_data=binData(score);
//             renderChart(hist_data);
//             getDensityFunction(mean_value,std_value,hist_data);
//             console.log(density_value);
//
//         }
//     });
// }
//
// function getData(data) {
//     var x=[];
//     for (var i=0;i<data.length;i++){
//         x[i]=data[i][0][0];
//     }
//     return x;
// }
//
// function getDensity(mean,std,x) {
//     var x=1;
//     x=1/Math.sqrt(parseFloat(std)*2*Math.PI)*Math.exp(-Math.pow(parseFloat(x)-parseFloat(mean),2)/(2*parseFloat(std)));
//     return x;
// }
//
// function getDensityFunction(mean,std,data) {
//
//     for (var i=0;i<data.length;i++){
//         density_value[i]=[];
//         density_value[i][1]=getDensity(mean,std,data[i][0]);
//         density_value[i][0]=data[i][0];
//     }
// }
//
//
//
// function binData(data) {
//     var hData = new Array(), //the output array
//         size = data.length, //how many data points
//         bins = Math.round(Math.sqrt(size)); //determine how many bins we need
//     bins = bins > n_divde ? n_divde : bins; //adjust if more than 50 cells
//     var max = Math.max.apply(null, data), //lowest data value
//         min = Math.min.apply(null, data), //highest data value
//         range = max - min, //total range of the data
//         width = range / bins, //size of the bins
//         bin_bottom, //place holders for the bounds of each bin
//         bin_top;
//
//     //loop through the number of cells
//     for (var i = 0; i < bins; i++) {
//
//         //set the upper and lower limits of the current cell
//         bin_bottom = min + (i * width);
//         bin_top = bin_bottom + width;
//
//         //check for and set the x value of the bin
//         if (!hData[i]) {
//             hData[i] = new Array();
//             hData[i][0] = bin_bottom + (width / 2);
//         }
//
//         //loop through the data to see if it fits in this bin
//         for (var j = 0; j < size; j++) {
//             var x = data[j];
//
//             //adjust if it's the first pass
//             i == 0 && j == 0 ? bin_bottom -= 1 : bin_bottom = bin_bottom;
//
//             //if it fits in the bin, add it
//             if (x > bin_bottom && x <= bin_top) {
//                 !hData[i][1] ? hData[i][1] = 1 : hData[i][1]++;
//             }
//         }
//     }
//     $.each(hData, function(i, point) {
//         if (typeof point[1] == 'undefined') {
//             hData[i][1] = null;
//         }
//     });
//     return hData;
// }
//
// function getMean(data) {
//     var x=0;
//     for (var i=0;i<data.length;i++)
//         if (data[i].length>0)
//             x+=parseFloat(data[i]);
//
//     x=x/data.length;
//
//     return x;
// }
//
// function getStd(meanValue,data) {
//     var s=0;
//     for (var i=0;i<data.length;i++)
//         if (data[i].length>0)
//             s+=Math.pow(parseFloat(data[i])-parseFloat(meanValue),2);
//     s=Math.sqrt(s);
//     s=s/data.length;
//     return s;
// }
//
// function renderChart(data) {
//     var chart = new Highcharts.Chart({
//         chart: {
//             renderTo:'container',
//             type: 'column',
//             margin: [100, 25, 100, 100]
//         },
//         legend: {
//             enabled: true
//         },
//         tooltip: {},
//         plotOptions: {
//             series: {
//                 showInLegend: false,
//                 pointPadding: 0,
//                 groupPadding: 0,
//                 borderWidth: 0.5,
//                 borderColor: 'rgba(255,255,255,0.5)'
//             }
//         },
//         xAxis: [{
//             title: {
//                 text: 'Score'
//             },
//             min: 0,
//         },
//             {
//                 linkedTo: 0,
//                 opposite: true,
//                 gridLineWidth: 0,
//                 gridLineColor: 'rgba(0,0,0,0.25)',
//                 gridZIndex: 8,
//                 tickLength: 0,
//                 min:0,
//                 title: {
//                     text: null
//                 },
//                 labels: {
//                     style: {
//                         color: 'rgba(0,0,0,0)',
//                         fomntWeight: 'bold'
//                     },
//                     formatter: function() {
//                         return Highcharts.numberFormat(this.value, 2);
//                     }
//                 }
//             }
//         ],
//
//         yAxis: [{
//             title: {
//                 text: 'Percentage of category outcomes'
//             },
//             min: 0,
//         },
//             {
//                 linkedTo: 0,
//                 opposite: true,
//                 gridLineWidth: 0,
//                 gridLineColor: 'rgba(0,0,0,0)',
//                 gridZIndex: 8,
//                 tickLength: 0,
//
//                 labels: {
//                     style: {
//                         color: 'rgba(0,0,0,0)',
//                         fomntWeight: 'bold'
//                     },
//                     formatter: function() {
//                         return Highcharts.numberFormat(this.value, 2);
//                     }
//                 }
//             }
//
//
//         ],
//         series:{
//             name: 'Distribution',
//             data: data
//         }
//     });
//
//     // chart.addSeries({
//     //         name: 'Distribution',
//     //         data: data
//     //     },
//     // );
//
// }
//
//




var data=[];
var n_divde=20;
var score=[];
var mean_value;
var std_value;
var density_value=[];

function  readCsv() {
    var k=0;
    Papa.parse("data_2.csv", {
        download: true,
        step: function(row) {
            data[k]=row.data;
            k++;
        },
        complete: function(result) {
            data.shift();
            var remainder=data.length % n_divde;

            score=getData(data);
            mean_value=getMean(score);
            std_value=getStd(mean_value,score);
            var hist_data=binData(score);
            // renderChart(hist_data);

            getDensityFunction(mean_value,std_value,hist_data);
            renderChart(hist_data);
           $('#display_mean_value').text('N='+n_divde+',  Mean='+(parseFloat(mean_value)*100).toFixed(2)+"%");
            $('#display_mean_value').append('<div class="line"></div>');


        }
    });
}

function getData(data) {

    var x=[];
    for (var i=0;i<data.length;i++){
        x[i]=data[i][0][0];
    }
    return x;
}

function getDensity(mean,std,x) {
    var y=1;
    y=1/parseFloat(std)/Math.sqrt(2*Math.PI)*Math.exp(-1*Math.pow(parseFloat(x)-parseFloat(mean),2)/(2*Math.pow(parseFloat(std),2)));
    return y;
}

function getDensityFunction(mean,std,data1) {
    for (var i=0;i<data1.length;i++){
        density_value[i]=[];
        console.log(data1[i][0]);
        density_value[i][1]=getDensity(mean,std,data1[i][0])*data.length/n_divde;
        density_value[i][0]=data1[i][0];
    }
}



function binData(data) {
    var hData = new Array(), //the output array
        size = data.length, //how many data points
        bins = Math.round(Math.sqrt(size)); //determine how many bins we need
        // bins = bins > n_divde ? n_divde : bins; //adjust if more than 50 cells
    bins = n_divde;
    var max = Math.max.apply(null, data), //lowest data value
        min = Math.min.apply(null, data), //highest data value
        range = max - min, //total range of the data
        width = range / bins, //size of the bins
        bin_bottom, //place holders for the bounds of each bin
        bin_top;

    //loop through the number of cells
    for (var i = 0; i < bins; i++) {

        //set the upper and lower limits of the current cell
        bin_bottom = min + (i * width);
        bin_top = bin_bottom + width;

        //check for and set the x value of the bin
        if (!hData[i]) {
            hData[i] = new Array();
            hData[i][0] = bin_bottom + (width / 2);
        }

        //loop through the data to see if it fits in this bin
        for (var j = 0; j < size; j++) {
            var x = data[j];

            //adjust if it's the first pass
            i == 0 && j == 0 ? bin_bottom -= 1 : bin_bottom = bin_bottom;

            //if it fits in the bin, add it
            if (x > bin_bottom && x <= bin_top) {
                !hData[i][1] ? hData[i][1] = 1 : hData[i][1]++;
            }
        }
    }
    $.each(hData, function(i, point) {
        if (typeof point[1] == 'undefined') {
            hData[i][1] = null;
        }
    });
    return hData;
}

function getMean(data) {
    var x=0;
    for (var i=0;i<data.length;i++)
        if (data[i].length>0)
            x+=parseFloat(data[i]);
    x=x/data.length;
    return x;
}

function getStd(meanValue,data) {
    var s=0;
    for (var i=0;i<data.length;i++)
        if (data[i].length>0)
            s+=Math.pow(parseFloat(data[i])-parseFloat(meanValue),2);
    s=Math.sqrt(s);
    s=s/Math.sqrt(data.length-1);
    return s;
}

function renderChart(data) {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: [100, 25, 100, 100]
        },
        legend: {
            enabled: true
        },
        tooltip: {},
        plotOptions: {
            series: {
                showInLegend: false,
                pointPadding: 0,
                groupPadding: 0,
                borderWidth: 0.5,
                borderColor: 'rgba(255,255,255,0.5)'
            }
        },
        xAxis: [{
            title: {
                text: 'Score'
            },
            min: 0,
        },
            {
            linkedTo: 0,
            opposite: true,
            gridLineWidth: 0,
            gridLineColor: 'rgba(0,0,0,0.25)',
            gridZIndex: 8,
            tickLength: 0,
            min:0,
            title: {
                text: null
            },
            labels: {
                style: {
                    color: 'rgba(0,0,0,0)',
                    fomntWeight: 'bold'
                },
                formatter: function() {
                    return Highcharts.numberFormat(this.value, 2);
                }
            }
        }
        ],

        yAxis: [{
                title: {
                    text: 'Percentage of category outcomes'
                },
                min: 0,
            },
                {
                linkedTo: 0,
                opposite: true,
                gridLineWidth: 0,
                gridLineColor: 'rgba(0,0,0,0)',
                gridZIndex: 8,
                tickLength: 0,

                labels: {
                    style: {
                        color: 'rgba(0,0,0,0)',
                        fomntWeight: 'bold'
                    },
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 2);
                    }
                }
            }


        ]
    });
    chart = $('#container').highcharts();
    chart.addSeries(
            {
                name: 'Distribution',
                data: data
            },
      );
    chart.addSeries({
        type:'spline',
        name:'Spline Data',
        data:density_value
    });
}
