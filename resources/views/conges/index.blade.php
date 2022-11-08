@extends('layouts.app')
@section('content')
    @include('utils.to_french')
    <main id="main" class="main">

        @if ($conges->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Vous n'avez pas encore pris de congés !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Congés</h1>
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
                            <a href="{{ route('conges.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Liste des congés</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Motif</th>
                                        <th scope="col">Details du motif</th>
                                        @can('editer conges')
                                            <th scope="col">Démandeur</th>
                                        @endcan
                                        <th scope="col">Période</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Raison</th>
                                        <th scope="col"> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($conges as $conge)
                                        <tr>
                                            <th scope="row">{{ $conge->created_at }}</th>
                                            <td>{{ $conge->motif }}</td>
                                            <td>{{ $conge->details }}</td>
                                            @can('editer conges')
                                                <td>{{ $conge->user->name }} {{ $conge->user->surname }}</td>
                                            @endcan
                                            <td>{{ Carbon\Carbon::parse($conge->du_date)->formatLocalized('%d %B %Y') }} -
                                                {{ Carbon\Carbon::parse($conge->au_date)->formatLocalized('%d %B %Y') }}</td>
                                            @if ($conge->status == 'approuvé')
                                                <td><span class="badge rounded-pill bg-success">{{ $conge->status }}</span>
                                                </td>
                                            @endif
                                            @if ($conge->status == 'en attente')
                                                <td><span class="badge rounded-pill bg-info">{{ $conge->status }}</span>
                                                </td>
                                            @endif
                                            @if ($conge->status == 'refusé')
                                                <td><span class="badge rounded-pill bg-danger">{{ $conge->status }}</span>
                                                </td>
                                            @endif
                                            <td>{{ $conge->type }}</td>
                                            <td>GNF{{ $conge->montant }}</td>
                                            <td>{{ $conge->raison }}</td>

                                            <td>
                                                <a href="{{ route('conges.edit', $conge->id) }}"
                                                    class="btn btn-transparent"><i class="bi bi-eye"></i></a>
                                                @can('editer conges')
                                                    <form method="POST" action="{{ route('conges.destroy', $conge->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-transparent"><i
                                                                class="bi bi-trash text-danger"></i></button>
                                                    </form>
                                                @endcan
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
