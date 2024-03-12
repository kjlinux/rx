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
                            <button id="update" class="btn btn-primary btn-lg text-white w-100"><i
                                    class="fas fa-pencil-alt"></i>
                                Modifier</button>
                        </div>
                        <div class="mb-4 col-6">
                            <button id="delete" class="btn btn-danger btn-lg text-white w-100"><i
                                    class="fas fa-fw fa-trash"></i>Supprimer</button>
                        </div>
                    </div>
                    <form class="form-row d-none" id="new_prescriber">
                        <div class="input-group mb-4 col-4">
                            <input type="text" class="form-control" placeholder="Nom" id="name" name="name" />
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
                        <input type="hidden" id="id" name="id">
                        <div class="col-6"></div>
                        <div class="input-group-lg col-6 mb-2 mt-3">
                            <button type="button" id="clean" class="form-control bg-secondary text-white">
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
        var dataSet = @json($prescribers, JSON_UNESCAPED_UNICODE);
        // console.log(dataSet);

        function dataRefresh() {
            $.ajax({
                url: "{{ route('prescriber.refresh') }}",
                method: 'GET',
                success: function(data) {
                    table.clear().rows.add(data).draw();
                },
                error: function(error) {
                    console.error('Erreur lors de la récupération des données : ', error);
                }
            });
        }

        $('#delete').click(function() {
            $('#id').val(table.row({
                selected: true
            }).data()[0]);
            Swal.fire({
                title: 'Êtes-vous sûr.e ?',
                text: 'Cette action est irréversible.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#30D659',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Revenir',
                confirmButtonText: 'Oui, je suis sûr.e',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('prescriber.delete') }}",
                        data: $('#id').serialize(),
                        success: function(response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: "success",
                                iconColor: 'green',
                                title: "Suppression effectuée."
                            });
                            clean();
                            dataRefresh();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            console.log(xhr);
                            Swal.fire({
                                title: "Erreur lors de l'exécution",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 500
                            });
                        },
                    });
                } else if (result.isDenied) {
                    Swal.fire("Suppression annulée.", "", "info");
                }
            });
        })


        $('#new_prescriber').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Êtes-vous sûr.e ?',
                // text: 'This action cannot be reversed!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#30D659',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Revenir',
                confirmButtonText: 'Oui, je suis sûr.e',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('prescriber.update.record') }}",
                        data: $(this).serialize(),
                        success: function(response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                            Toast.fire({
                                icon: "success",
                                iconColor: '#EC1325BD',
                                title: "Modification effectuée."
                            });
                            clean();
                            $('#prescriber_modal').modal('hide');
                            dataRefresh();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            console.log(xhr);
                            Swal.fire({
                                title: "Erreur lors de l'exécution",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 500
                            });
                        },
                    });
                    // Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Modification annulée.", "", "info");
                }
            });
        });

        var table = new DataTable('#prescriber_table', {
            columns: [{
                    title: 'id'
                },
                {
                    title: 'Nom complet'
                },
                {
                    title: 'Centre'
                },
                {
                    title: 'Fonction'
                },
                {
                    title: 'Spécialité'
                },
            ],
            columnDefs: [{
                targets: 0,
                visible: false
            }],
            order: [
                [1, 'asc']
            ],
            select: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'colvis'
            ],
            data: dataSet
        });

        table.button().add(null, {
            action: function() {
                if (table.row({
                        selected: true
                    }).any()) {
                    $('#prescriber_modal').modal('show');
                } else {
                    Swal.fire({
                        title: "Sélectionnez d'abord un prescripteur.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            text: 'Gérer',
            className: 'btn btn-danger',
            key: 'g'
        });

        $('#update').click(function() {
            if ($('#new_prescriber').hasClass('d-none')) {
                $('#new_prescriber').removeClass('d-none');
            } else {
                $('#new_prescriber').addClass('d-none');
            }
        })

        $('#prescriber_modal').on('hidden.bs.modal', function() {
            if (!($('#new_prescriber').hasClass('d-none'))) {
                $('#new_prescriber').addClass('d-none');
                clean();
            }
        })

        $('#update').on('click', function() {
            $('#id').val(table.row({
                selected: true
            }).data()[0]);
            console.log($('#id').val());
            Swal.fire({
                title: 'Chargement des informations.',
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('prescriber.informations') }}",
                        data: $('#id').serialize(),
                        success: function(response) {
                            fillPrescriberInformations(response);
                            console.log(response);
                            Swal.close();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erreur lors de la récupération des informations du prescripteur.",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                    });
                }
            });
        })

        function fillPrescriberInformations(data) {
            $('#name').val(data.name);
            $('#forename').val(data.forename);
            $('#center').val(data.center);
            $('#function').val(data.function);
            $('#speciality').val(data.speciality);
            $('.selectpicker').selectpicker('render');
        }

        function clean() {
            $('input').val("");
            $('textarea').val("");
            $('.selectpicker').selectpicker('deselectAll');
            $('.selectpicker').selectpicker('render');
        }

        $('#clean').click(function() {
            clean();
        })
    </script>
@endpush
