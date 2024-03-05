@extends('main')
@section('layout')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">RX > <strong>STATISTIQUES</strong></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Générer le rapport
            </a>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 id="chart" class="m-0 font-weight-bold text-primary">
                            Statistiques
                        </h6>
                    </div>
                    <div class="card-body">
                        <form id="state" class="form-row d-flex justify-content-center">
                            @csrf
                            <div class="input-group mb-4 col-7">
                                {{ html()->select($name = 'insight', $options = $listOfInsights)->class('input-group selectpicker show-tick')->attributes(['title' => 'Cliquez pour sélectionner', 'data-width' => '100%', 'data-live-search' => 'true', 'data-size' => '7'])->required() }}
                            </div>
                            <div class="input-group mb-4 col-2 d-none">
                                <input type="text" class="form-control" placeholder="Année" id="yearpicker"
                                    name="yearpicker" />
                            </div>
                        </form>
                        <div id="container" width="100%" height="100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#yearpicker').datepicker({
            view: 'years',
            minView: 'years',
            dateFormat: 'yyyy',
            onSelect: function() {
                drawer();
            }
        })

        function drawer() {
            $.ajax({
                method: 'POST',
                url: "{{ route('insights.drawer') }}",
                data: $('#state').serialize(),
                success: function(response) {
                    draw(chart = response.chart,
                        title = response.title,
                        data = response.data,
                        name = response.name,
                        categories = response.categories);
                    $('#chart').text(response.title);
                    console.log(response)
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
        }

        $('#insight').change(function() {
            _controlYearField();
            if ($('#yearpicker').parent().hasClass('d-none')) {
                drawer();
            }
        })

        function _controlYearField() {
            if ($('.selectpicker').val() === _getInitial('Total des recettes générées')) {
                $('#yearpicker').prop('required', true).parent().removeClass('d-none');
            } else {
                $('#yearpicker').prop('required', false).parent().addClass('d-none');
            }
        }

        function _getInitial(string) {
            const words = string.split(' ');
            let initials = '';

            words.forEach(word => {
                const firstLetter = word.charAt(0);
                initials += firstLetter.toUpperCase();
            });

            return initials;
        }
    </script>
@endpush
