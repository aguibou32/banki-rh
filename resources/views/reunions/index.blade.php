@extends('layouts.app')
@section('content')
    @include('utils.to_french')
    <main id="main" class="main">

        @if ($reunions->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Liste des rapports de reunions est encore vide.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->count() > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Réunions</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message'))
                        <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            @can('éditer reunions')
                                <a href="{{ route('reunions.create') }}" class="btn btn-primary"><i
                                        class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Liste des reunions</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Télécharger</th>
                                        <th scope="col">Crée le </th>
                                        @can('editer réunions')
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reunions as $reunion)
                                        <tr>
                                            <td>{{ $reunion->titre }}</td>
                                            <td>
                                                @if ($reunion->fichier !== null)
                                                    cliquer
                                                    <a
                                                        href="{{ route('telecharger_fichier_reunion', $reunion->fichier) }}">ici</a>
                                                    !
                                                @endif
                                            </td>

                                            <td>{{ $reunion->created_at->formatLocalized('%d %B %Y') }}</td>

                                            @can('éditer reunions')
                                                <td>
                                                    <a href="{{ route('reunions.show', $reunion->id) }}"
                                                        class="btn btn-transparent"><i class="bi bi-eye"></i></a>

                                                    <a href="{{ route('reunions.edit', $reunion->id) }}"
                                                        class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a>
                                                    <form method="POST" action="{{ route('reunions.destroy', $reunion->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-transparent"><i
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
