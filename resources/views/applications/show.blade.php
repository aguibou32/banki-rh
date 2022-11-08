@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Application</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Applications</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-10">
          @if ( $errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
          @endif
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Aperçu et documents soumis</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                  <h5 class="card-title">A propos</h5>
                  {{-- <p class="small fst-italic">{{ $application->description }}</p> --}}

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom complet</div>
                    <div class="col-lg-9 col-md-8">{{ $application->nom }} {{ $application->prénom }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date de Naissace</div>
                    <div class="col-lg-9 col-md-8">{{ $application->date_de_naissance }}</div>
                  </div>
                  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ $application->email }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Téléphone</div>
                    <div class="col-lg-9 col-md-8">{{ $application->phone }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Addresse</div>
                    <div class="col-lg-9 col-md-8">{{ $application->phone }}</div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Motivation</div>
                    <div class="col-lg-9 col-md-8">{!! $application->motivation !!}</div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">CV</div>
                    <div class="col-lg-9 col-md-8"><a href="{{ asset('storage/offres_public/'. $application->cv) }}" target="_blank">CV</a></div>
                  </div>
                 
                  @if ($application->autre_documents !== null)
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Autre documents</div>
                      <div class="col-lg-9 col-md-8"><a href="{{ asset('storage/offres_public/'. $application->autre_documents) }}" target="_blank">autre documents</a></div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection