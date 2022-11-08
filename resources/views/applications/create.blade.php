@extends('layouts.public')

@section('content')
<main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto">
                  <img src="{{asset("assets/img/logo.jpeg")}}" alt="">
                </a>
              </div>

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0">Veuiller renseigner le formulaire pour postuler </h5>
                  </div>
                  <form class="row g-3 needs-validation" novalidate  method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                      <label for="name" class="form-label">Nom</label>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control @error('nom') is-invalid @enderror"  id="nom" name="nom" value="{{ old('nom') }}" autocomplete="nom" autofocus required>
                        @error('nom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Prénom</label>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control @error('prénom') is-invalid @enderror"  id="prénom" name="prénom" value="{{ old('prénom') }}" autocomplete="prénom" autofocus required>
                        @error('prénom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Date de naissance</label>
                      <div class="input-group has-validation">
                        <input type="date" class="form-control @error('date_de_naissance') is-invalid @enderror"  id="date_de_naissance" name="date_de_naissance" value="{{ old('date_de_naissance') }}" required autocomplete="date_de_naissance" autofocus required>
                        @error('date_de_naissance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"  id="phone" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="" class="form-label">Téléphone</label>
                      <div class="input-group has-validation">
                        <input type="phone" class="form-control @error('phone') is-invalid @enderror"  id="phone" name="phone" value="{{ old('phone') }}" required autocomplete="dob" autofocus required>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="" class="form-label">Addresse</label>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control @error('addresse') is-invalid @enderror"  id="addresse" name="addresse" value="{{ old('addresse') }}" required autocomplete="addresse" autofocus required>
                        @error('addresse')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="" class="form-label">Motivation</label>
                      <div class="input-group has-validation">
                        <textarea class="form-control @error('motivation') is-invalid @enderror" id="motivation" name="motivation" style="height: 100px" required>
                        {{old("motivation")}}
                        </textarea>
                        @error('motivation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>


                    <div class="col-12">
                      <label for="" class="form-label">CV</label>
                      <div class="input-group has-validation">
                        <input type="file" class="form-control @error('cv') is-invalid @enderror"  id="cv" name="cv" value="{{ old('cv') }}" required autocomplete="cv" autofocus>
                        @error('cv')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="" class="form-label">Autres documents</label>
                      <div class="input-group has-validation">
                        <input type="file" class="form-control @error('autre_documents') is-invalid @enderror"  id="autre_documents" name="autre_documents" value="{{ old('autre_documents') }}" autocomplete="autre_documents" autofocus>
                        @error('autre_documents')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <input type="hidden" name="offre_id" value={{$offre->id}} />
                    
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Soumettre</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

@endsection
