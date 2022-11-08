@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Generer un contrat</h1>
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
                            <h5 class="card-title">Veuillez remplir le formulaire</h5>

                            <form method="POST" action="{{ route('contrats.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label @error('type') is-invalid @enderror ">Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="type">
                                            <option value="stage">Stage</option>
                                            <option value="cdd">CDD</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label  ">Début</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="debut" value="{{ old('debut') }}"
                                            class="form-control @error('debut') is-invalid @enderror" required>
                                        @error('debut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label ">Fin</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="fin" value="{{ old('fin') }}"
                                            class="form-control @error('fin') is-invalid @enderror" required>
                                        @error('fin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label  ">Heure
                                        Début</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="heure_debut" value="{{ old('heure_debut') }}"
                                            class="form-control @error('heure_debut') is-invalid @enderror " required>
                                        @error('heure_debut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Heure
                                        Fin</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="heure_fin" value="{{ old('heure_fin') }}"
                                            class="form-control @error('heure_fin') is-invalid @enderror" required>
                                        @error('heure_fin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Employé</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('user_id') is-invalid @enderror "
                                            name="user_id">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                    {{ $user->surname }}
                                                    ({{ $user->role }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Horaire</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="horraire" value="{{ old('horraire') }}"
                                            class="form-control @error('horraire') is-invalid @enderror" required>
                                        @error('horraire')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Salaire de base</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="salaire_de_base" value="{{ old('salaire_de_base') }}"
                                            class="form-control @error('salaire_de_base') is-invalid @enderror" required>
                                        @error('salaire_de_base')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Indemnité de logement</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="logement" value="{{ old('logement') }}"
                                            class="form-control @error('logement') is-invalid @enderror">
                                        @error('logement')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Prime de transport</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="transport" value="{{ old('transport') }}"
                                            class="form-control @error('transport') is-invalid @enderror">
                                        @error('transport')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Responsable hiérarchique</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="responsable_id">
                                            @foreach ($users2 as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                    {{ $user->surname }}
                                                    ({{ $user->role }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Lister les responsabilités de l'employé(e)</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('fonctions') is-invalid @enderror" id="description" name="fonctions"
                                            style="height: 100px" required>
                                        {{ old('fonctions') }} 
                                        </textarea>
                                        @error('fonctions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Signé par</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="signe_par_id">
                                            @foreach ($users2 as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                    {{ $user->surname }} ({{ $user->role }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Action</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Generer le contrat</button>
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
