@extends('layouts.app')
@section('content')
@include('utils.to_french')

    <main id="main" class="main">

        @if ($contrats->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Liste des contrats encore vide.
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
            <h1>Contrats</h1>
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

                    <div class="card recent-sales overflow-auto">
                        <div class="card-header">
                            @can('éditer contrats')
                                <a href="{{ route('contrats.create') }}" class="btn btn-primary"><i
                                        class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Liste des contrats</h5>
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col">Employé</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Période</th>
                                        <th scope="col">Durée</th>
                                        <th scope="col">Générer</th>
                                        <th scope="col">Crée le </th>
                                        @can('editer contrats')
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contrats as $contrat)
                                        <tr>
                                            <td>{{ $contrat->user->name }} {{ $contrat->user->surname }}</td>
                                            <td>{{ $contrat->type }}</td>
                                            <td>{{ Carbon\Carbon::parse($contrat->debut)->formatLocalized('%d %B %Y')}}- {{ Carbon\Carbon::parse($contrat->fin)->formatLocalized('%d %B %Y') }} </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($contrat->debut)->diffInMonths(Carbon\Carbon::parse($contrat->fin))}} mois
                                            </td>
                                            <td>
                                                @if ($contrat->type == "cdd")
                                                <a href="{{ route("generate_contrat", $contrat->id) }}">Générer en pdf</a>
                                                @elseif($contrat->type == "stage")
                                                <a href="{{ route("generate_stage", $contrat->id) }}">Générer en pdf</a>
                                                @endif
                                            </td>

                                            <td>{{ $contrat->created_at->formatLocalized('%d %B %Y') }}</td>
                                            @can('editer contrats')
                                            <td>
                                                <a href="{{ route('contrats.edit', $contrat->id) }}"
                                                    class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a>
                                                <form method="POST" action="{{ route('contrats.destroy', $contrat->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Etes-vous de vouloir effectuer cette action ?');" class="btn btn-transparent"><i
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
