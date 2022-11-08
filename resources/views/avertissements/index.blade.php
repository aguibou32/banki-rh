@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        @if ($avertissements->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Vous n'avez pas encore été averti !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Avertissements</h1>
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
                            @can('editer avertissements')
                                <a href="{{ route('avertissements.create') }}" class="btn btn-primary"><i
                                        class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            {{-- <h5 class="card-title">Liste des avertissements</h5> --}}
                            <!-- Table with hoverable rows -->
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Motif</th>
                                        <th scope="col">Details</th>
                                        @can('editer avertissements')
                                            <th scope="col">Employé Averti</th>
                                        @endcan
                                        <th scope="col">Severité</th>
                                        <th>Date</th>
                                        @can('editer avertissements')
                                            <th scope="col"> Actions </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($avertissements as $avertissement)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $avertissement->titre }}</td>
                                            <td>{{ $avertissement->details }}</td>
                                            @can('editer avertissements')
                                                <td>{{ $avertissement->user->name }} {{ $avertissement->user->surname }}</td>
                                            @endcan
                                            @if ($avertissement->severité == 1)
                                                <td><span
                                                        class="badge rounded-pill bg-success">{{ $avertissement->severité }}</span>
                                                </td>
                                            @endif
                                            @if ($avertissement->severité == 2)
                                                <td><span
                                                        class="badge rounded-pill bg-warning">{{ $avertissement->severité }}</span>
                                                </td>
                                            @endif
                                            @if ($avertissement->severité == 3)
                                                <td><span
                                                        class="badge rounded-pill bg-warning">{{ $avertissement->severité }}</span>
                                                </td>
                                            @endif
                                            @if ($avertissement->severité > 3)
                                                <td><span
                                                        class="badge rounded-pill bg-danger">{{ $avertissement->severité }}</span>
                                                </td>
                                            @endif
                                            <td>{{ date('d F, Y', strtotime($avertissement->created_at)) }}</td>
                                            @can('editer avertissements')
                                                <td>
                                                    <a href="{{ route('avertissements.edit', $avertissement->id) }}"
                                                        class="btn btn-transparent"><i class="bi bi-eye"></i></a>
                                                    <button type="button" class="btn btn-transparent"><i
                                                            class="bi bi-trash text-danger"></i></button>
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
