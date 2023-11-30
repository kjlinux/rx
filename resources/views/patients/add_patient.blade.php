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
         -->
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-12 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Ajouter un patient
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- <label class="sr-only" for="inlineFormInputGroup">Username</label> -->
                        <form id="new_examination" class="form-row">
                            @csrf
                            <div class="input-group mb-4 col-4">
                                <input type="text" class="form-control" placeholder="Nom" id="name" name="name"/>
                            </div>
                            <div class="input-group mb-4 col-6">
                                <input type="text" class="form-control" placeholder="Prénom(s)" id="forename"
                                    name="forename" />
                            </div>
                            <div class="input-group mb-4 col-2">
                                <input type="number" class="form-control" placeholder="Age" id="year" name="year">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="year">ans</span>
                                </div>
                            </div>
                            <div class="input-group-lg mb-4 col-2">
                                {{ html()->select($name = 'gender', $options = ['M' => 'M', 'F' => 'F'])->class('input-group selectpicker fit')->attributes(['title' => 'Genre', 'data-width' => '100%']) }}
                            </div>
                            <div class="input-group mb-4 col-4">
                                {{ html()->select($name = 'prescriber', $options = ['t' => 'test'])->class('input-group selectpicker show-tick')->attributes(['title' => 'Prescripteur(s)', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5', 'data-multiple-separator' => ' | '])->multiple() }}
                            </div>
                            <div class="input-group mb-4 col-6">
                                {{ html()->select($name = 'center', $options = $center_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Centre', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5']) }}
                            </div>
                            <div class="input-group mb-4 col-12">
                                {{ html()->select($name = 'examination', $options = $exam_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Examen', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '7', 'data-multiple-separator' => ' | '])->multiple() }}
                            </div>
                            <div class="input-group mb-4 col-12">
                                <textarea class="form-control" id="clinical_information" name="clinical_information" rows="2"
                                    placeholder="Renseignements cliniques"></textarea>
                            </div>
                            <div class="input-group mb-4 col-4">
                                <input data-inputmask="'mask': '99-99-99-99-99'" type="text" class="form-control"
                                    placeholder="Numéro de téléphone" id="phone" name="phone" />
                            </div>
                            <div class="input-group pb-2 col-4">
                                <input type="number" class="form-control" placeholder="Total à payer" id="total_amount"
                                    name="total_amount" readonly>
                                <div class="input-group-append mb-5">
                                    <span class="input-group-text" id="total_amount">FCFA</span>
                                </div>
                            </div>
                            <div class="input-group pb-5 col-4">
                                <label for="payed_bool" class="btn btn-primary">Le patient a payé la
                                    totalité.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" id="payed_bool" name="payed_bool" class="badgebox" checked><span
                                        class="badge">&check;</span></label>
                            </div>
                            <div class="input-group mb-2 mt-n4 col-6 d-none">
                                <input type="number" class="form-control" placeholder="Montant payé" id="payed_amount"
                                    name="payed_amount">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="payed_amount">FCFA</span>
                                </div>
                            </div>
                            <div class="input-group mb-2 mt-n4 col-6 d-none">
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
                                    <i class="fas fa-print"></i>
                                    Imprimer le reçu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('script')
    <script>

        $('#new_examination').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('patient.register') }}",
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response)
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "marche pas",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 500
                    });
                },
            });
        });

        $('#payed_bool').change(function() {
            if ($(this).prop('checked') == true) {
                $('#payed_amount').parent().addClass('d-none');
                $('#left_to_pay').parent().addClass('d-none');
                console.log("isnot");
            } else {
                $('#payed_amount').parent().removeClass('d-none');
                $('#left_to_pay').parent().removeClass('d-none');
            }
        })

        function priceCalculator(){
            $.ajax({
                method: 'POST',
                url: "{{ route('patient.price.calculator') }}",
                data: $('#examination').serialize(),
                success: function(response) {
                    $('#total_amount').val(response.examination_data)
                },
                error: function(xhr, status, error) {
                    $('#total_amount').val(0);
                    Swal.fire({
                        title: "Choisissez les examens",
                        icon: "info",
                        showConfirmButton: false,
                        timer: 1000
                    });
                },
            });
        }

        $('#examination').change(function(){
            priceCalculator();
        })
    </script>
@endpush
