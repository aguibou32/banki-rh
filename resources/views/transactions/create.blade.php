@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ajouter une transaction</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                </ol>
            </nav>
        </div>

        <section class="section">
            @if (session()->has('message'))
                <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <form method="POST" action="{{ route('transactions.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Compte</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="account_id" required>
                                            @foreach ($accounts as $account)
                                                <option value="{{$account->id}}" {{ old('account_id') == $account->id ? 'selected' : '' }} >
                                                    {{$account->numero}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="type">
                                            <option {{old('type') == "retrait"? 'selected': ''}} value="retrait">
                                                Rétrait
                                            </option>
                                            <option {{old('type') == "depot"? 'selected': ''}} value="depot">
                                                Dépot
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Description*</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                            value="{{ old('description') }} cols="3" rows="4">
                                        {{old("description")}}
                                        </textarea>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Montant*</label>
                                    <div class="col-sm-10">
                                        <input type="number" value="{{ old('montant') }}" name="montant"
                                            class="form-control @error('montant') is-invalid @enderror">
                                        @error('montant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Document justificatif
                                        (optionel)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('fichier') is-invalid @enderror" name="fichier"
                                            type="file" id="formFile">
                                        @error('fichier')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Sauvegarder</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
