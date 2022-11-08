@extends('layouts.app')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Présence</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>


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
            @if ( $errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Ajouter votre présence</h5>
  
                <!-- General Form Elements -->
                <form method="POST" action="{{ route("présences.store") }}">
                    @csrf
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                      <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control" readonly>
                      @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Heure D'arrivé</label>
                    <div class="col-sm-10">
                      <input type="time" name="heure_arrivé" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Heure De Départ</label>
                    <div class="col-sm-10">
                      <input type="time" name="heure_départ" class="form-control" required>
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