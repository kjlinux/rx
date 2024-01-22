<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>v</title>
    <link href={{ asset('css/sb-admin-2.css') }} rel="stylesheet" />
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row align-items-center">
            <div>
                <img src="{{ asset('img/csu.png') }}" alt="CSU" height="100" width="100">
            </div>
            <div class="ml-5" style="margin-top: -100px">
                <div class="row">
                    <div class="col-12 text-center">
                        <span style="font-size: 25px; color:#326195">Centre de Santé Urbain Communautaire d'Angré</span>
                    </div>
                    <div class="col-12 text-center">
                        <span style="font-size: 15px; color:#326195">Cocody-Angre Terminus 81-82 en face de SNEDAI E-PASSEPORT</span>
                    </div>
                    <div class="col-12 text-center font-weight-bold">
                        <span style="font-size: 15px; color:#326195">TEL : 2722525542 / 0747212827 / 0171444415</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mr-3" style="background-color: #326195">
            <div class="col-12 text-white text-left">
                <span>Reçu de paiement N° 23452</span>
                <span style="margin-left: 227px">Samedi 20 Janvier 2024, 14:14:14</span>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <span style="font-size: 20px; color:#326195">Nom:</span>
                <span style="font-size: 20px; margin-left: 61px">DJohn</span>
            </div>
            <div class="col-12">
                <span style="font-size: 20px; color:#326195">Prénom.s:</span>
                <span style="font-size: 20px; margin-left: 18px">Doe</span>
            </div>
            <div class="col-12">
                <span style="font-size: 20px; color:#326195">Examen.s :</span>
                <span style="font-size: 20px; margin-left: 9px">DRX Crâne face basse</span>
            </div>
        </div>
        <div class="row mt-3 mr-3" style="background-color: #326195">
            <div class="col text-white">
                <span>Net à payer : 15000 F</span>
                <span style="margin-left: 101px">Total payé : 10000 F</span>
                <span style="margin-left: 101px">Reste à payer : 5000 F</span>
            </div>
        </div>
        <div class="row mt-3 mr-3" style="background-color: #326195">
            <div class="col text-white">
                <span>Montant en lettres : quinze-mille</span>
                <span style="margin-left: 360px">Francs CFA</span>
            </div>
        </div>
        <div class="row mt-3">
            <u style="margin-left: 600px">Visa caisse</u>
            <div class="col-12 mt-n4">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('svg')->size(70)->style('dot')->eye('circle')->generate('test')) !!} ">
            </div>
        </div>
    </div>
    <div class="row mt-3">-------------------------------------------------------------------------------------------------------------------------------------------</div>
    {{-- <div class="page-break"></div>
    <div class="container mt-3">
        <div class="row align-items-center">
            <div class="col-2">
                <img src="{{ asset('img/csu.png') }}" alt="" class="" height="150" width="150">
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-12 text-center">
                        <span style="font-size: 35px; color:#326195">Centre de Santé Urbain Communautaire d'Angré</span>
                    </div>
                    <div class="col-12 text-center"><span style="font-size: 25px; color:#326195">Cocody-Angre Terminus
                            81-82 en face de SNEDAI E-PASSEPORT</span></div>
                    <div class="col-12 text-center font-weight-bold"><span style="font-size: 25px; color:#326195">TEL :
                            2722525542 / 0747212827 / 0171444415</span></div>
                </div>
            </div>
        </div>
        <h1 class="text-center text-uppercase" style="color: #326195">service de radiologie</h1>
        <h1 class="text-center text-uppercase mt-3">john doe</h1>
        <h1 class="text-center text-uppercase mt-3 mb-5">RX GENOUX F/P</h1>
        <div class="row mt-5">
            <div class="col">{!! QrCode::size(100)->style('dot')->eye('circle')->generate('test') !!}</div>
            <div class="col text-right text-uppercase">Samedi 20 Janvier 2024, 14:14:14</div>
        </div>
    </div> --}}
    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
</body>

</html>
