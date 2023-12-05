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
            <h1 class="h3 mb-0 text-gray-800">RX > <strong>PATIENTS</strong></h1>
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
                            Informations d'un patient
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- <label class="sr-only" for="inlineFormInputGroup">Username</label> -->

                        <table id="patient_table" class="display" width="100%"></table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    {{-- <button type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-success text-white\">Modifier</button> --}}
    <!-- Modal -->
    <div class="modal fade" id="patient_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Gérer les informations du patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-4 col-4">
                            <button id="update" class="btn btn-primary btn-lg text-white w-100"><i
                                    class="fas fa-pencil-alt"></i>
                                Modifier</button>
                        </div>
                        <div class="mb-4 col-4">
                            <button class="btn btn-secondary btn-lg text-white w-100"><i
                                    class="fas fa-fw fa-print"></i><span>Imprimer
                                    reçu</span></button>
                        </div>
                        <div class="mb-4 col-4">
                            <button class="btn btn-danger btn-lg text-white w-100"><i
                                    class="fas fa-fw fa-trash"></i>Supprimer</button>
                        </div>
                    </div>
                    <form id="new_examination" class="form-row d-none">
                        <div class="input-group mb-4 col-3">
                            <input type="text" class="form-control" placeholder="Nom" id="name" name="name" />
                        </div>
                        <div class="input-group mb-4 col-6">
                            <input type="text" class="form-control" placeholder="Prénom(s)" id="forenames"
                                name="forenames" />
                        </div>
                        <div class="input-group mb-4 col-3">
                            <input type="number" class="form-control" placeholder="Age" id="year" name="year">
                            <div class="input-group-append">
                                <span class="input-group-text" id="year">ans</span>
                            </div>
                        </div>
                        <div class="input-group-lg mb-4 col-2">
                            {{ html()->select($name = 'gender', $options = ['M' => 'M', 'F' => 'F'])->class('input-group selectpicker fit')->attributes(['title' => 'Genre', 'data-width' => '100%'])->required() }}
                        </div>
                        <div class="input-group mb-4 col-4">
                            {{ html()->select($name = 'prescriber', $options = ['t' => 'test'])->class('input-group selectpicker show-tick')->attributes(['title' => 'Prescripteur(s)', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5', 'data-multiple-separator' => ' | '])->multiple()->required() }}
                        </div>
                        <div class="input-group mb-4 col-6">
                            {{ html()->select($name = 'center', $options = $center_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Centre', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5'])->required() }}
                        </div>
                        <div class="input-group mb-4 col-12">
                            {{ html()->select($name = 'examination', $options = $exam_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Examen', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '7', 'data-multiple-separator' => ' | '])->multiple()->required() }}
                        </div>
                        <div class="input-group mb-4 col-12">
                            <textarea class="form-control" id="clinical_information" name="clinical_information" rows="2"
                                placeholder="Renseignements cliniques"></textarea>
                        </div>
                        <div class="input-group mb-4 col-3">
                            <input data-inputmask="'mask': '99-99-99-99-99'" type="text" class="form-control"
                                placeholder="Numéro de téléphone" id="phone" name="phone" />
                        </div>
                        <div class="input-group pb-2 col-4">
                            <input type="number" class="form-control" placeholder="Total à payer" id="total_amount"
                                name="total_amount" disabled>
                            <div class="input-group-append mb-5">
                                <span class="input-group-text" id="total_amount">FCFA</span>
                            </div>
                        </div>
                        <div class="input-group pb-5 col-5">
                            <label for="payed_bool" class="btn btn-primary">Le patient a payé la
                                totalité.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="payed_bool" name="payed_bool" class="badgebox" checked><span
                                    class="badge">&check;</span></label>
                        </div>
                        <div class="input-group input-group mb-2 mt-n4 col-6">
                            <input type="number" class="form-control" placeholder="Montant payé" id="payed_amount"
                                name="payed_amount">
                            <div class="input-group-append">
                                <span class="input-group-text" id="payed_amount">FCFA</span>
                            </div>
                        </div>
                        <div class="input-group input-group mb-2 mt-n4 col-6">
                            <input type="number" class="form-control" placeholder="Reste à payer" id="left_to_pay"
                                name="left_to_pay" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text" id="left_to_pay">FCFA</span>
                            </div>
                        </div>
                        <div class="input-group-lg col-6 mb-2 mt-3">
                            <button class="form-control bg-secondary text-white">
                                <i class="fas fa-times"></i>
                                Vider les champs
                            </button>
                        </div>
                        <div class="input-group-lg col-6 mb-2 mt-3">
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
            ['1', 'Garrett Winters', 'Accountant', 'Tokyo', '8422', '2011/07/25', '$170,750'],
            ['2', 'Ashton Cox', 'Junior Technical Author', 'San Francisco', '1562', '2009/01/12', '$86,000'],
            ['3', 'Cedric Kelly', 'Senior Javascript Developer', 'Edinburgh', '6224', '2012/03/29', '$433,060'],
            ['4', 'Airi Satou', 'Accountant', 'Tokyo', '5407', '2008/11/28', '$162,700'],
            ['5', 'Brielle Williamson', 'Integration Specialist', 'New York', '4804', '2012/12/02', '$372,000'],
            ['6', 'Herrod Chandler', 'Sales Assistant', 'San Francisco', '9608', '2012/08/06', '$137,500'],
            ['7', 'Rhona Davidson', 'Integration Specialist', 'Tokyo', '6200', '2010/10/14', '$327,900'],
            ['8', 'Colleen Hurst', 'Javascript Developer', 'San Francisco', '2360', '2009/09/15', '$205,500'],
            ['9', 'Sonya Frost', 'Software Engineer', 'Edinburgh', '1667', '2008/12/13', '$103,600'],
            ['10', 'Jena Gaines', 'Office Manager', 'London', '3814', '2008/12/19', '$90,560'],
            ['11', 'Quinn Flynn', 'Support Lead', 'Edinburgh', '9497', '2013/03/03', '$342,000'],
            ['12', 'Charde Marshall', 'Regional Director', 'San Francisco', '6741', '2008/10/16', '$470,600'],
            ['13', 'Haley Kennedy', 'Senior Marketing Designer', 'London', '3597', '2012/12/18', '$313,500'],
            ['14', 'Tatyana Fitzpatrick', 'Regional Director', 'London', '1965', '2010/03/17', '$385,750'],
        ];

        var table = new DataTable('#patient_table', {
            columns: [{
                    title: 'id'
                },
                {
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
                }
            ],
            // language: {
            //     url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json',
            // },
            select: true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'colvis'
            ],
            data: dataSet
        });

        $(document).ready(function() {
            
            table.button().add(null, {
                action: function() {
                    if (table.row({
                            selected: true
                        }).any()) {
                        $('#patient_modal').modal('show');
                    } else {
                        Swal.fire({
                            title: "Sélectionnez d'abord un patient.",
                            icon: "error",
                            showConfirmButton: false,
                            timer : 1500
                        });
                    }
                },
                text: 'Gérer',
                className: 'btn btn-success',
                key: 'g'
            });

            // table.column(0).visible(false);
            $('#update').on('click', function() {
                var id = table.row({
                    selected: true
                }).data()[0];
                console.log(id);
            })

            // $('#patient_table').on('click', 'tr', function() {
            //     var id = table.row(this).id();
            //     console.log(id);
            // });

            // $('#patient_table').on('click', 'tr', function() {
            //     var id = table.row(this).index();
            //     console.log(id);
            // });

        })
    </script>
@endpush
