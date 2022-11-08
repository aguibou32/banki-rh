@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Conges</h1>
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
                            <h5 class="card-title">Details</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('conges.update', $conge->id) }}">

                                @csrf
                                @method('PUT')

                                <input type="hidden" value="{{ $conge->user_id }}" name="user_id">

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Motif</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="motif" value="{{ $conge->motif }}"
                                            class="form-control" @if (!($conge->status == 'en attente')) readonly @endif required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Details votre motif</label>
                                    <div class="col-sm-10">
                                        <textarea name="details" class="form-control" style="height: 100px" @if (!($conge->status == 'en attente')) readonly @endif
                                            required>
                        {{ $conge->details }}
                    </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">De</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="du_date" value="{{ $conge->du_date }}"
                                            class="form-control" required @if (!($conge->status == 'en attente')) readonly @endif>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">A</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="au_date" value="{{ $conge->au_date }}"
                                            class="form-control" required @if (!($conge->status == 'en attente')) readonly @endif>
                                    </div>
                                </div>

                                @can('editer conges')
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="type"
                                                @if (!($conge->status == 'en attente')) readonly @endif>
                                                <option value="Non Payé">Non Payé</option>
                                                <option value="Payé">Payé</option>Payé</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="" class="col-sm-2 col-form-label">Montant</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="montant" value="{{ $conge->montant }}"
                                                class="form-control @error('montant') is-invalid @enderror " required @if (!($conge->status == 'en attente')) readonly @endif>
                                            @error('montant')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="status">
                                                <option {{ old('status') == 'en attente' ? 'selected' : '' }}
                                                    value="en attente">En attente</option>
                                                <option {{ old('status') == 'approuvé' ? 'selected' : '' }} value="approuvé">
                                                    Approuvé</option>
                                                <option {{ old('status') == 'refusé' ? 'selected' : '' }} value="refusé">Refusé
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Raison du refus
                                            (optionel)</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control @error('raison') is-invalid @enderror" name="raison" style="height: 100px"
                                                @if (!($conge->status == 'en attente')) readonly @endif>
                                            {{ $conge->raison }}</textarea>
                                            @error('raison')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endcan

                                @cannot('editer conges')
                                    <input type="hidden" name="status" value="{{ $conge->status }}">
                                    <input type="hidden" name="type" value="{{ $conge->type }}">
                                    <input type="hidden" name="montant" value="{{ $conge->montant }}">
                                @endcannot

                                @if ($conge->status == 'en attente' ||
                                    auth()->user()->can('editer conges'))
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Sauvegarder</label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        </div>
                                    </div>
                                @endif

                            </form><!-- End General Form Elements -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
