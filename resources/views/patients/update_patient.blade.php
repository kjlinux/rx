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
                        @can('delete patient')
                            <div class="mb-4 col-4">
                                <button id="update" class="btn btn-primary btn-lg text-white w-100"><i
                                        class="fas fa-pencil-alt"></i>
                                    Modifier</button>
                            </div>
                            <div class="mb-4 col-4">
                                <button id="print" class="btn btn-secondary btn-lg text-white w-100"><i
                                        class="fas fa-fw fa-print"></i><span>Imprimer
                                        reçu</span></button>
                            </div>
                            <div id="delete" class="mb-4 col-4">
                                <button class="btn btn-danger btn-lg text-white w-100"><i
                                        class="fas fa-fw fa-trash"></i>Supprimer</button>
                            </div>
                        @else
                            <div class="mb-4 col-6">
                                <button id="update" class="btn btn-primary btn-lg text-white w-100"><i
                                        class="fas fa-pencil-alt"></i>
                                    Modifier</button>
                            </div>
                            <div class="mb-4 col-6">
                                <button id="print" class="btn btn-secondary btn-lg text-white w-100"><i
                                        class="fas fa-fw fa-print"></i><span>Imprimer
                                        reçu</span></button>
                            </div>
                        @endcan
                    </div>
                    <form id="new_examination" class="form-row d-none">
                        @csrf
                        <div class="input-group mb-4 col-4">
                            <input type="text" class="form-control" placeholder="Nom" id="name" name="name"
                                required />
                        </div>
                        <div class="input-group mb-4 col-6">
                            <input type="text" class="form-control" placeholder="Prénom(s)" id="forename"
                                name="forename" required />
                        </div>
                        <div class="input-group mb-4 col-2">
                            <input type="number" class="form-control" placeholder="Age" id="year" name="year"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="year">ans</span>
                            </div>
                        </div>
                        <div class="input-group-lg mb-4 col-2">
                            {{ html()->select($name = 'gender', $options = ['M' => 'M', 'F' => 'F'])->class('input-group selectpicker fit')->attributes(['title' => 'Genre', 'data-width' => '100%'])->required() }}
                        </div>
                        <div class="input-group mb-4 col-4">
                            {{ html()->select($name = 'prescriber', $options = $prescriber_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Prescripteur(s)', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5', 'data-multiple-separator' => ' | '])->multiple()->required() }}
                        </div>
                        <div class="input-group mb-4 col-6">
                            {{ html()->select($name = 'center', $options = $center_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Centre', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5'])->required() }}
                        </div>
                        <div class="input-group mb-4 col-12">
                            {{ html()->select($name = 'examination', $options = $exam_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Examen', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '7', 'data-multiple-separator' => ' | '])->multiple()->required() }}
                        </div>
                        <div class="input-group mb-4 col-12">
                            <textarea class="form-control" id="clinical_information" name="clinical_information" rows="2"
                                placeholder="Renseignements cliniques" required></textarea>
                        </div>
                        <div class="input-group mb-4 col-3">
                            <input data-inputmask="'mask': '99-99-99-99-99'" type="text" class="form-control"
                                placeholder="Numéro de téléphone" id="phone" name="phone" required />
                        </div>
                        <div class="input-group pb-2 col-3">
                            <input type="number" class="form-control" placeholder="Total à payer" id="total_amount"
                                name="total_amount" readonly required>
                        </div>
                        <div class="input-group pb-5 col-3">
                            <label for="payed_bool" class="btn btn-primary">Totalité payée&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="payed_bool" name="payed_bool" class="badgebox"><span
                                    class="badge">&check;</span></label>
                        </div>
                        <div class="input-group pb-5 col-3">
                            <label for="discount_bool"
                                class="btn btn-success">Réduction&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="discount_bool" name="discount_bool" class="badgebox"
                                    checked><span class="badge">&check;</span></label>
                        </div>
                        <div class="input-group mb-2 mt-n4 col-2">
                            <input data-inputmask="'mask': '99'" type="number" class="form-control" placeholder=""
                                id="discount" name="discount">
                            <div class="input-group-append">
                                <span class="input-group-text" id="discount">%</span>
                            </div>
                        </div>
                        <div class="input-group mb-2 mt-n4 col-2">
                            <input type="number" class="form-control" placeholder="Réduction" id="after_discount"
                                name="after_discount" readonly>
                        </div>
                        <div id="hidden" class="col-12 d-none"></div>
                        <div class="input-group mb-2 mt-n4 col-4">
                            <input type="number" class="form-control" placeholder="Montant payé" id="payed_amount"
                                name="payed_amount">
                            <div class="input-group-append">
                                <span class="input-group-text" id="payed_amount">FCFA</span>
                            </div>
                        </div>
                        <div class="input-group mb-2 mt-n4 col-4">
                            <input type="number" class="form-control" placeholder="Reste à payer" id="left_to_pay"
                                name="left_to_pay" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text" id="left_to_pay">FCFA</span>
                            </div>
                        </div>
                        <input type="hidden" id="date" name="date">
                        <input type="hidden" id="time" name="time">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="slug" name="slug">
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
        var dataSet = @json($register, JSON_UNESCAPED_UNICODE);
        // console.log(dataSet);

        function dataRefresh() {
            $.ajax({
                url: "{{ route('patient.refresh') }}",
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
            }).data()[1]);
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
                        url: "{{ route('patient.delete') }}",
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
                            $('#patient_modal').modal('hide');
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
                    Swal.fire("Suppression annulée.", "", "info");
                }
            });
        })

        $('#new_examination').submit(function(e) {
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
                        url: "{{ route('patient.update.record') }}",
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
                            $('#patient_modal').modal('hide');
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

        var table = new DataTable('#patient_table', {
            // data: dataSet,
            ajax: {
                url: "{{ route('patient.refresh') }}",
                dataSrc: '', // Indique que les données retournées ne sont pas encapsulées dans un objet
                type: 'GET',
                processing: true,
                serverSide: true
            },
            columns: [{
                    title: 'updated_at'
                },
                {
                    title: 'N°'
                },
                {
                    title: 'Nom Complet'
                },
                {
                    title: 'Age'
                },
                {
                    title: 'Sexe'
                },
                {
                    title: 'Renseignements Cliniques'
                },
                {
                    title: 'Examens'
                },
                {
                    title: 'Prescripteurs'
                },
                {
                    title: 'Provenance'
                },
                {
                    title: 'Montant'
                },
                {
                    title: 'Téléphone'
                },
            ],
            columnDefs: [{
                targets: 0,
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
            // language: {
            //     url: "{{ asset('json/french_pack_datatable.json') }}",
            // },
        });

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
                        timer: 1500
                    });
                }
            },
            text: 'Gérer',
            className: 'btn btn-success',
            key: 'g'
        });

        $('#update').click(function() {
            if ($('#new_examination').hasClass('d-none')) {
                $('#new_examination').removeClass('d-none');
            } else {
                $('#new_examination').addClass('d-none');
            }
        })

        $('#patient_modal').on('hidden.bs.modal', function() {
            if (!($('#new_examination').hasClass('d-none'))) {
                $('#new_examination').addClass('d-none');
                clean();
            }
        })

        $('#update').on('click', function() {
            $('#id').val(table.row({
                selected: true
            }).data()[1]);
            Swal.fire({
                title: 'Chargement des informations.',
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('patient.informations') }}",
                        data: $('#id').serialize(),
                        success: function(response) {
                            fillPatientInformations(response);
                            Swal.close();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erreur lors de la récupération des informations du patient.",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                    });
                }
            });
        })

        $('#print').on('click', function() {
            $('#id').val(table.row({
                selected: true
            }).data()[1]);
            Swal.fire({
                title: 'Construction du reçu...',
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('patient.informations') }}",
                        data: $('#id').serialize(),
                        success: function(response) {
                            fillPatientInformations(response);
                            printerStream();
                            Swal.close();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Erreur lors de la récupération des informations du patient.",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                    });
                }
            });
        })

        function printerStream() {
            $.ajax({
                method: 'POST',
                url: "{{ route('voucher.generate.stream') }}",
                data: $('#new_examination').serialize(),
                success: function(response) {
                    const pdfUrl = response.pdf_url;
                    redirectToVoucher(pdfUrl);
                    deleteVoucherAfterStream();
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Erreur lors de la récupération des informations du patient.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
            });
        }

        function redirectToVoucher(link) {
            window.open(link, '_blank');
        }

        function deleteVoucherAfterStream() {
            $.ajax({
                method: 'POST',
                url: "{{ route('voucher.delete.stream') }}",
                data: $('#slug').serialize(),
                success: function(response) {},
                error: function(deleteError) {
                    console.log("bad");
                }
            });
        }

        function convertStringToArray(inputString) {
            return inputString.split(',').map(String);
        }

        function fillPatientInformations(data) {
            $('#name').val(data.name);
            $('#forename').val(data.forename);
            $('#year').val(data.year);
            $('#gender').val(data.gender);
            $('#center').val(data.center);
            $('#clinical_information').val(data.clinical_information);
            $('#phone').val(data.phone);
            $('#total_amount').val(data.total_amount);
            $('#discount').val(data.discount);
            $('#after_discount').val(data.after_discount);
            $('#payed_amount').val(data.payed_amount);
            $('#left_to_pay').val(data.left_to_pay);
            $('#date').val(data.date);
            $('#time').val(data.time);
            $('#slug').val(data.slug);
            $('#prescriber').selectpicker('val', convertStringToArray(data.prescriber));
            $('#examination').selectpicker('val', convertStringToArray(data.examination));
            $('.selectpicker').selectpicker('render');
            if ($('#discount').val() === '' && $('#after_discount').val() === '') {
                $('#discount_bool').prop('checked', false);
                $('#discount').parent().addClass('d-none').prop('required', false);
                $('#after_discount').parent().addClass('d-none').prop('required', false);
            }
            if ($('#payed_amount').val() === '') {
                $('#payed_bool').prop('checked', true);
                $('#hidden').removeClass('d-none');
                $('#payed_amount').parent().addClass('d-none').prop('required', false);
                $('#left_to_pay').parent().addClass('d-none').prop('required', false);
            }
            if ($('#discount').val() !== '' || $('#after_discount').val() !== '') {
                $('#discount_bool').prop('checked', true);
                $('#discount').parent().removeClass('d-none').prop('required', true);
                $('#after_discount').parent().removeClass('d-none').prop('required', true);
            }
            if ($('#payed_amount').val() !== '') {
                $('#payed_bool').prop('checked', false);
                $('#hidden').addClass('d-none');
                $('#payed_amount').parent().removeClass('d-none').prop('required', true);
                $('#left_to_pay').parent().removeClass('d-none').prop('required', true);
            }
        }

        var payed_amount = () => {
            if ($('#total_amount').val() !== "" && $('#payed_amount').val() === "") {
                $('#left_to_pay').val($('#total_amount').val() - $('#after_discount').val());
            }
            if ($('#total_amount').val() !== "") {
                if ($('#after_discount').val() !== "") {
                    $('#after_discount').val($('#total_amount').val() - ($('#total_amount').val() * Number($(
                        '#discount').val())) / 100);
                    $('#left_to_pay').val($('#after_discount').val() - $('#payed_amount').val());
                } else {
                    $('#left_to_pay').val($('#total_amount').val() - $('#payed_amount').val());
                }
            }
            if ($('#total_amount').val() === "" || $('#payed_amount').val() === "") {
                $('#left_to_pay').val("");
            }
        }

        var discount = () => {
            if ($('#total_amount').val() !== "" && $('#discount').val() === "") {
                $('#left_to_pay').val($('#total_amount').val() - $('#payed_amount').val());
            }
            if ($('#total_amount').val() !== "") {
                $('#after_discount').val($('#total_amount').val() - ($('#total_amount').val() * Number($(
                    '#discount').val())) / 100);
                $('#left_to_pay').val($('#after_discount').val() - $('#payed_amount').val());
            }
            if ($('#total_amount').val() === "" || $('#discount').val() === "") {
                $('#after_discount').val("");
            }
        }

        $('#payed_bool').change(function() {
            $('#payed_amount').val("");
            payed_amount();
            discount();
            if ($(this).prop('checked') == true) {
                $('#hidden').removeClass('d-none');
                $('#payed_amount').parent().addClass('d-none').prop('required', false);
                $('#left_to_pay').parent().addClass('d-none').prop('required', false);
            } else {
                $('#hidden').addClass('d-none');
                $('#payed_amount').parent().removeClass('d-none').prop('required', true);
                $('#left_to_pay').parent().removeClass('d-none').prop('required', true);
            }

        })

        $('#discount_bool').change(function() {
            $('#discount').val("");
            discount();
            payed_amount();
            if ($(this).prop('checked') == false) {
                $('#discount').parent().addClass('d-none').prop('required', false);
                $('#after_discount').parent().addClass('d-none').prop('required', false);
            } else {
                $('#discount').parent().removeClass('d-none').prop('required', true);
                $('#after_discount').parent().removeClass('d-none').prop('required', true);
            }
        })

        $('#payed_amount').keyup(function() {
            payed_amount();
        });

        $('#discount').keyup(function() {
            discount();
        });

        function priceCalculator() {

            $.ajax({
                method: 'POST',
                url: "{{ route('patient.price.calculator') }}",
                data: $('#examination').serialize(),
                success: function(response) {
                    $('#total_amount').val(response.examination_data);
                    $('#date').val(response.date);
                    $('#time').val(response.time);
                }
            });
        }

        function wipePriceInput() {
            $('#discount').val("");
            $('#after_discount').val("");
            $('#payed_amount').val("");
            $('#left_to_pay').val("");
        }

        $('#examination').change(function() {
            priceCalculator();
            wipePriceInput();
        })


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
