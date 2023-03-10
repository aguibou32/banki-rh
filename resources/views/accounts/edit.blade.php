@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Modification d'un compte</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
  
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
                <h5 class="card-title">Modifier un Compte</h5>
  
                <!-- General Form Elements -->
                <form method="POST" action="{{ route("accounts.update", $account->id)}}">
                  @csrf
                  @method("PUT")
                  <input type="hidden" value="{{$account->id}}" name="account_id" id="">
                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Numero du compte</label>
                    <div class="col-sm-10">
                      <input type="text" name="numero" class="form-control @error('numero') is-invalid @enderror " value="{{ $account->numero }}" required>
                      @error('numero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Solde Initial</label>
                    <div class="col-sm-10">
                      <input type="number" name="solde" class="form-control @error('solde') is-invalid @enderror " value="{{ $account->solde }}" required>
                      @error('solde')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Sauvegarder</label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
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