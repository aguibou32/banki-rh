@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        @if ($depenses->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Vous n'avez pas encore ajouté de factures !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Dépenses</h1>
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
                            <a href="{{ route('depenses.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Les dépenses</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Intitulé</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Facture</th>
                                        <th scope="col"> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($depenses as $depense)
                                        <tr>
                                            <th scope="row">#</th>
                                            <td>{{ $depense->intitulé }}</td>
                                            <td>{{ $depense->montant }}</td>
                                            <td>{{ $depense->description }}</td>
                                            <td>
                                                @if ($depense->facture !== null)
                                                    cliquer
                                                    <a
                                                        href="{{ route('telecharger_fichier_depense', $depense->facture) }}">ici</a>
                                                    !
                                                @else
                                                    <p>non ajouté</p>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('depenses.destroy', $depense->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-transparent"><i
                                                            class="bi bi-trash text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->
                            {{-- @if ($depenses->hasPages())
          <nav class="Page navigation example">
            <div class="pagination">
                {{ $depenses->links() }}
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
