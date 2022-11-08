@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        @if ($rapports->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Liste de vos rapports est vide.
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
            <h1>Rapports</h1>
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
                            <a href="{{ route('rapports.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Liste de vos rapports</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Type</th>
                                        <th scope="col">Auteur</th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Fichier</th>
                                        <th scope="col">Crée il ya </th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rapports as $rapport)
                                        <tr>
                                            <td>{{ $rapport->type }}</td>
                                            <td>{{ $rapport->user->name }} {{ $rapport->user->surname }}</td>
                                            <td>{{ $rapport->title }}</td>
                                            <td>{{ $rapport->service->name }}</td>
                                            <td>
                                                @if ($rapport->rapport_file !== null)
                                                <a href="{{ route('telecharger_fichier_rapport', $rapport->rapport_file) }}">Télécharger</a>
                                                @else
                                                    vide
                                                @endif
                                            </td>
                                            <td>{{ date('d F, Y', strtotime($rapport->created_at))}}</td>

                                            <td>
                                                <a href="{{ route('rapports.show', $rapport->id) }}"
                                                    class="btn btn-transparent"><i class="bi bi-eye"></i></a>
                                                <a href="{{ route('rapports.edit', $rapport->id) }}"
                                                    class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a>
                                                <form method="POST"
                                                    action="{{ route('rapports.destroy', $rapport->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Etes-vous de vouloir effectuer cette action ?');"
                                                        class="btn btn-transparent"><i
                                                            class="bi bi-trash text-danger"></i></button>
                                                </form>
                                            </td>
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
