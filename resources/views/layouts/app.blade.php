<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Banki HR</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    {{-- <meta http-equiv="refresh" content="300"> --}}

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet"> --}}
    {{-- {{-- <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
</head>

<body>
    @include("utils.to_french")
    
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">BANKI RH</span>
                <img src="assets/img/logo.jpeg" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        {{-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar --> --}}

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>

                        @if (auth()->user()->unreadNotifications->count() >= 1)
                            <span class="badge bg-primary badge-number">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            Vous avez {{ auth()->user()->unreadNotifications()->count() }} notifications
                            <a href="{{ route('mark_all_as_read') }}">
                                @if (auth()->user()->unreadNotifications->count() >= 1)
                                    <span class="badge rounded-pill bg-primary p-2 ms-2">Tout
                                        effacer</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @foreach (auth()->user()->unreadNotifications->take(3) as $notification)
                            <li class="notification-item">
                                <a href="{{ route('mark_notification_as_read', $notification->id) }}">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </a>
                                <div>
                                    <h4>{{ $notification->data['title'] }}</h4>
                                    <p>{{ $notification->data['message'] }}</p>
                                    <p>{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endforeach

                        @if (auth()->user()->unreadNotifications->count() >= 1)
                            <li class="dropdown-footer">
                                <a href="#">Tout voir</a>
                            </li>
                        @endif

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        @auth
                            <img src="{{ asset('storage/photos_profile/' . Auth::user()->profile_picture) }}"
                                alt="Profile" class="rounded-circle">
                            {{ Auth::user()->name }}
                        @endauth
                        <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <span class="text text-dark">
                                @auth
                                    {{ Auth::user()->name }} {{ Auth::user()->surname }}
                                @endauth
                            </span>
                            <br>
                            <span>
                                @auth
                                    {{ Auth::user()->role }}
                                @endauth
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.index') }}">
                                <i class="bi bi-person"></i>
                                <span>Mon profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                {{ __('Déconnexion') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            {{-- <i class="bi bi-box-arrow-right"></i> --}}
                            {{-- <span>Sign Out</span> --}}

                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('home') ? '' : 'collapsed' }} " href="{{ route('home') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('voir employes')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('users*') ? '' : 'collapsed' }} "
                        href="{{ route('users.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Employés</span>
                    </a>
                </li>
            @endcan
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('annonces*') ? '' : 'collapsed' }} "
                    href="{{ route('annonces.index') }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Annonces

                        {{-- @if (auth()->user()->unreadNotifications->count() > 0)
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <li class="notification-item">
                                    <i class="bi bi-check-circle text-success"></i>
                                    <div>
                                        <p>{{ $notification->data['testData'] }}</p>
                                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endforeach
                        @else
                        @endif --}}

                        @if (auth()->user()->unreadNotifications->where('type', '=', 'App\Notifications\AnnonceNotification')->count() >= 1)
                            <span class="badge rounded-pill bg-info text-dark">
                                {{ auth()->user()->unReadNotifications->where('type', '=', 'App\Notifications\AnnonceNotification')->count() }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('reunions*') ? '' : 'collapsed' }} "
                    href="{{ route('reunions.index') }}">
                    <i class="bi bi-card-heading"></i>
                    <span>Notes des réunions
                        @if (auth()->user()->unreadNotifications->where('type', '=', 'App\Notifications\ReunionNotification')->count() >= 1)
                            <span class="badge rounded-pill bg-info text-dark">
                                {{ auth()->user()->unReadNotifications->where('type', '=', 'App\Notifications\ReunionNotification')->count() }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>

            @can('voir contrats')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('contrats*') ? '' : 'collapsed' }} "
                    href="{{ route('contrats.index') }}">
                    <i class="bi bi-card-checklist"></i>
                    <span>Contrats
                    </span>
                </a>
            </li>
            @endcan

            @can('voir pays')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('pays*') ? '' : 'collapsed' }} "
                        href="{{ route('pays.index') }}">
                        <i class="bi bi-globe"></i>
                        <span>Pays</span>
                    </a>
                </li>
            @endcan

            @can('voir divisions')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('divisions*') ? '' : 'collapsed' }} "
                        href="{{ route('divisions.index') }}">
                        <i class="bi bi-diagram-3"></i>
                        <span>Divisions</span>
                    </a>
                </li>
            @endcan

            @can('voir départements')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('departements*') ? '' : 'collapsed' }} "
                        href="{{ route('departements.index') }}">
                        <i class="bi bi-diagram-2"></i>
                        <span>Départements</span>
                    </a>
                </li>
            @endcan

            @can('voir services')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('services*') ? '' : 'collapsed' }} "
                        href="{{ route('services.index') }}">
                        <i class="bi bi-palette2"></i>
                        <span>Services</span>
                    </a>
                </li>
            @endcan


            @can('voir roles')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('roles*') ? '' : 'collapsed' }} "
                        href="{{ route('roles.index') }}">
                        <i class="bi bi-shield-lock"></i>
                        <span>Roles</span>
                    </a>
                </li>
            @endcan

            @can('voir permissions')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('permissions*') ? '' : 'collapsed' }} "
                        href="{{ route('permissions.index') }}">
                        <i class="bi bi-shield-check"></i>
                        <span>Permissions</span>
                    </a>
                </li>
            @endcan


            <li class="nav-item">
                <a class="nav-link {{ Request::is('repertoire_public*') ? '' : 'collapsed' }} "
                    href="{{ route('repertoire_public.index') }}">
                    <i class="bi bi-folder2-open"></i>
                    <span>Répertoire Public
                        @if (auth()->user()->unreadNotifications->where('type', '=', 'App\Notifications\RepertoirePublicNotification')->count() >= 1)
                            <span class="badge rounded-pill bg-info text-dark">
                                {{ auth()->user()->unReadNotifications->where('type', '=', 'App\Notifications\RepertoirePublicNotification')->count() }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('repertoire_employes') ? '' : 'collapsed' }} "
                    href="{{ route('repertoire_employes.index') }}">
                    <i class="bi bi-person-bounding-box"></i>
                    <span>Répertoire Des Employés</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('suggestions*') ? '' : 'collapsed' }} "
                    href="{{ route('suggestions.index') }}">
                    <i class="bi bi-mailbox"></i>
                    <span>Boite aux suggestions
                        @if (auth()->user()->unreadNotifications->where('type', '=', 'App\Notifications\SuggestionNotification')->count() >= 1)
                            <span class="badge rounded-pill bg-info text-dark">
                                {{ auth()->user()->unReadNotifications->where('type', '=', 'App\Notifications\SuggestionNotification')->count() }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('activités*') ? '' : 'collapsed' }} "
                    href="{{ route('activités.index') }}">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Activités</span>
                </a>
            </li>

            @can('voir présences')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('présences*') ? '' : 'collapsed' }} "
                        href="{{ route('présences.index') }}">
                        <i class="bi bi-menu-button-wide"></i>
                        <span>Présences</span>
                    </a>
                </li>
            @endcan

            {{-- @canany(['admin', 'superviseur'])
      <li class="nav-item">
        <a class="nav-link  {{ Request::is('users*') ? '' : 'collapsed' }} " href="{{ route('users.index') }}">
          <i class="bi bi-person"></i>
          <span>Employés</span>
        </a>
      </li>    
      @endcanany --}}

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('absences*') ? '' : 'collapsed' }} "
                    href="{{ route('absences.index') }}">
                    <i class="bi bi-calendar-plus"></i>
                    <span>Demande D'absences
                        @if (auth()->user()->unreadNotifications->where('type', '=', 'App\Notifications\AbsenceNotification')->count() >= 1)
                            <span class="badge rounded-pill bg-info text-dark">
                                {{ auth()->user()->unReadNotifications->where('type', '=', 'App\Notifications\AbsenceNotification')->count() }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('conges*') ? '' : 'collapsed' }} "
                    href="{{ route('conges.index') }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Demande De Congés
                        @if (auth()->user()->unreadNotifications->where('type', '=', 'App\Notifications\CongeNotification')->count() >= 1)
                            <span class="badge rounded-pill bg-info text-dark">
                                {{ auth()->user()->unReadNotifications->where('type', '=', 'App\Notifications\CongeNotification')->count() }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>

            @can('voir depenses')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('depenses*') ? '' : 'collapsed' }} "
                        href="{{ route('depenses.index') }}">
                        <i class="bi bi-currency-dollar"></i>
                        <span>Dépenses</span>
                    </a>
                </li>
            @endcan

            @can('voir sondage')
                <li class="nav-item">
                    <a class="nav-link text-muted" href="">
                        <i class="bi bi-pie-chart"></i>
                        <span>Sondage</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('avertissements*') ? '' : 'collapsed' }} "
                    href="{{ route('avertissements.index') }}">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>Avertissements
                        @if (auth()->user()->unreadNotifications->where('type', '=', 'App\Notifications\AvertissementNotification')->count() >= 1)
                            <span class="badge rounded-pill bg-danger text-white">
                                {{ auth()->user()->unReadNotifications->where('type', '=', 'App\Notifications\AvertissementNotification')->count() }}
                            </span>
                        @endif
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('rapports*') ? '' : 'collapsed' }} "
                    href="{{ route('rapports.index') }}">
                    <i class="bi bi-files-alt"></i>
                    <span>Raports</span>
                </a>
            </li>

            @can('voir offres')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('offres_emplois*') ? '' : 'collapsed' }} "
                        href="{{ route('offres_emplois.index') }}">
                        <i class="bi bi-journals"></i>
                        <span>Offres
                        </span>
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('fiches_de_paie*') ? '' : 'collapsed' }} "
                    href="{{ route('fiches_de_paie.index') }}">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <span>Fiches de paie</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ Request::is('accounts*') ? '' : 'collapsed' }} "
                    href="{{ route('accounts.index') }}">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <span>Comptes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('transactions*') ? '' : 'collapsed' }} "
                    href="{{ route('transactions.index') }}">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <span>Transactions</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('stockage*') ? '' : 'collapsed' }} "
                    href="{{ route('stockage.index') }}">
                    <i class="bi bi-cloud-arrow-up"></i>
                    <span>Stockage</span>
                </a>
            </li>
        </ul>
    </aside>

    @yield('content')

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Banki Truck</span></strong>. Tous les droits sont réservés
        </div>
        <div class="credits">
            Designed by <a href="https://bankitruck.com/home">BankiTruck</a>
            v1.0.3
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script> --}}

    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

    {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>
