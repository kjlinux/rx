@extends('main')
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
                        <h6 id="total" class="m-0 font-weight-bold text-primary">
                            Ristournes
                        </h6>
                    </div>
                    <div class="card-body">
                        <form id="state" class="form-row d-flex justify-content-center">
                            @csrf
                            <div class="input-group mb-4 col-4">
                                {{ html()->select($name = 'prescriber', $options = $prescriber_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Prescripteur', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5']) }}
                            </div>
                            @php
                                $rebate_state = [
                                    true => 'Payées',
                                    false => 'Non payées',
                                ];
                            @endphp
                            <div class="input-group mb-4 col-3">
                                {{ html()->select($name = 'rebate_state', $options = $rebate_state)->class('input-group selectpicker show-tick')->attributes(['title' => 'Statut des ristournes', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5']) }}
                            </div>
                            <div class="input-group mb-4 col-3">
                                <input type="text" class="form-control" placeholder="Période" id="yearpicker"
                                    name="yearpicker" data-language='fr' />
                            </div>
                            <div class="input-group mb-4 col-2">
                                <button type="submit" id="clean" class="form-control bg-primary text-white">
                                    <i class="fas fa-check"></i>
                                    Valider
                                </button>
                            </div>
                        </form>
                        <!-- <label class="sr-only" for="inlineFormInputGroup">Username</label> -->
                        <form class="form-row d-none">
                            <input type="hidden" id="id" name="id">
                        </form>
                        <table id="payed_table" class="display" width="100%"></table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
    <script>
        $('#state').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('prescriber.register.payment') }}",
                data: $(this).serialize(),
                success: function(data) {
                    console.log(data);
                    table.clear().rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Erreur lors de l'exécution",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 500
                    });
                },
            });
        });

        $('#yearpicker').datepicker({
            range: true,
            multipleDatesSeparator: ' au '
            // view: 'years',
            // minView: 'years',
            // dateFormat: 'yyyy',
            // onSelect: function() {
            //     drawer();
            // }
        })

        // var dataSet = @json($rebates, JSON_UNESCAPED_UNICODE);  IT CAN BE USED AFTER

        function dataTableRefreshPayment() {
            $.ajax({
                url: "{{ route('prescriber.register.payment') }}",
                method: 'POST',
                data: $('#state').serialize(),
                success: function(data) {
                    table.clear().rows.add(data).draw();
                },
                error: function(error) {
                    console.error('Erreur lors de la récupération des données : ', error);
                }
            });
        }

        var table = new DataTable('#payed_table', {
            columns: [{
                    title: 'id'
                },
                {
                    title: 'Centre'
                },
                {
                    title: 'Patient envoyé'
                },
                {
                    title: 'Ristourne'
                },
                {
                    title: 'Date'
                }
            ],
            columnDefs: [{
                targets: 0,
                visible: false
            }],
            order: [
                [4, 'desc'] // Correction de l'index de tri
            ],
            select: true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'colvis'
            ],
            data: [] // Assurez-vous que les données sont au bon format
        });


        dataSelected = [];

        table.button().add(null, {
            action: function() {
                if (table.row({
                        selected: true
                    }).any()) {
                    dataSelected = [];

                    table.rows({
                        selected: true
                    }).every(function(rowIdx, tableLoop, rowLoop) {
                        var data = this.data();
                        var firstColumnValue = data[0];

                        dataSelected.push(firstColumnValue);
                    });
                    if ($('select[name="rebate_state"]').val() == 'true') {
                        Swal.fire({
                            title: "Vous ne pouvez pas valider un paiement qui a déja été effectué.",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        confirmPayment(dataSelected);
                    }
                } else {
                    Swal.fire({
                        title: "Sélectionnez d'abord un prescripteur.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            text: 'Confirmer paiement',
            className: 'btn btn-danger',
            key: 'p'
        });

        var allSelected = false;

        table.button().add(null, {
            action: function() {
                if (allSelected) {
                    table.rows({
                        page: 'current'
                    }).deselect();
                } else {
                    table.rows({
                        page: 'current'
                    }).select();
                }

                allSelected = !allSelected;
            },
            text: 'Tout sélectionner',
            className: 'btn btn-secondary',
            key: 't'
        });


        function confirmPayment(dataSelected) {
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
                        url: "{{ route('prescriber.confirm.payment') }}",
                        data: {
                            'data_selected': dataSelected
                        },
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
                                title: "Paiement validé."
                            });
                            dataTableRefreshPayment();
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
                    Swal.fire("Paiement validé.", "", "info");
                }
            });
        }

        function updateTotal() {
            var selectedRows = table.rows({
                selected: true
            }).data();
            var total = 0;

            selectedRows.each(function(value) {
                total += parseInt(value[3]) || 0;
            });

            var totalElement = $('#total');

            if (selectedRows.length > 0) {
                totalElement.text('Total : ' + total);
            } else {
                totalElement.text('Ristournes');
            }
        }

        table.on('select deselect', function() {
            updateTotal();
        });

        updateTotal();
    </script>
@endpush
