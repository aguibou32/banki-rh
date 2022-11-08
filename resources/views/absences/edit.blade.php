@extends('layouts.app')
@section('content')
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
                            <h5 class="card-title">Details</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('absences.update', $absence->id) }}">

                                @csrf
                                @method('PUT')

                                <input type="hidden" value="{{ $absence->user_id }}" name="user_id">

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Motif</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="motif" value="{{ $absence->motif }}"
                                            class="form-control" @if (!($absence->status == 'en attente')) readonly @endif required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Details du motif</label>
                                    <div class="col-sm-10">
                                        <textarea name="details" class="form-control @error('details') is-invalid @enderror " style="height: 100px" @if (!($absence->status == 'en attente')) readonly @endif>
                        {{ $absence->details }}
                    </textarea>
                                        @error('details')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">De</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="du_heure" value="{{ $absence->du_heure }}"
                                            class="form-control @error('du_heure') is-invalid @enderror" required
                                            @if (!($absence->status == 'en attente')) readonly @endif>

                                        @error('du_heure')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">A</label>
                                    <div class="col-sm-10">
                                        <input type="time" name="au_heure" value="{{ $absence->au_heure }}"
                                            class="form-control @error('au_heure') is-invalid @enderror " required
                                            @if (!($absence->status == 'en attente')) readonly @endif>
                                        @error('au_heure')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                @can('editer absences')
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="status">
                                                <option {{ $absence->status == 'en attente' ? 'selected' : '' }}
                                                    value="en attente">En attente</option>
                                                <option {{ $absence->status == 'approuvé' ? 'selected' : '' }}
                                                    value="approuvé">
                                                    Apprové</option>
                                                <option {{ $absence->status == 'refusé' ? 'selected' : '' }} value="refusé">
                                                    Refusé
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                @endcan

                                @cannot('editer absences')
                                    <input type="hidden" name="status" value="{{ $absence->status }}">
                                @endcannot

                                @can('edit absences')
                                    <div class="row mb-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Raison du refus
                                            (optionel)</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control @error('raison') is-invalid @enderror" name="raison" style="height: 100px"></textarea>
                                            @error('raison')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endcan

                                @if ($absence->status == 'en attente' ||
                                    auth()->user()->can('editer absences'))
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
