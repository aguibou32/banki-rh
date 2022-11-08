@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Repertoire public</h1>
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
                <h5 class="card-title">Ajouter un fichier</h5>
                <form method="POST" action="{{ route("repertoire_public.store") }}" enctype="multipart/form-data">
                    @csrf
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Titre*</label>
                    <div class="col-sm-10">
                      <input type="text" name="titre" class="form-control" required>
                    </div>
                  </div>
                 
                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Fichier*</label>
                    <div class="col-sm-10">
                      <input class="form-control" name="fichier" type="file" id="formFile" required>
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