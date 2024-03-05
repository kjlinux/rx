function draw(chart, title, data, name = null, categories = null, text = null, tooltip = null) {
    if (chart === 'bar') {
        drawBar(title, name, categories, data, text = null, tooltip = null);
    }
    if (chart === 'pie') {
        drawPie(title, data);
    }
    if (chart === 'column') {
        drawColumn(title, name, categories, data, text = null, tooltip = null);
    }
    if (chart === 'line') {
        drawLine(title, data, text = null);
    }
}

function drawBar(title, name, categories, data, text = null, tooltip = null) {
    Highcharts.chart('container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: title,
            align: 'left'
        },
        xAxis: {
            categories: categories,
            title: {
                text: null
            },
            gridLineWidth: 1,
            lineWidth: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: text,
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            },
            gridLineWidth: 0
        },
        tooltip: {
            valueSuffix: tooltip
        },
        plotOptions: {
            bar: {
                borderRadius: '50%',
                dataLabels: {
                    enabled: true
                },
                groupPadding: 0.1
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        series: [{
            name: name,
            data: data
        }]
    });
}

function drawPie(title, data) {
    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: title
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [
            {
                name: 'Proportion',
                colorByPoint: true,
                data: data
            }
        ]
    });
}

function drawColumn(title, name, categories, data, text = null, tooltip = null) {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: title,
            align: 'left'
        },
        xAxis: {
            categories: categories,
            crosshair: true,
        },
        yAxis: {
            min: 0,
            title: {
                text: text
            }
        },
        tooltip: {
            valueSuffix: tooltip
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: name,
                data: data
            }
        ]
    });
}

function drawLine(title, data, text = null) {
    Highcharts.chart('container', {
        title: {
            text: title,
            align: 'left'
        },
        yAxis: {
            title: {
                text: text
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
            }
        },
        series: data,
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
}
