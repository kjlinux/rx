<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href={{ asset('img/rx.png') }}/>
    <title>{{ $data['name'] }} {{ $data['forenames'] }}</title>
    <link href={{ asset('css/sb-admin-2.css') }} rel="stylesheet" />
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
                        <span style="font-size: 15px; color:#326195">Cocody-Angre Terminus 81-82 en face de SNEDAI
                            E-PASSEPORT</span>
                    </div>
                    <div class="col-12 text-center font-weight-bold">
                        <span style="font-size: 15px; color:#326195">TEL : 2722261691 / 0747212827 / 0171444415</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mr-3 mb-3" style="background-color: #326195">
            <div class="col-12 text-white text-left">
                <span>Reçu de paiement N° {{ $data['id'] }}</span>
                <span style="margin-left: 227px">{{ $data['date'] }}, {{ $data['time'] }}</span>
            </div>
        </div>
        <div class="row mt-3  mb-3">
            <div class="col-12">
                <span style="font-size: 20px; color:#326195">Nom:</span>
                <span style="font-size: 20px; margin-left: 61px">{{ $data['name'] }}</span>
            </div>
            <div class="col-12">
                <span style="font-size: 20px; color:#326195">Prénoms:</span>
                <span style="font-size: 20px; margin-left: 18px">{{ $data['forenames'] }}</span>
            </div>
            <div class="col-12 mr-5">
                <span style="font-size: 20px; color:#326195">Examens :</span>
                <span style="font-size: 20px; margin-left: 9px">{{ $data['examination'] }}</span>
            </div>
        </div>
        <div class="row mt-3 mr-3 mb-3" style="background-color: #326195">
            <div class="col text-white">
                <span>Net à payer : {{ $data['amount_to_pay'] }} F</span>
                <span style="margin-left: 101px">Total payé : {{ $data['payed'] }} F</span>
                <span style="margin-left: 68px">Reste à payer : {{ $data['left_to_pay'] }} F</span>
            </div>
        </div>
        <div class="row mt-3 mr-3 mb-3" style="background-color: #326195">
            <div class="col text-white">
                <span>Montant en lettres : {{ $data['amount_to_pay_in_letters'] }}</span>
                <span style="margin-left: 130px">Francs CFA</span>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <u style="margin-left: 600px">Visa caisse</u>
            <div class="col-12 mt-n4">
                <img src="data:image/png;base64, {!! base64_encode(
                    QrCode::format('svg')->size(70)->style('dot')->eye('circle')->generate('Votre santé est notre priorité absolue. Prenez soin de vous !'),
                ) !!} ">
            </div>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        -------------------------------------------------------------------------------------------------------------------------------------------
    </div>
    <div class="container mt-5">
        <div class="row align-items-center mb-5 mt-3">
            <div>
                <img src="{{ asset('img/csu.png') }}" alt="CSU" height="100" width="100">
            </div>
            <div class="ml-5" style="margin-top: -100px">
                <div class="row">
                    <div class="col-12 text-center">
                        <span style="font-size: 25px; color:#326195">Centre de Santé Urbain Communautaire d'Angré</span>
                    </div>
                    <div class="col-12 text-center">
                        <span style="font-size: 15px; color:#326195">Cocody-Angre Terminus 81-82 en face de SNEDAI
                            E-PASSEPORT</span>
                    </div>
                    <div class="col-12 text-center font-weight-bold">
                        <span style="font-size: 15px; color:#326195">TEL : 2722261691 / 0747212827 / 0171444415</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 d-flex align-items-center justify-content-center">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <span style="font-size: 35px; color:#326195">Nom:</span>
                <span style="font-size: 35px; margin-left: 61px">{{ $data['name'] }}</span>
            </div>
            <div class="col-12">
                <span style="font-size: 35px; color:#326195">Prénoms:</span>
                <span style="font-size: 35px; margin-left: 18px">{{ $data['forenames'] }}</span>
            </div>
            <div class="col-12 mr-5">
                <span style="font-size: 35px; color:#326195">Examens :</span>
                <span style="font-size: 35px; margin-left: 9px">{{ $data['examination'] }}</span>
            </div>
        </div>
        <div class="row mt-3">
            <p style="margin-left: 520px">{{ $data['date'] }}</p>
            <div class="col-12 mt-n4">
                <img src="data:image/png;base64, {!! base64_encode(
                    QrCode::format('svg')->size(70)->style('dot')->eye('circle')->generate('Votre santé est notre priorité absolue. Prenez soin de vous !'),
                ) !!} ">
            </div>
        </div>
    </div>
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
