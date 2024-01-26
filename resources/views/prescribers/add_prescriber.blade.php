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
                            Ajouter un prescripteur
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- <label class="sr-only" for="inlineFormInputGroup">Username</label> -->
                        <form class="form-row" id="new_prescriber">
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
                            <div class="input-group-lg col-6 mb-2 mt-3">
                                <button type="button" id="clean" class="form-control bg-secondary text-white">
                                    <i class="fas fa-times"></i>
                                    Vider les champs
                                </button>
                            </div>
                            <div class="input-group-lg col-6 mb-2 mt-3">
                                <button type="submit" class="form-control bg-success text-white">
                                    <span><iconify-icon icon="solar:printer-bold-duotone" width="15"
                                            height="15"></iconify-icon></span>
                                    Enregistrer
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
        $('#new_prescriber').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('prescriber.record') }}",
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
                        title: "Enregistrement effectué."
                    });
                    clean();
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

        function clean() {
            $('input').val("");
        }

        $('#clean').click(function() {
            clean();
        })
    </script>
@endpush
