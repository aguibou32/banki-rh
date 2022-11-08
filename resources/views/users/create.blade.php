@extends('layouts.app')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Formulaire d'ajout d'employé</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route("users.create") }}">Employés</a></li>
          <li class="breadcrumb-item active">Ajout</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter un(e) Employé(e)</h5>
              <form method="POST" action="{{ route("users.store") }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 col-form-label">Matricule</label>
                  <div class="col-sm-8">
                    <input type="text" name="matricule"  class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule') }}"  id="matricule" class="form-control" required>
                    @error('matricule')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 col-form-label">Numéro d'identification (passport)</label>
                  <div class="col-sm-8">
                    <input type="text" name="id_number"  class="form-control @error('id_number') is-invalid @enderror" value="{{ old('id_number') }}"  id="id_number" class="form-control" required>
                    @error('id_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Genre</label>
                  <div class="col-sm-8">
                    
                    <select class="form-select" name="genre">
                      <option value="Masculin">Masculin</option>
                      <option value="Féminim">Féminim</option>
                    </select>
                    @error('genre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 col-form-label">Nationalité</label>
                  <div class="col-sm-8">
                    <input type="text" name="nationality"  class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality') }}"  id="nationality" class="form-control" required>
                    @error('nationality')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 col-form-label">Nom</label>
                  <div class="col-sm-8">
                    <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  id="name" class="form-control" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label">Prénom</label>
                    <div class="col-sm-8">
                      <input type="text" name="surname"  class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}"  id="surname" class="form-control" required>
                      @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-4 col-form-label">Date de naissance</label>
                    <div class="col-sm-8">
                        <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}"  id="dob" class="form-control" required>
                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  id="email" class="form-control" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-4 col-form-label">Phone</label>
                    <div class="col-sm-8">
                      <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"  id="phone" class="form-control" required>
                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-4 col-form-label">Addresse</label>
                    <div class="col-sm-8">
                      <input type="text" name="addresse" class="form-control @error('addresse') is-invalid @enderror" value="{{ old('addresse') }}"  id="addresse" class="form-control" required>
                      @error('addresse')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Pays</label>
                    <div class="col-sm-8">
                      
                      <select class="form-select" name="pays">
                        @foreach ($pays as $pay)
                        <option value="{{ $pay->name }}">{{ $pay->name }}</option>
                        @endforeach
                      </select>
                      @error('pays')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Type d'employé</label>
                    <div class="col-sm-8">
                      <select class="form-select" name="type_employé">
                        <option {{ old('type_employé') == "Interne" ? "selected" : "" }} value="Interne">Interne</option>
                        <option {{ old('type_employé') == "Warior" ? "selected" : "" }} value="Warior">Warior</option>
                      </select>
                    </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Service(Optionel)</label>
                  <div class="col-sm-8">
                    <select class="form-select" name="service_id">
                      @if (count($services)> 0)
                        @foreach ($services as $service)
                          <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                      @else
                          <option disabled>Service indisponible! Ajouter un service plus tard</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-4 col-form-label">Role</label>
                    <div class="col-sm-8">
                      <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}"  id="role" class="form-control" required>
                      @error('role')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Description du role (Optionel)</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="description" style="height: 100px">
                          {{ old('description') }}
                        </textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-4 col-form-label">Date de debut</label>
                    <div class="col-sm-8">
                      <input type="date" name="date_du_debut"  class="form-control @error('date_du_debut') is-invalid @enderror" value="{{ old('date_du_debut') }}"  id="date_du_debut" class="form-control" required>
                      @error('date_du_debut')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Photo (Optionel)</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="profile_picture" type="file" id="formFile">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 1 (optionel)</label>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col col-sm-4">
                        <input class="form-control @error('file1_name') is-invalid @enderror" name="file1_name" type="text" id="" value="{{ old("file1_name") }}" placeholder="nom du fichier">
                        @error('file1_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="col col-sm-8">
                        <input class="form-control @error('file1') is-invalid @enderror" name="file1" type="file" id="">
                        @error('file1')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 2 (optionel)</label>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col col-sm-4">
                        <input class="form-control @error('file2_name') is-invalid @enderror" name="file2_name" type="text" id="" value="{{ old("file2_name") }}" placeholder="nom du fichier">
                        @error('file2_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="col col-sm-8">
                        <input class="form-control @error('file2') is-invalid @enderror" name="file2" type="file" id="">
                        @error('file2')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 3 (optionel)</label>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col col-sm-4">
                        <input class="form-control @error('file3_name') is-invalid @enderror" name="file3_name" type="text" id="" value="{{ old("file3_name") }}" placeholder="nom du fichier">
                        @error('file3_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="col col-sm-8">
                        <input class="form-control @error('file3') is-invalid @enderror" name="file3" type="file" id="">
                        @error('file3')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
               
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 4 (optionel)</label>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col col-sm-4">
                        <input class="form-control @error('file4_name') is-invalid @enderror" name="file4_name" type="text" id="" value="{{ old("file4_name") }}" placeholder="nom du fichier">
                        @error('file4_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="col col-sm-8">
                        <input class="form-control @error('file4') is-invalid @enderror" name="file4" type="file" id="">
                        @error('file4')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 5 (optionel)</label>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col col-sm-4">
                        <input class="form-control @error('file5_name') is-invalid @enderror" name="file5_name" type="text" id="" value="{{ old("file5_name") }}" placeholder="nom du fichier">
                        @error('file5_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="col col-sm-8">
                        <input class="form-control @error('file5') is-invalid @enderror" name="file5" type="file" id="">
                        @error('file5')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 6 (optionel)</label>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col col-sm-4">
                        <input class="form-control @error('file6_name') is-invalid @enderror" name="file6_name" type="text" id="" value="{{ old("file6_name") }}" placeholder="nom du fichier">
                        @error('file6_name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="col col-sm-8">
                        <input class="form-control @error('file6') is-invalid @enderror" name="file6" type="file" id="">
                        @error('file6')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label"></label>
                  <div class="col-sm-8">
                    <button type="submit" href="{{ route("users.create") }}" class="btn btn-primary"><i class="bi bi-save2 me-1" ></i>Sauvegarder</button>
                  </div>
                </div>

              </form>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection