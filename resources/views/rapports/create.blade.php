@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ecrivez votre rapport</h1>
            <nav>
                <ol class="breadcrumb">
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
                            <h5 class="card-title"></h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('rapports.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="type" required>
                                            <option value="journalier">Journalier</option>
                                            <option value="hebdomadaire">Hebdomadaire</option>
                                            <option value="mensual">Mensuel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" value="{{ old('date') }}" name="date"
                                            class="form-control @error('date') is-invalid @enderror">
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Titre</label>
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
                                    <label for="" class="col-sm-2 col-form-label">Service</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="service"
                                            value="{{ auth()->user()->service != null ? auth()->user()->service->name : '' }}"
                                            class="form-control" readonly>
                                        @if (auth()->user()->service == null)
                                            <small class="text text-danger">Vous n'avez pas été assigné à un service.
                                                Veuillez contacter l'administrateur !</small>
                                        @endif
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Contenu du rapport</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('content') is-invalid @enderror" id="description" name="content" required>
                                      {{ old('content') }} 
                                      </textarea>
                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Fichier</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('rapport_fichier') is-invalid @enderror " name="rapport_fichier" type="file"
                                            id="rapport_fichier">
                                        @error('rapport_fichier')
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
