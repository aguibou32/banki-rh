@extends('layouts.app')
@section('content')
<main id="main" class="main">

  @if ($offres->isEmpty())
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      Vous n'avez pas encore ajouté d'offres !
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="pagetitle">
    <h1>Offres</h1>
    <nav>
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
      </ol>
    </nav>
  </div><!-- End Page Title -->

<section class="section">
<div class="row">
  <div class="col-lg-12">
    @if(session()->has('message'))
      <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="card">
      <div class="card-header">
       @can('editer offres')
       <a href="{{ route("offres_emplois.create") }}" class="btn btn-primary"><i class="bi bi-plus-circle" >{{ " " }}</i>Ajouter</a>
       @endcan
      </div>
    </div>

    <div class="row">
      @foreach ($offres as $offre)
      <div class="col col-md-6">
        <div class="card">
          <img src="{{ asset('storage/job_offers_images/'.$offre->image) }}" class="card-img-top" alt="...">
          <div class="card-body">
            <div class="row m-3">
              <div class="col col-md-8">
                <h5 class="card-title">{{ $offre->titre }}</h5>
              </div>
              <div class="col col-md-4">
                <a href="{{ route("offres_emplois.edit", $offre->id) }}" class="btn btn-outlined">Editer</a>
                <a href="{{ route("offres_emplois.edit", $offre->id) }}" class="btn btn-outlined btn-small text-danger">Suprimer</a>
              </div>
            </div>
            <ul>
              <li> Date limite: {{ $offre->date_limite }}</li>
              <li> Status: {{ $offre->status }}</li>
              <a href="{{ route("offre_applications", $offre->id) }}"><li class="text text-primary">applications: {{ count($offre->applications) }}</li></a>
            </ul>
            <p class="card-text">{!! $offre->description !!}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
</section>
</main>
@endsection