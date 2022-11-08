@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-center py-4">
            <a href="#" class="logo d-flex align-items-center w-auto">
              <img src="{{ asset("assets/img/logo.jpeg") }}" alt="">
              <span class="d-none d-lg-block">Banki RH</span>
            </a>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Veuillez confirmer votre mot de passe avant de continuer') }}
                    <a class="btn btn-small text text-primary m-2" href="{{URL::previous()}}">Annuler</a>
                </div>
                <div class="card-body my-3">
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirmer') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
