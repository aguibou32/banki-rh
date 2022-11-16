@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ajouter une fiche de paie</h1>
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
                            <h5 class="card-title">Ajouter une fiche de paie</h5>
                            <form method="POST" action="{{ route('fiches_de_paie.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Employé(e)*</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="user_id">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }} {{ $user->surname }} ({{ $user->role }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Titre*</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('title') }}" name="title"
                                            class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Comptes*</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('account_id') is-invalid @enderror " name="account_id">
                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}">
                                                    {{ $account->numero }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('account_id')
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
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Description*</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('description') }}" name="description"
                                            class="form-control @error('description') is-invalid @enderror">
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Date*</label>
                                    <div class="col-sm-10">
                                        <input type="date" value="{{ old('date') }}" name="date"
                                            class="form-control @error('date') is-invalid @enderror ">
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Document*</label>
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
