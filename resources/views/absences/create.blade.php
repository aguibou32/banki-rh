@extends('layouts.app')
@section('content')
    @include('utils.to_french')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Absences</h1>
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
                            <form method="POST" action="{{ route('absences.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Motif</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old("motif") }}" name="motif" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Detaillez votre motif</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('details') is-invalid @enderror" name="details" style="height: 100px" required>
                                        {{ old("details") }}
                                        </textarea>

                                        @error('details')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Du</label>
                                    <div class="col-sm-10">
                                        <input name="du_heure" type="time" value="{{ old("du_heure") }}"
                                            class="form-control @error('du_heure') is-invalid @enderror" required>
                                        @error('du_heure')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Au</label>
                                    <div class="col-sm-10">
                                        <input name="au_heure" type="time" name="fin" value="{{ old("au_heure") }}"
                                            class="form-control @error('au_heure') is-invalid @enderror" required>
                                        @error('au_heure')
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
