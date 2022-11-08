@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">

        @if ($services->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Liste des services est vide.
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
            <h1>Services</h1>
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
                            @can('éditer services')
                                <a href="{{ route('services.create') }}" class="btn btn-primary"><i
                                        class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Liste des Services</h5>
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Département</th>
                                        <th scope="col">Division</th>
                                        <th scope="col">Crée il ya </th>
                                        @can('editer services')
                                            <th scope="col">Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td>{{ $service->departement->name }}</td>
                                            <td>{{ $service->departement->division->name }}</td>
                                            <td>{{ $service->created_at->formatLocalized('%d %B %Y') }}</td>
                                            @can('éditer services')
                                                <td>
                                                    <a href="{{ route('services.edit', $service->id) }}"
                                                        class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a>
                                                    <form method="POST"
                                                        action="{{ route('services.destroy', $service->id) }}">
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
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('utils.data_table')
@endsection
