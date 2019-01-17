var data=[];
var n_divde=5;
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
            makeHistogram(data);
        }
    });
}

function makeHistogram(data1) {
    var seg_length=data1.length % n_divde;
    for (var i=0;i<seg_length;i++)
        data1.pop();
    seg_length=data1.length/n_divde;
    var x=[];
    var y=[];
    for (var i=0;i<n_divde;i++){
        y[i]=0;
        x[i]=parseFloat(i/n_divde*100).toFixed(2)+"%";
        for (j=0;j<seg_length;j++){
            y[i]+=parseFloat(data1[seg_length*i+j][0][0]);
        }
        y[i]/=seg_length*100;
    }
    console.log(y);
    console.log(x);
    drawBarChart(x,y);
}

function drawBarChart(x1,y1) {
    var datapoints=[];
    for (var i=0;i<x1.length;i++){
        var temp={};
        temp.x=x1[i];
        temp.y=y1[i];
        datapoints[i]=temp;
    }
    var chartData = {
        labels: x1,
        datasets: [{
            type: 'line',
            label: 'Dataset 1',
            borderColor: '#006bf3',
            borderWidth: 2,
            fill: false,
            data: y1
        }, {
            type: 'bar',
            backgroundColor: '#bac5f8',
            borderColor:'#7789c7',
            data:y1,
            borderColor: 'white',
            borderWidth: 2
        }]
    };
    var ctx=document.getElementById('chartContainer');
    var chart = new Chart(ctx, {
        type:'bar',
        data: chartData,
        options: {
            responsive: true,
            label:{
              display:false
            },
            title: {
                // display: true,
                text: 'Chart.js Combo Bar Line Chart'
            },
            tooltips: {
                mode: 'index',
                // intersect: true
            },
            layout: {
                padding: {
                    left: 100,
                    right: 100,
                    top: 0,
                    bottom: 0
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    },
                     gridLines: {
                        drawOnChartArea: false
                    }
                }],
                xAxes: [{
                    barPercentage: 1,
                    categoryPercentage: 1,
                    gridLines: {
                        drawOnChartArea: false
                    }
                }]
            }
        }
    });
    chart.render();
}

