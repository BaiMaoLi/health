var data=[];
var n_divde=50;
var score=[];
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
            score=getData(data)
            hist_data=binData(score);
            console.log(hist_data);
            renderChart(hist_data);
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

function binData(data) {
    var hData = new Array(), //the output array
        size = data.length, //how many data points
        bins = Math.round(Math.sqrt(size)); //determine how many bins we need
        bins = bins > n_divde ? n_divde : bins; //adjust if more than 50 cells
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
            // hData[i][1] = 0;
        }
    });
    return hData;
}

//get any percentile from an array
function getPercentile(data, percentile) {
    data.sort(numSort);
    var index = (percentile / 100) * data.length;
    var result;
    if (Math.floor(index) == index) {
        result = (data[(index - 1)] + data[index]) / 2;
    } else {
        result = data[Math.floor(index)];
    }
    return result;
}
//get the median absolute deviation
function getMad(data) {
    var median = getPercentile(data, 50);
    var devs = [];
    $.each(data, function(i, point) {
        devs.push(Math.abs(point - median));
    });
    var mad = getPercentile(devs, 50);
    var output = {};
    output.median = median;
    output.mad = mad;
    return output;
}

function numSort(a, b) {
    return a - b;
}



function renderChart(data) {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: [100, 25, 100, 50]
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
                text: 'Range'
            }

        },
        //     {
        //     linkedTo: 0,
        //     opposite: true,
        //     gridLineWidth: 0.5,
        //     gridLineColor: 'rgba(0,0,0,0.25)',
        //     gridZIndex: 8,
        //     title: {
        //         text: 'Median and MAD'
        //     },
        //     labels: {
        //         style: {
        //             color: 'rgba(0,0,0,1)',
        //             fomntWeight: 'bold'
        //         },
        //         formatter: function() {
        //             return Highcharts.numberFormat(this.value, 2);
        //         }
        //     }
        // }
        ],

        yAxis: {

            title: {
                text: 'Percentage of category outcomes'
            },
            min: 0
        }
    }
    );
    chart = $('#container').highcharts();
    chart.addSeries({
        name: 'Distribution',
        data: data
    });



}
