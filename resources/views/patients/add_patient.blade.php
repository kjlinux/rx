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
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">RX > <strong>PATIENTS</strong></h1>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Nouveau patient
                        </h6>
                    </div>
                    <div class="card-body">
                        <form id="new_examination" class="form-row">
                            @csrf
                            <div class="input-group mb-4 col-4">
                                <input type="text" class="form-control" placeholder="Nom" id="name" name="name"
                                    required />
                            </div>
                            <div class="input-group mb-4 col-6">
                                <input type="text" class="form-control" placeholder="Prénom(s)" id="forename"
                                    name="forenames" required />
                            </div>
                            <div class="input-group mb-4 col-2">
                                <input type="number" class="form-control" placeholder="Age" id="year" name="year">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="year">ans</span>
                                </div>
                            </div>
                            <div class="input-group-lg mb-4 col-2">
                                {{ html()->select($name = 'gender', $options = ['M' => 'M', 'F' => 'F'])->class('input-group selectpicker fit')->attributes(['title' => 'Genre', 'data-width' => '100%'])->required() }}
                            </div>
                            <div class="input-group mb-4 col-4">
                                {{ html()->select($name = 'prescriber', $options = $prescriber_data)->class('input-group selectpicker show-tick')->attributes(['title' => 'Prescripteur', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '5']) }}
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
                                    placeholder="Numéro de téléphone" id="phone" name="phone" required />
                            </div>
                            <div class="input-group pb-2 col-3">
                                <input type="number" class="form-control" placeholder="Total à payer" id="total_amount"
                                    name="total_amount" readonly required>
                                <div class="input-group-append mb-5">
                                    <span class="input-group-text" id="total_amount">FCFA</span>
                                </div>
                            </div>
                            <div class="input-group pb-5 col-4">
                                <label for="payed_bool" class="btn btn-primary">Le patient a payé la
                                    totalité&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" id="payed_bool" name="payed_bool" class="badgebox" checked
                                        disabled><span class="badge">&check;</span></label>
                            </div>
                            <div class="input-group pb-5 col-2">
                                @can('make discount')
                                    <label for="discount_bool" class="btn btn-success">Réduction&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" id="discount_bool" name="discount_bool" class="badgebox"><span
                                            class="badge">&check;</span></label>
                                @endcan
                            </div>
                            <div class="input-group mb-2 mt-n4 col-2 d-none">
                                <input data-inputmask="'mask': '99'" type="number" class="form-control"
                                    placeholder="Réduction" id="discount" name="discount">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="discount">%</span>
                                </div>
                            </div>
                            <div class="input-group mb-2 mt-n4 col-2 d-none">
                                <input type="number" class="form-control" placeholder="Prix" id="after_discount"
                                    name="after_discount" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="after_discount">FCFA</span>
                                </div>
                            </div>
                            <div id="hidden" class="col-12"></div>
                            <div class="input-group mb-2 mt-n4 col-4 d-none">
                                <input type="number" class="form-control" placeholder="Montant payé" id="payed_amount"
                                    name="payed_amount">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="payed_amount">FCFA</span>
                                </div>
                            </div>
                            <div class="input-group mb-2 mt-n4 col-4 d-none">
                                <input type="number" class="form-control" placeholder="Reste à payer" id="left_to_pay"
                                    name="left_to_pay" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="left_to_pay">FCFA</span>
                                </div>
                            </div>
                            <input type="hidden" id="date" name="date">
                            <input type="hidden" id="time" name="time">
                            <input type="hidden" id="voucher" name="voucher">
                            <div class="input-group-lg col-6 mb-2 mt-3">
                                <button type="button" id="clean" class="form-control bg-secondary text-white">
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                method: 'POST',
                url: "{{ route('patient.record') }}",
                data: $(this).serialize(),
                success: function(response) {
                    const pdfUrl = response.pdf_url;
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Enregistrement effectué."
                    });
                    redirectToVoucher(pdfUrl);
                    //clean();
                    $('#voucher').val(response.voucher_id);
                    deleteVoucherAfterStream();
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

        function redirectToVoucher(link) {
            window.open(link, '_blank');
        }

        function deleteVoucherAfterStream() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                method: 'POST',
                url: "{{ route('voucher.delete') }}",
                data: $('#voucher').serialize(),
                success: function(response) {},
                error: function(deleteError) {
                    console.log("bad");
                }
            });
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
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

        function wipeInput() {
            $('#discount').val("");
            $('#after_discount').val("");
            $('#payed_amount').val("");
            $('#left_to_pay').val("");
        }

        $('#examination').change(function() {
            priceCalculator();
            wipeInput();
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
