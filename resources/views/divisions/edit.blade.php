@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Editer cette division</h1>
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
                <form method="POST" action="{{ route("divisions.update", $division->id) }}">
                    @csrf
                    @method("PUT")
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" value="{{ $division->name }}" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="description" style="height: 100px" required>
                      {{ $division->description }}
                      </textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Responsable</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="responsable_id">
                        @foreach ($users as $user)
                          <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }} ({{ $user->role }})</option>
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

            <div class="card">
              <div class="card-header"></div>
              <div class="card-body">
                <h5 class="card-title">Liste des départements</h5>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nom</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($division->départements as $département)
                      <tr>
                        <th scope="row">{{ $département->id }}</th>
                        <td>{{ $département->name}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                <!-- End Table with hoverable rows -->
              </div>
            </div>
          </div>
        </div>
      </section>
  </main>
@endsection