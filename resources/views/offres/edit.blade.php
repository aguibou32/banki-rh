@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Offres d'emploi</h1>
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
                <form method="POST" action="{{ route("offres_emplois.update", $offre->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Titre du poste</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $offre->titre }}" name="titre" class="form-control @error('titre') is-invalid @enderror">
                      @error('titre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Image Illustrative</label>
                    <div class="col-sm-10">
                      <input class="form-control @error('image') is-invalid @enderror" value="{{ $offre->image }}" name="image" type="file" id="image">
                      @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description du poste</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="description" @error('description') is-invalid @enderror" name="description" style="height: 100px">
                      {!! $offre->description !!}
                      </textarea>
                      @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Date Limite</label>
                    <div class="col-sm-10">
                      <input type="date" name="date_limite" class="form-control @error('date_limite') is-invalid @enderror" value="{{ $offre->date_limite }}">
                      @error('date_limite')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">status</label>
                    <div class="col-sm-10">
                      <select class="form-select @error('status') is-invalid @enderror" name="status">
                          <option value="ouvert" {{ $offre->status == "ouvert"? "selected":"" }}>ouvert</option>
                          <option value="fermé" {{ $offre->status == "fermé"? "selected":"" }} >fermé</option>
                      </select>
                      @error('status')
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