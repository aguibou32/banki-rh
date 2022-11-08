@extends('layouts.app')
@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Activités</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    @if(session()->has('message'))
      <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

      <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus"></i></button>

      <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form method="POST" action="{{ route("activités.store") }}">
            @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ajouter une activité</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Activité</label>
                <div class="col-sm-10">
                  <input type="text" name="activité" class="form-control" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Début</label>
                <div class="col-sm-10">
                  <input type="time" name="début" class="form-control" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Fin</label>
                <div class="col-sm-10">
                  <input type="time" name="fin" class="form-control" required>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Dificulté</label>
                <div class="col-sm-10">
                  <select class="form-select" name="difficulté">
                      <option value="1">1 - Facile </option>
                      <option value="2">2 - Moyen </option>
                      <option value="3">3 - Difficile </option>
                      <option value="4">4 - Très Difficile</option>
                  </select>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
          </div>
        </form>
        </div>
      </div>
      
      <div class="row pt-2 ">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header mb-2">
                <h6 class="text text-dark text-center">A faire</h6>
              </div>
                @foreach ($activités_à_faire as $activité)
                  <div class="card">
                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots text text-dark"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Actions</h6>
                        </li>
                        <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activité_en_progrès", $activité->id) }}">En progrès</a></li>
                        <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activité_fini", $activité->id) }}">Fini</a></li>
                        <hr>
                        {{-- <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activités.edit", $activité->id) }}">Editer</a></li> --}}
                        <li><a style="font-size:12px" class="dropdown-item" href="{{ route("delete", $activité->id) }}">Suprimer</a></li>
                      </ul>
                    </div>
                    <div class="card-body pt-4 bg bg-light">
                      <p class="" style="font-size:12px; color:black">{{ $activité->activité }}</p>
                      <span class="badge rounded-pill bg-primary text-white">{{ $activité->difficulté }}</span>

                    </div>
                  </div>
                @endforeach
            </div>
          </div>

         <div class="col-md-4">
          <div class="card">
            <div class="card-header mb-2">
              <h6 class="text text-dark text-center">En Progrès</h6>
            </div>
            @foreach ($activités_en_progres as $activité)
            <div class="card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots text text-dark"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Actions</h6>
                  </li>
                  <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activité_en_progrès", $activité->id) }}">En progrès</a></li>
                  <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activité_fini", $activité->id) }}">Fini</a></li>
                  <hr>
                  {{-- <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activités.edit", $activité->id) }}">Editer</a></li> --}}
                  <li><a style="font-size:12px" class="dropdown-item" href="{{ route("delete", $activité->id) }}">Suprimer</a></li>
                </ul>
              </div>
              <div class="card-body pt-4 bg bg-light">
                <p class="" style="font-size:12px; color:black">{{ $activité->activité }}</p>
                <span class="badge rounded-pill bg-primary text-white">{{ $activité->difficulté }}</span>
              </div>
            </div>
          @endforeach
          </div>
         </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header mb-2">
                <h6 class="text text-dark text-center">Fini</h6>
              </div>
              @foreach ($activités_fini as $activité)
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots text text-dark"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Actions</h6>
                    </li>
                    <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activité_en_progrès", $activité->id) }}">En progrès</a></li>
                    <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activité_fini", $activité->id) }}">Fini</a></li>
                    <hr>
                    {{-- <li><a style="font-size:12px" class="dropdown-item" href="{{ route("activités.edit", $activité->id) }}">Editer</a></li> --}}
                    <li><a style="font-size:12px" class="dropdown-item" href="{{ route("delete", $activité->id) }}">Suprimer</a></li>
                  </ul>
                </div>
                <div class="card-body pt-4 bg bg-light">
                  <p class="" style="font-size:12px; color:black">{{ $activité->activité }}</p>
                  <span class="badge rounded-pill bg-primary text-white">{{ $activité->difficulté }}</span>
                </div>
              </div>
            @endforeach
            </div>
          </div>
      </div>

      
  </section>
</main>

@endsection