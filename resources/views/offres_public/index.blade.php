@extends('layouts.public')

@section('content')
<main id="" class="main p-5">

  @if ($offres->isEmpty())
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
       Le journal d'offre est vide pour le moment !
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

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
        <h2>Journal des offres chez Bankitruck</h2>
      </div>
    </div>

   <div class="card">
    <div class="card-header"></div>
    <div class="card-body">
      <div class="row">
        @foreach ($offres as $offre)
        <div class="col col-md-6">
          <div class="card">
            <img src="{{ asset('storage/job_offers_images/'.$offre->image) }}" class="card-img-top" alt="...">
            <div class="card-body">
              <div class="row m-3">
                <div class="col col-md-12">
                  <h5 class="card-title">{{ $offre->titre }}</h5>
                </div>
                @if ($offre->status == "ouvert")
                <a href="{{ route("application", $offre->id) }}" class="btn btn-primary ">Postuler</a>
                @else
                <button class="btn btn-dark disabled ">Fermé</button>
                @endif
              </div>
              <ul>
                <li> Date limite: {{ $offre->date_limite }}</li>
                <li> Status: {{ $offre->status }}</li>
              </ul>
              <p class="card-text">{!! $offre->description !!}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
   </div>
  </div>
</div>
</section>
</main>
@endsection
