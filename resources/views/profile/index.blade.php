@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
        <section class="section profile">
            @if (session()->has('message'))
                <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ asset('storage/photos_profile/' . $user->profile_picture) }}" alt="Profile"
                                class="rounded-circle">
                            <h2>{{ $user->name }} {{ $user->surname }}</h2>
                            <h3>{{ $user->role }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                        aria-selected="true" role="tab">Aperçu</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                        aria-selected="false" role="tab" tabindex="-1">Editer le Profile</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-change-password"
                                        aria-selected="false" role="tab" tabindex="-1">Changer de mot de passe</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade profile-overview active show" id="profile-overview"
                                    role="tabpanel">
                                    <h5 class="card-title">A propos</h5>
                                    <p class="small fst-italic">{{ $user->description }}</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Matricule</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->matricule }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nom complet</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->name }} {{ $user->surname }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nationalité</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->nationality }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Numéro D'identité</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->id_number }}</div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Date de Naissace</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->dob }}</div>
                                    </div>

                                    @if ($user->service !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Service</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->service->name }}</div>
                                        </div>
                                    @endif

                                    @if ($user->service !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Departement</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->service->département->name }}</div>
                                        </div>
                                    @endif

                                    @if ($user->service !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Division</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ $user->service->département->division->name }}</div>
                                        </div>
                                    @endif


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pays</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->pays }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Role</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->role }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Description</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->description }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Type D'employé</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->type_employé }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">A débuté le</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->date_du_debut }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Addresse</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->addresse }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo de
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="{{ asset('storage/photos_profile/' . $user->profile_picture) }}"
                                                alt="Profile">
                                            @if (!($user->profile_picture == "user.png"))
                                            <div class="pl-2">
                                                <a href="{{ route('supprimer_photo', $user->id) }}"
                                                    class="btn btn-sm text-danger" title="Surpimer photo de profile"><i
                                                        class="bi bi-trash"></i></a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>


                                    <form method="POST" action="{{ route('profile.update', $user->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Photo de
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input class="form-control @error('profile_picture') is-invalid @enderror"
                                                    name="profile_picture" type="file" id="profile_picture">
                                                @error('profile_picture')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="surname" type="text"
                                                    class="form-control @error('surname') is-invalid @enderror"
                                                    id="fullName" value={{ $user->surname }}>
                                                @error('surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror "
                                                    id="fullName" value={{ $user->name }}>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName"
                                                class="col-md-4 col-lg-3 col-form-label">Addresse</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="addresse" type="text" class="form-control @error('addresse') is-invalid @enderror"
                                                    id="fullName">{{ $user->addresse }} </textarea>
                                                @error('addresse')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    id="fullName" value={{ $user->phone }}>
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="fullName" value={{ $user->email }}>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Date De
                                                Naiss.</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="date" name="dob"
                                                    class="form-control @error('dob') is-invalid @enderror"
                                                    value={{ $user->dob }} id="dob" class="form-control">
                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                    <form method="POST" action="/changer_mdp">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="user_id">


                                        <div class="row mb-3">
                                            <label for="current_pwd" class="col-md-4 col-lg-3 col-form-label">Actuel Mot
                                                de passe</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_pwd" type="password"
                                                    class="form-control @error('current_pwd') is-invalid @enderror"
                                                    id="current_pwd">
                                                @error('current_pwd')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de
                                                passe</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm"
                                                class="col-md-4 col-lg-3 col-form-label">Confirmez mot de passe</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation" required autocomplete="new-password">
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Changer mot de passe</button>
                                        </div>
                                    </form><!-- End Change Password Form -->
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
