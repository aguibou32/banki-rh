@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        @if ($absences->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Vous vous êtes pas encore absenté !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Absences</h1>
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

                    <div class="card ">
                        <div class="card-header">
                            <a href="{{ route('absences.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Liste des absences</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Motif</th>
                                        <th scope="col">Details du motif</th>
                                        @can('editer absences')
                                            <th scope="col">Démandeur</th>
                                        @endcan
                                        <th scope="col">Période</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Raison</th>
                                        <th scope="col"> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absences as $absence)
                                        <tr>
                                            <th scope="row">{{ date('d F, Y', strtotime($absence->created_at)) }}</th>
                                            <td>{{ $absence->motif }}</td>
                                            <td>{{ $absence->details }}</td>
                                            @can('editer absences')
                                                <td>{{ $absence->user->name }} {{ $absence->user->surname }}</td>
                                            @endcan
                                            <td>{{ $absence->du_heure }} - {{ $absence->au_heure }}</td>
                                            @if ($absence->status == 'approuvé')
                                                <td><span
                                                        class="badge rounded-pill bg-success">{{ $absence->status }}</span>
                                                </td>
                                            @endif
                                            @if ($absence->status == 'en attente')
                                                <td><span class="badge rounded-pill bg-info">{{ $absence->status }}</span>
                                                </td>
                                            @endif
                                            @if ($absence->status == 'refusé')
                                                <td><span
                                                        class="badge rounded-pill bg-danger">{{ $absence->status }}</span>
                                                </td>
                                            @endif
                                            <td>{{ $absence->raison }}</td>

                                            <td>
                                                <a href="{{ route('absences.edit', $absence->id) }}"
                                                    class="btn btn-transparent"><i class="bi bi-eye"></i></a>
                                                @can('editer absences')
                                                    <form method="POST"
                                                        action="{{ route('absences.destroy', $absence->id) }}">
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
                            <!-- End Table with hoverable rows -->
                            {{-- @if ($absences->hasPages())
                                <nav class="Page navigation example">
                                    <div class="pagination">
                                        {{ $absences->links() }}
                                    </div>
                                </nav>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('utils.data_table')
@endsection
