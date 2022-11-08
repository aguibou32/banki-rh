@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        @if ($stockages->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Stockage est vide.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Stockage</h1>
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
                            <a href="{{ route('stockage.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Stockage</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Télécharger Fichiers</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stockages as $stockage)
                                        <tr>
                                            <th scope="row">#</th>
                                            <td>{{ $stockage->titre }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('telecharger_fichier_stockage', $stockage->fichier) }}">Télécharger</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('stockage.edit', $stockage->id) }}"
                                                    class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" class="btn btn-transparent"><i
                                                        class="bi bi-trash text-danger"></i></button>
                                            </td>
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
