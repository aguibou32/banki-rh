@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Reunions</h1>
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
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Editer une reunion</h5>
  
                <!-- General Form Elements -->
                <form method="POST" action="{{ route("reunions.update", $reunion->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Titre</label>
                    <div class="col-sm-10">
                      <input type="text" name="titre" value="{{ $reunion->titre }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Contenu</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="contenu" style="height: 100px" required>
                       {{ $reunion->reunion }}
                      </textarea>
                    </div>
                  </div>
                 
                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Fichier (Optionel)</label>
                    <div class="col-sm-10">
                      <input class="form-control" name="fichier" type="file" id="formFile">
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