@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">

        @if ($fiches->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Fiches vides
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Mes fiches de paie</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message'))
                        <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card recent-sales overflow-auto">
                        <div class="card-header">
                            @can('editer fiches de paie')
                                <a href="{{ route('fiches_de_paie.create') }}" class="btn btn-primary"><i
                                        class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                            @endcan
                        </div>
                        <div class="card-body p-1">
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        @can('editer fiches de paie')
                                            <th scope="col">Employé(e)</th>
                                        @endcan
                                        <th scope="col">Titre</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Confirmation</th>
                                        <th scope="col">Téléchargement</th>
                                        @can('editer fiches de paie')
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fiches as $fiche)
                                        <tr>
                                            @can('editer fiches de paie')
                                                <td>{{ $fiche->user->name }} {{ $fiche->user->surname }}</td>
                                            @endcan
                                            <td>{{ $fiche->title }}</td>
                                            <td>{{ $fiche->description }}</td>
                                            <td>{{ $fiche->montant }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($fiche->date)->formatLocalized('%d %B %Y') }}
                                            </td>
                                            <td>
                                                @if ($fiche->employee_confirmation == 'non confirmé' &&
                                                    !auth()->user()->hasPermissionTo('editer fiches de paie'))
                                                    <a onclick="return confirm('Etes-vous sûr de vouloir effectuer cette action ?');"  href="{{ route('employee_confirmation', $fiche->id) }}">Confirmer
                                                        Reception</a>
                                                @elseif($fiche->employee_confirmation == 'non confirmé' &&
                                                    auth()->user()->hasPermissionTo('editer fiches de paie'))
                                                    <span class="badge bg-info text-dark">En attente</span>
                                                @elseif($fiche->employee_confirmation == 'confirmé')
                                                    <span class="badge bg-success text-white">Confirmé</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('telecharger_fichier_paie', $fiche->fichier) }}">Télécharger</a>
                                            </td>
                                            @can('editer fiches de paie')
                                                <td>
                                                    <form method="POST"
                                                            action="{{ route('fiches_de_paie.destroy', $fiche->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                onclick="return confirm('Etes-vous sûr de vouloir effectuer cette action ?');"
                                                                class="btn btn-transparent"><i
                                                                    class="bi bi-trash text-danger"></i></button>
                                                        </form>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('utils.data_table')
@endsection
