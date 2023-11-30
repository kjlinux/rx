@extends('main')
@push('style')
    <style>
        .badgebox {
            opacity: 0;
        }

        .badgebox+.badge {
            background-color: white;
            color: blue;
            text-indent: -999999px;
            width: 27px;
        }

        .badgebox:focus+.badge {
            box-shadow: inset 0px 0px 5px;
        }

        .badgebox:checked+.badge {
            text-indent: 0;
        }
    </style>
@endpush
@section('layout')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">RX > <strong>PRESCRIPTEURS</strong></h1>
            <!-- <a
                                                                      href="#"
                                                                      class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                                      ><i class="fas fa-download fa-sm text-white-50"></i> Generate
                                                                      Report</a
                                                                    > -->
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Informations d'un prescripteur
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- <label class="sr-only" for="inlineFormInputGroup">Username</label> -->

                        <table id="prescriber_table" class="display" width="100%"></table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    {{-- <button type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-success text-white\">Modifier</button> --}}
    <!-- Modal -->
    <div class="modal fade" id="prescriber_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Gérer les informations du prescripteur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-6">
                            <button class="btn btn-primary btn-lg text-white w-100"><i class="fas fa-pencil-alt"></i>
                                Modifier</button>
                        </div>
                        <div class="mb-4 col-6">
                            <button class="btn btn-danger btn-lg text-white w-100"><i
                                    class="fas fa-fw fa-trash"></i>Supprimer</button>
                        </div>
                    </div>
                    <form class="form-row">
                        <div class="input-group mb-4 col-4">
                            <input type="text" class="form-control" placeholder="Nom" id="name"
                                name="name" />
                        </div>
                        <div class="input-group mb-4 col-8">
                            <input type="text" class="form-control" placeholder="Prénom(s)" id="forename"
                                name="forename" />
                        </div>
                        <div class="input-group mb-4 col-6">
                            {{ html()->select($name = 'center', $options = $center_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Centre', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5'])->required() }}
                        </div>
                        <div class="input-group mb-4 col-6">
                            {{ html()->select($name = 'function', $options = $function_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Fonction', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5'])->required() }}
                        </div>
                        <div class="input-group mb-4 col-6">
                            {{ html()->select($name = 'speciality', $options = $speciality_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Spécialité', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5'])->required() }}
                        </div>                            
                        <div class="col-6"></div>
                        <div class="input-group-lg col-12 mb-2 mt-3">
                            <button type="submit" class="form-control bg-success text-white">
                                <span><i class="fas fa-check-circle"></i></span>
                                Valider les modifications apportées
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const dataSet = [
            ['Garrett Winters', 'Accountant', 'Tokyo', '8422', '2011/07/25', '$170,750'],
            ['Ashton Cox', 'Junior Technical Author', 'San Francisco', '1562', '2009/01/12', '$86,000'],
            ['Cedric Kelly', 'Senior Javascript Developer', 'Edinburgh', '6224', '2012/03/29', '$433,060'],
            ['Airi Satou', 'Accountant', 'Tokyo', '5407', '2008/11/28', '$162,700'],
            ['Brielle Williamson', 'Integration Specialist', 'New York', '4804', '2012/12/02', '$372,000'],
            ['Herrod Chandler', 'Sales Assistant', 'San Francisco', '9608', '2012/08/06', '$137,500'],
            ['Rhona Davidson', 'Integration Specialist', 'Tokyo', '6200', '2010/10/14', '$327,900'],
            ['Colleen Hurst', 'Javascript Developer', 'San Francisco', '2360', '2009/09/15', '$205,500'],
            ['Sonya Frost', 'Software Engineer', 'Edinburgh', '1667', '2008/12/13', '$103,600'],
            ['Jena Gaines', 'Office Manager', 'London', '3814', '2008/12/19', '$90,560'],
            ['Quinn Flynn', 'Support Lead', 'Edinburgh', '9497', '2013/03/03', '$342,000'],
            ['Charde Marshall', 'Regional Director', 'San Francisco', '6741', '2008/10/16', '$470,600'],
            ['Haley Kennedy', 'Senior Marketing Designer', 'London', '3597', '2012/12/18', '$313,500'],
            ['Tatyana Fitzpatrick', 'Regional Director', 'London', '1965', '2010/03/17', '$385,750'],
        ];

        new DataTable('#prescriber_table', {
            columns: [{
                    title: 'Name'
                },
                {
                    title: 'Position'
                },
                {
                    title: 'Office'
                },
                {
                    title: 'Extn.'
                },
                {
                    title: 'Start date'
                },
                {
                    title: 'Salary'
                },
                {
                    title: 'Action'
                }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json',
            },
            "columnDefs": [{
                "data": null,
                "defaultContent": "<button class=\"btn btn-danger text-white\" type=\"button\" data-toggle=\"modal\" data-target=\"#prescriber_modal\">Gérer</button>",
                "targets": -1
            }],
            select: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'colvis'
            ],
            data: dataSet
        });
    </script>
@endpush
