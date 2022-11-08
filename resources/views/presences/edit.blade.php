@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Congés</h1>
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
                <h5 class="card-title">Details</h5>
  
                <!-- General Form Elements -->
                <form method="POST" action="{{ route("changer_absence_status") }}">
                    @csrf

                  <input type="hidden" name="absence_id" value={{ $absence->id }} id="">
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Motif</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $absence->motif }}" class="form-control" readonly disabled required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Details votre motif</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="height: 100px" readonly disabled required>
                        {{ $absence->details }}
                    </textarea>
                    </div>
                  </div>
                 
                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">De</label>
                    <div class="col-sm-10">
                      <input type="time" value="{{ $absence->du_heure }}" class="form-control" required disabled>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">A</label>
                    <div class="col-sm-10">
                      <input type="time" value="{{ $absence->au_heure }}" class="form-control" required disabled>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-select" name="status">
                        <option {{ old('status') == "En attente" ? "selected" : "" }} value="En attente">En attente</option>
                        <option {{ old('status') == "Apprové" ? "selected" : "" }} value="Apprové">Apprové</option>
                        <option {{ old('status') == "Refusé" ? "selected" : "" }} value="Refusé">Refusé</option>
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
          </div>
        </div>
      </section>
  </main>
@endsection