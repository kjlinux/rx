<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>X-Ray Service</title>
    <link rel="shortcut icon" type="image/png" href={{ asset('img/rx.png') }}>
    <link href={{ asset('vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <link href={{ asset('css/sb-admin-2.css') }} rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link
        href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sl-1.7.0/datatables.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/air-datepicker/dist/css/datepicker.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css"
        rel="stylesheet">
</head>
@stack('style')
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            @can('check dashboard')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href={{ route('dashboard') }}>
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">RX</div>
                </a>
            @else
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href={{ route('patient.new') }}>
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-medkit"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">RX</div>
                </a>
            @endcan

            <hr class="sidebar-divider my-0" />

            @can('check dashboard')
                <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
                    <a class="nav-link" href={{ route('dashboard') }}>
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Tableau de bord</span></a>
                </li>
            @endcan

            <hr class="sidebar-divider" />

            <div class="sidebar-heading">Patients</div>

            <li class="nav-item @if (request()->routeIs('patient.new')) active @endif">
                <a class="nav-link" href={{ route('patient.new') }}>
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Ajouter un patient</span></a>
            </li>

            <li class="nav-item @if (request()->routeIs('patient.update')) active @endif">
                <a class="nav-link" href={{ route('patient.update') }}>
                    <i class="fas fa-info-circle"></i>
                    <span>Informations patient</span></a>
            </li>

            <li class="nav-item @if (request()->routeIs('patient.payed')) active @endif">
                <a class="nav-link" href={{ route('patient.payed') }}>
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Consulter reste à payer</span></a>
            </li>

            <hr class="sidebar-divider" />

            <div class="sidebar-heading">Prescripteurs</div>

            @can('add prescriber')
                <li class="nav-item @if (request()->routeIs('prescriber.new')) active @endif">
                    <a class="nav-link" href={{ route('prescriber.new') }}>
                        <i class="fas fa-plus"></i>
                        <span>Ajouter prescripteur</span></a>
                </li>
            @endcan

            @can('manage prescriber informations')
                <li class="nav-item @if (request()->routeIs('prescriber.update')) active @endif">
                    <a class="nav-link" href={{ route('prescriber.update') }}>
                        <i class="fas fa-pencil-alt"></i>
                        <span>Informations prescripteur</span></a>
                </li>
            @endcan

            <li class="nav-item @if (request()->routeIs('prescriber.payed')) active @endif">
                <a class="nav-link" href={{ route('prescriber.payed') }}>
                    <i class="fas fa-money-bill-alt"></i>
                    <span>Consulter ristournes prescripteur</span></a>
            </li>

            <hr class="sidebar-divider" />

            @can('check insights')
                <div class="sidebar-heading">Statistiques</div>

                <li class="nav-item @if (request()->routeIs('insights')) active @endif">
                    <a class="nav-link" href={{ route('insights') }}>
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Statisiques</span></a>
                </li>
                <hr class="sidebar-divider d-none d-md-block" />
            @endcan

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h5 class="mt-3" id="dateHeure"></h5>

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::check() ? Auth::user()->name : null }}</span>
                                <img class="img-profile rounded-circle" src={{ asset('img/hospital.png') }}
                                    title="profil" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @can('make holiday')
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-calendar-check fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Férié
                                        <input type="checkbox" id="switch" name="switch" data-toggle="switchbutton" data-onlabel="Oui"
                                            data-offlabel="Non" data-offstyle="danger" data-size="xs">
                                            {{-- <input type="checkbox" id="name" name="name"> --}}
                                    </a>
                                @endcan
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Paramètres
                                </a>
                                <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                @yield('layout')

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RX SERVICE</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-caret-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Se déconnecter ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sélectionner "Se déconnecter" si vous êtes prêt à mettre fin à votre session en cours.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Retour
                    </button>
                    <a class="btn btn-primary" href={{ route('logout') }}>Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('vendor/jquery-easing/jquery.easing.min.js') }}></script>
    <script src={{ asset('js/sb-admin-2.min.js') }}></script>
    <script src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sl-1.7.0/datatables.min.js">
    </script>
    <script src={{ asset('js/jquery.inputmask.min.js') }}></script>
    <script src={{ asset('js/inputmask.binding.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src={{ asset('js/charts.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js">
    </script>
    <script>
        document.getElementById('switch').switchButton('enable');

        Highcharts.setOptions({
            lang: {
                months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                ],
                weekdays: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                decimalPoint: ",",
                downloadPNG: "Télécharger en image PNG",
                downloadJPEG: "Télécharger en image JPEG",
                downloadPDF: "Télécharger en document PDF",
                downloadSVG: "Télécharger en document Vectoriel",
                exportButtonTitle: "Export du graphique",
                loading: "Chargement en cours...",
                printButtonTitle: "Imprimer le graphique",
                resetZoom: "Réinitialiser le zoom",
                resetZoomTitle: "Réinitialiser le zoom au niveau 1:1",
                thousandsSep: " ",
                printChart: "Imprimer",
                viewFullscreen: "Afficher en plein écran",
                exitFullscreen: "Fermer le plein écran",
                downloadCSV: "Télécharger au format CSV",
                downloadXLS: "Télécharger au format XLS",
                viewData: "Afficher la table de données",
                hideData: "Fermer la table de données"
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateTime() {
            var datePosition = $('#dateHeure');

            var date = new Date();

            var days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            var months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                'Octobre', 'Novembre', 'Décembre'
            ];

            var dateString = days[date.getDay()] + ' ' +
                date.getDate() + ' ' +
                months[date.getMonth()] + ' ' +
                date.getFullYear() + ', ' +
                ('0' + date.getHours()).slice(-2) + ':' +
                ('0' + date.getMinutes()).slice(-2) + ':' +
                ('0' + date.getSeconds()).slice(-2);

            datePosition.text(dateString);
        }

        $(document).ready(function() {
            updateTime();
            setInterval(updateTime, 1000);
            checkHoliday();
        });

        $('#switch').change(function() {
            updateHoliday();
        })

        function updateHoliday() {
            $.ajax({
                method: 'POST',
                url: "{{ route('update.holiday') }}",
                data: $('#switch').serialize(),
                success: function(response) {
                    // if (response === 0) {
                    //     Swal.fire({
                    //         title: "Vous avez désactivé le mode férié.",
                    //         icon: "info",
                    //         showConfirmButton: false,
                    //         timer: 2000
                    //     });
                    // } else {
                    //     Swal.fire({
                    //         title: "Vous avez défini le jour d'aujourd'hui comme férié.",
                    //         icon: "warning",
                    //         showConfirmButton: false,
                    //         timer: 2000
                    //     });
                    // }
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

        function checkHoliday() {
            $.ajax({
                method: 'GET',
                url: "{{ route('check.holiday') }}",
                success: function(data) {
                    if (data[0] === true || data[1] === true) {
                        document.getElementById('switch').switchButton('on');
                    } else if (data[0] === false && data[1] === false) {
                        document.getElementById('switch').switchButton('off');
                    }
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
    </script>
    @stack('script')
</body>

</html>
