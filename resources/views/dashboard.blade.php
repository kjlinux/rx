@extends('main')
@section('layout')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Patients aujourd'hui
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    21
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-procedures fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Encaissé aujourd'hui
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    80000 FCFA
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
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
                                            21000 FCFA
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total à payer aux prescripteurs
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    21000 FCFA
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

        <!-- Content Row -->

        <div class="row">
            <!-- Area Chart -->
            <div id="container" class="col-xl-8 col-lg-7">
                {{-- <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Encaissements mensuels
                        </h6>
                        <div class="dropdown no-arrow">
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
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Pie Chart -->
            <div id="pie" class="col-xl-4 col-lg-5">
                {{-- <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Top 3 des examens réalisés
                        </h6>
                        <div class="dropdown no-arrow">
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
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i>
                                Direct
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i>
                                Social
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i>
                                Referral
                            </span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div id="area" class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                {{-- <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Examens les plus réalisés</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">
                            Server Migration <span class="float-right">20%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Sales Tracking <span class="float-right">40%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Customer Database <span class="float-right">60%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Payout Details <span class="float-right">80%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Account Setup <span class="float-right">Complete!</span>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div> --}}

                <!-- Color System -->
            </div>

            <div id="line" class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                {{-- <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Nombre d'examens ce mois</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">
                            Server Migration <span class="float-right">20%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Sales Tracking <span class="float-right">40%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Customer Database <span class="float-right">60%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Payout Details <span class="float-right">80%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">
                            Account Setup <span class="float-right">Complete!</span>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div> --}}

                <!-- Color System -->
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // Data retrieved from https://www.ssb.no/energi-og-industri/olje-og-gass/statistikk/sal-av-petroleumsprodukt/artikler/auka-sal-av-petroleumsprodukt-til-vegtrafikk
        Highcharts.chart('container', {
            title: {
                text: 'Statistiques des services de radiologie',
                align: 'left'
            },
            xAxis: {
                categories: ['Radiographies', 'Scanners CT', 'IRM', 'Échographie', 'Fluoroscopie']
            },
            yAxis: {
                title: {
                    text: 'Nombre de procédures'
                }
            },
            tooltip: {
                valueSuffix: ' procédures'
            },
            plotOptions: {
                series: {
                    borderRadius: '25%'
                }
            },
            series: [{
                type: 'column',
                name: '2020',
                data: [120, 85, 60, 40, 30]
            }, {
                type: 'column',
                name: '2021',
                data: [110, 90, 65, 45, 28]
            }, {
                type: 'column',
                name: '2022',
                data: [125, 95, 70, 50, 32]
            }, {
                type: 'line',
                step: 'center',
                name: 'Moyenne',
                data: [118.33, 90, 65, 45, 30],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white'
                }
            }, {
                type: 'pie',
                name: 'Total',
                data: [{
                    name: '2020',
                    y: 335,
                    color: Highcharts.getOptions().colors[0], // Couleur 2020
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        format: '{point.total} Procédures',
                        style: {
                            fontSize: '15px'
                        }
                    }
                }, {
                    name: '2021',
                    y: 338,
                    color: Highcharts.getOptions().colors[1] // Couleur 2021
                }, {
                    name: '2022',
                    y: 372,
                    color: Highcharts.getOptions().colors[2] // Couleur 2022
                }],
                center: [75, 65],
                size: 100,
                innerSize: '70%',
                showInLegend: false,
                dataLabels: {
                    enabled: false
                }
            }]
        });



        Highcharts.chart('pie', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Composition des procédures de radiologie'
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
                            fontSize: '0.5em',
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
                name: 'Pourcentage',
                colorByPoint: true,
                data: [{
                        name: 'Radiographies',
                        y: 35.02
                    },
                    {
                        name: 'Scanners CT',
                        sliced: true,
                        selected: true,
                        y: 26.71
                    },
                    {
                        name: 'IRM',
                        y: 15.09
                    },
                    {
                        name: 'Échographie',
                        y: 18.5
                    },
                    {
                        name: 'Fluoroscopie',
                        y: 4.68
                    }
                ]
            }]
        });


        Highcharts.chart('area', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'Émissions de gaz à effet de serre liées à l\'activité médicale de radiologie',
                align: 'left'
            },
            yAxis: {
                title: {
                    useHTML: true,
                    text: 'Millions de tonnes d\'équivalents CO<sub>2</sub>'
                }
            },
            tooltip: {
                shared: true,
                headerFormat: '<span style="font-size:12px"><b>{point.key}</b></span><br>'
            },
            plotOptions: {
                series: {
                    pointStart: 2012
                },
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },
            series: [{
                name: 'Radiographies',
                data: [5, 6, 8, 10, 12, 9, 7, 5, 4]
            }, {
                name: 'Scanners CT',
                data: [4, 5, 7, 9, 11, 8, 6, 4, 3]
            }, {
                name: 'IRM',
                data: [3, 4, 6, 8, 10, 7, 5, 3, 2]
            }, {
                name: 'Échographie',
                data: [2, 3, 5, 7, 9, 6, 4, 2, 1]
            }, {
                name: 'Fluoroscopie',
                data: [1, 2, 3, 4, 5, 3, 2, 1, 0]
            }]
        });


        Highcharts.chart('line', {

            title: {
                text: 'Croissance du Chiffre d\'Affaires du Service de Radiologie',
                align: 'left'
            },

            yAxis: {
                title: {
                    text: 'Chiffre d\'Affaires (en millions de francs)'
                }
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'Plage : 2010 à 2020'
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
                    pointStart: 2010
                }
            },

            series: [{
                name: 'Imagerie Médicale',
                data: [15, 20, 25, 30, 35, 40,
                    45, 50, 55, 60, 65
                ]
            }, {
                name: 'Consultations Spécialisées',
                data: [10, 15, 20, 25, 30, 35,
                    40, 45, 50, 55, 60
                ]
            }, {
                name: 'Interventions Chirurgicales',
                data: [5, 10, 15, 20, 25, 30,
                    35, 40, 45, 50, 55
                ]
            }, {
                name: 'Services de Radiologie Interventionnelle',
                data: [2, 5, 8, 12, 15, 18,
                    20, 22, 25, 28, 30
                ]
            }, {
                name: 'Autres Services',
                data: [8, 12, 15, 18, 20, 22,
                    25, 28, 30, 32, 35
                ]
            }],

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
    </script>
@endpush
