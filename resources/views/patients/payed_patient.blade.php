@extends('main')
@section('layout')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">RX > <strong>PATIENTS</strong></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a>
        </div> --}}

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Reste à payer
                        </h6>
                    </div>
                    <div class="card-body">
                        {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
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
        var dataSet = @json($left_to_pay, JSON_UNESCAPED_UNICODE);

        function dataTableRefreshPayment() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: "{{ route('patient.refresh.payment') }}",
                method: 'GET',
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
                    title: 'updated_at'
                },
                {
                    title: 'id'
                },
                {
                    title: 'Nom Complet'
                },
                {
                    title: 'Examens'
                },
                {
                    title: 'Téléphone'
                },
                {
                    title: 'Montant'
                },
                {
                    title: 'Soldé'
                },
                {
                    title: 'Reste à payer'
                }
            ],
            columnDefs: [{
                targets: [0, 1],
                visible: false
            }],
            order: [
                [0, 'desc']
            ],
            select: true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'colvis'
            ],
            data: dataSet
        });

        table.button().add(null, {
            action: function() {
                if (table.row({
                        selected: true
                    }).any()) {
                    $('#id').val(table.row({
                        selected: true
                    }).data()[1]);
                    confirmPayment($('#id').val());
                } else {
                    Swal.fire({
                        title: "Sélectionnez d'abord un patient.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            text: 'Confirmer paiement',
            className: 'btn btn-success',
            key: 'p'
        });

        function confirmPayment(id) {
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
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('patient.confirm.payment') }}",
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
                                title: "Paiement validé."
                            });
                            dataTableRefreshPayment();
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
                } else if (result.isDenied) {
                    Swal.fire("Paiement validé.", "", "info");
                }
            });
        }
    </script>
@endpush
