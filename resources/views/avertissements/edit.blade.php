@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Avertissements</h1>
      <nav>
        <ol class="breadcrumb">
          {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
        </ol>
      </nav>
    </div><!-- End Page Title -->
  
    <section class="section">
        @if(session()->has('message'))
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
                <form method="POST" action="{{ route("avertissements.update", $avertissement->id) }}">
                    @csrf
                    @method("PUT")

                  <input type="hidden" name="user_id" value="{{ $avertissement->user_id }}">
                  
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Motif</label>
                    <div class="col-sm-10">
                      <input type="text" name="titre" class="form-control" value="{{ $avertissement->titre }}" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Details</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="details" style="height: 100px" required>
                        {{ $avertissement->details }}
                      </textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Severité</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="severité">
                          <option value="1" {{ $avertissement->severité == "1"? 'selected':'' }}>1</option>
                          <option value="2" {{ $avertissement->severité == "2"? 'selected':'' }}>2</option>
                          <option value="3" {{ $avertissement->severité == "3"? 'selected':'' }}>3</option>
                          <option value="4" {{ $avertissement->severité == "4"? 'selected':'' }}>4</option>
                          <option value="5" {{ $avertissement->severité == "5"? 'selected':'' }}>5</option>
                      </select>
                    </div>
                  </div>


                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Employé averti</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="user_id">
                        @foreach ($users as $user)
                          <option value="{{ $user->id }}" {{ $avertissement->user_id == $user->id ? 'selected':'' }} >{{ $user->name }} {{ $user->surname }} ({{ $user->role }})</option>
                        @endforeach
                      </select>
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