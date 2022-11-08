@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Activité</h1>
      <nav>
        <ol class="breadcrumb">
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
                <form method="POST" action="{{ route("activites.update", $activité->id) }}">
                    @csrf
                    @method("PUT")
                  <input type="hidden" name="présence_id" value="{{ $activité->présence->id }}">
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Activité</label>
                    <div class="col-sm-9">
                      <input type="text" name="activité" value="{{ $activité->activité }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Début</label>
                    <div class="col-sm-9">
                      <input type="time" name="début" value="{{ $activité->début }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-3 col-form-label">Fin</label>
                    <div class="col-sm-9">
                      <input type="time" name="fin" value="{{ $activité->fin }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="description" style="height: 100px" required>
                        {{ $activité->description }}
                      </textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Difficulté</label>
                    <div class="col-sm-9">
                      <select class="form-select" name="difficulté">
                       <option value="1"{{ $activité->difficulté == 1 ? 'selected':'' }}>1</option>
                       <option value="2"{{ $activité->difficulté == 2 ? 'selected':'' }}>2</option>
                       <option value="3"{{ $activité->difficulté == 3 ? 'selected':'' }}>3</option>
                       <option value="4"{{ $activité->difficulté == 4 ? 'selected':'' }}>4</option>
                       <option value="5"{{ $activité->difficulté == 5 ? 'selected':'' }}>5</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <select class="form-select" name="status">
                       <option value="en progrès"{{ $activité->status == "en progrès" ? 'selected':'' }}>En progrès</option>
                       <option value="en revue"{{ $activité->status == 'en revue' ? 'selected' :'' }}>En revue</option>
                       <option value="fini"{{ $activité->status == 'fini' ? 'selected' :'' }}>Fini</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Sauvegarder</label>
                    <div class="col-sm-9">
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