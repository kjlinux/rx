<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>X-Ray Service</title>
    <link rel="shortcut icon" type="image/png" href={{ asset('img/rx.png') }}>
    <!-- Custom fonts for this template-->
    <link href={{ asset('vendor/fontawesome-free/css/all.min.css') }} rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href={{ asset('css/sb-admin-2.css') }} rel="stylesheet" />
    {{-- <link href={{ asset('css/datatables.css') }} rel="stylesheet" /> --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link
        href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sl-1.7.0/datatables.min.css"
        rel="stylesheet">
    @stack('style')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            @can('check dashboard')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href={{ route('dashboard') }}>
                    <div class="sidebar-brand-icon rotate-n-15">
                        <iconify-icon icon="jam:medical" style="color: white" width="60" height="60"></iconify-icon>
                    </div>
                    <div class="sidebar-brand-text mx-3">RX</div>
                </a>
            @else
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href={{ route('patient.new') }}>
                    <div class="sidebar-brand-icon rotate-n-15">
                        <iconify-icon icon="jam:medical" style="color: white" width="60" height="60"></iconify-icon>
                    </div>
                    <div class="sidebar-brand-text mx-3">RX</div>
                </a>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            @can('check dashboard')
                <li class="nav-item active">
                    <a class="nav-link" href={{ route('dashboard') }}>
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Tableau de bord</span></a>
                </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Patients</div>

            <li class="nav-item">
                <a class="nav-link" href={{ route('patient.new') }}>
                    <iconify-icon icon="zondicons:add-outline" width="13" height="13"></iconify-icon>
                    <span>Ajouter un patient</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href={{ route('patient.update') }}>
                    <iconify-icon icon="streamline:interface-edit-pencil-change-edit-modify-pencil-write-writing"
                        width="13" height="13"></iconify-icon>
                    <span>Informations patient</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href={{ route('patient.payed') }}>
                    <iconify-icon icon="tdesign:money" width="13" height="13"></iconify-icon>
                    <span>Consulter reste à payer</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Prescripteurs</div>

            @can('add prescriber')
                <li class="nav-item">
                    <a class="nav-link" href={{ route('prescriber.new') }}>
                        <iconify-icon icon="basil:add-outline" width="13" height="13"></iconify-icon>
                        <span>Ajouter prescripteur</span></a>
                </li>
            @endcan

            @can('manage prescriber informations')
                <li class="nav-item">
                    <a class="nav-link" href={{ route('prescriber.update') }}>
                        <iconify-icon
                            icon="streamline:interface-edit-write-2-change-document-edit-modify-paper-pencil-write-writing"
                            width="13" height="13"></iconify-icon>
                        <span>Informations prescripteur</span></a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link" href={{ route('prescriber.payed') }}>
                    <iconify-icon icon="dashicons:money-alt" width="13" height="13"></iconify-icon>
                    <span>Consulter ristournes prescripteur</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Statistiques</div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h5 class="mt-3" id="dateHeure"></h5>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src={{ asset('img/hospital.png') }}
                                    title="profil" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="#">
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
                <!-- End of Topbar -->

                @yield('layout')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RX SERVICE</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <iconify-icon icon="icon-park-outline:up-c" width="25" height="25" class="mt-2"></iconify-icon>
    </a>

    <!-- Logout Modal-->
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


    <!-- Bootstrap core JavaScript-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <script src={{ asset('js/jquery.min.js') }}></script>

    <!-- Core plugin JavaScript-->
    <script src={{ asset('vendor/jquery-easing/jquery.easing.min.js') }}></script>
    <!-- Custom scripts for all pages-->
    <script src={{ asset('js/sb-admin-2.min.js') }}></script>

    <!-- Page level plugins -->
    <script src={{ asset('vendor/chart.js/Chart.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('js/demo/chart-area-demo.js') }}></script>
    <script src={{ asset('js/demo/chart-pie-demo.js') }}></script>
    <script src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    {{-- <script src={{ asset('js/datatables.min.js') }}></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/fc-4.3.0/fh-3.4.0/kt-2.11.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sl-1.7.0/datatables.min.js">
    </script>
    <script src={{ asset('js/jquery.inputmask.min.js') }}></script>
    <script src={{ asset('js/inputmask.binding.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
        });
    </script>
    @stack('script')
</body>

</html>
