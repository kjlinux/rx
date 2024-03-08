@extends('main')
@section('layout')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">RX > <strong>TABLEAU DE BORD</strong></h1>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Patients aujourd'hui
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $datas['countPatientsToday'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-procedures fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Encaissé aujourd'hui
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $datas['totalRevenueToday'] }} FCFA
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total restant à payer pour les patients
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $datas['totalRemainingToPay'] }} FCFA
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total à payer aux prescripteurs
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $datas['totalToPayPrescribers'] }} FCFA
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-7 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Recettes générées
                        </h6>
                        {{-- <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div id="line_revenue">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Répartition des prescripteurs par spécialité
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="pie_prescriber_speciality">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Top examens les plus prescrits</h6>
                    </div>
                    <div id="column_top_exams" class="card-body">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Heures de la journée les plus fréquentées pour les
                            examens</h6>
                    </div>
                    <div id="bar_busy_hours" class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        Highcharts.chart('line_revenue', {
            title: {
                text: '{{ $datas['line_revenue']['title'] }}',
                align: 'left'
            },
            yAxis: {
                title: {
                    text: null
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
                    pointStart: 1
                }
            },
            series: @json($datas['line_revenue']['data']),
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

        Highcharts.chart('pie_prescriber_speciality', {
            chart: {
                type: 'pie'
            },
            title: {
                text: '{{ $datas['pie_prescriber_speciality']['title'] }}'
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
            series: [{
                name: 'Proportion',
                colorByPoint: true,
                data: @json($datas['pie_prescriber_speciality']['data'])
            }]
        });

        Highcharts.chart('column_top_exams', {
            chart: {
                type: 'column'
            },
            title: {
                text: '{{ $datas['column_top_exams']['title'] }}',
                align: 'left'
            },
            xAxis: {
                categories: @json($datas['column_top_exams']['categories']),
                crosshair: true,
            },
            yAxis: {
                min: 0,
                title: {
                    text: null
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: '{{ $datas['column_top_exams']['name'] }}',
                data: @json($datas['column_top_exams']['data'])
            }]
        });

        Highcharts.chart('bar_busy_hours', {
            chart: {
                type: 'bar'
            },
            title: {
                text: '{{ $datas['bar_busy_hours']['title'] }}',
                align: 'left'
            },
            xAxis: {
                categories: @json($datas['bar_busy_hours']['categories']),
                title: {
                    text: null
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                title: {
                    text: null,
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                },
                gridLineWidth: 0
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
                name: '{{ $datas['bar_busy_hours']['name'] }}',
                data: @json($datas['bar_busy_hours']['data'])
            }]
        });
    </script>
@endpush
