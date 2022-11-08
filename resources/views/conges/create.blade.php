@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Congés</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->

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
                            <h5 class="card-title">Veuillez remplir le formulaire</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('conges.store') }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Motif</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('motif') }}" name="motif"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Detaillez votre motif</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="details" style="height: 100px" required>
                                          {{ old('details') }}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Début</label>
                                    <div class="col-sm-10">
                                        <input type="date" value="{{ old('du_date') }}" name="du_date"
                                            class="form-control @error('du_date') is-invalid @enderror" required>
                                        @error('du_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Fin</label>
                                    <div class="col-sm-10">
                                        <input type="date" value="{{ old('au_date') }}" name="au_date"
                                            class="form-control @error('au_date') is-invalid @enderror" required>
                                        @error('au_date')
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
                            </form><!-- End General Form Elements -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
