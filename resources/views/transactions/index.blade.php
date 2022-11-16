@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">

        @if ($transactions->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Aucune transaction
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Table des transactions</h1>
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
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary"><i
                                    class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                        </div>
                        <div class="card-body p-1">
                            <table id="myTable" class="table table-hover" data-ordering="false">
                                <thead>
                                    <tr>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Dernière modification</th>
                                        <th scope="col">Rétrait</th>
                                        <th scope="col">Dépot</th>
                                        <th scope="col">Compte</th>
                                        <th scope="col">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->description }}</td>
                                            <td>{{ Carbon\Carbon::parse($transaction->created_at)->translatedFormat('l j F Y H:i:s') }}
                                            <td>{{ Carbon\Carbon::parse($transaction->updated_at)->translatedFormat('l j F Y H:i:s') }}
                                            <td>
                                                @if ($transaction->retrait != null)
                                                    <p class="text text-danger"> -@money($transaction->retrait)</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($transaction->depot != null)
                                                    <p class="text text-success">+@money($transaction->depot)</p>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $transaction->account->numero }}
                                            </td>
                                            <td class="font-weight-bold {{$transaction->balance <0 ? 'text text-danger' : ''}}   ">@money($transaction->balance)</td>
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
