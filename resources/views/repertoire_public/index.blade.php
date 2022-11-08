@extends('layouts.app')
@section('content')
    @include('utils.to_french')
    <main id="main" class="main">

        @if ($repertoires->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Repertoire vide.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Repertoire Public</h1>
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
                            @can('editer repertoire public')
                                <a href="{{ route('repertoire_public.create') }}" class="btn btn-primary"><i
                                        class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Repertoire public</h5>
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Crée le</th>
                                        <th scope="col">Télécharger Fichiers</th>
                                        @can('editer repertoire public')
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($repertoires as $repertoire)
                                        <tr>
                                            <td>{{ $repertoire->titre }}</td>
                                            <td>{{ Carbon\Carbon::parse($repertoire->created_at)->formatLocalized('%d %B %Y') }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('telecharger_fichier_public', $repertoire->fichier) }}">Télécharger</a>
                                            </td>
                                            @can('editer repertoire public')
                                            <td>
                                                <form method="POST" action="{{ route("repertoire_public.destroy", $repertoire->id) }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-transparent"><i class="bi bi-trash text-danger"></i></button>
                                                </form>
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('utils.data_table')
@endsection
