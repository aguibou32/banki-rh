@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Comptes</h1>
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
                            <a href="{{ route('accounts.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                        </div>
                        <div class="card-body recent-sales overflow-auto">
                            <h5 class="card-title">Liste des comptes</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col">Création</th>
                                        <th scope="col">Dernière modification</th>
                                        <th scope="col">Numéro du compte</th>
                                        <th scope="col"> Solde </th>
                                        <th scope="col"> Transactions </th>
                                        @can('editer comptes')
                                            <th scope="col"> Actions </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts as $account)
                                        <tr>
                                            <td>{{ Carbon\Carbon::parse($account->created_at)->translatedFormat('l j F Y H:i:s') }}
                                            <td>{{ Carbon\Carbon::parse($account->updated_at)->translatedFormat('l j F Y H:i:s') }}
                                            <td>{{ $account->numero }}</td>
                                            <td>
                                                @if ($account->solde > 0)
                                                    <p class="text text-success">
                                                        @money($account->solde)
                                                    </p>
                                                @else
                                                    <p class="text text-danger">
                                                        @money($account->solde)
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                {{$account->transactions->count()}}
                                            </td>
                                            @can('editer comptes')
                                            <td>
                                                <a href="{{ route('accounts.edit', $account->id) }}" type="button"
                                                    class="btn btn-transparent"><i class="bi bi-pencil"></i></a>
                                                <form method="POST" action="{{ route('accounts.destroy', $account->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Etes-vous sûr de vouloir effectuer cette action? Toutes les transactions liées à ce compte seront suprimées ?');"
                                                        class="btn btn-transparent"><i
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
