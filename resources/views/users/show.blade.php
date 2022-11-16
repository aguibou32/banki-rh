@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Utilisateur</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">Utilisateur</li>
                </ol>
            </nav>
        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="{{ asset('storage/photos_profile/' . $user->profile_picture) }}" alt="Profile"
                                class="rounded-circle">
                            <h2>{{ $user->name }} {{ $user->surname }}</h2>
                            <h3>{{ $user->role }}</h3>
                            <div class="social-links mt-2">
                                <div class="row">
                                    @if ($user->status == 1)
                                        <div class="col-lg-9 col-md-8"><span class="badge bg-success"><i
                                                    class="bi bi-check-circle me-1"></i> UTILISATEUR ACTIF</span></div>
                                    @else
                                        <div class="col-lg-9 col-md-8"><span class="badge bg-danger"><i
                                                    class="bi bi-exclamation-octagon me-1"></i> UTILISATEUR INACTIF</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
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
                    @if (session()->has('message'))
                        <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                        aria-selected="true" role="tab">Aperçu</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                        aria-selected="false" role="tab" tabindex="-1">Editer l'utilisateur</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade profile-overview active show" id="profile-overview"
                                    role="tabpanel">
                                    <h5 class="card-title">A propos</h5>
                                    <p class="small fst-italic">{!! $user->description !!}</p>

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
                                        <div class="col-lg-3 col-md-4 label ">Numéro D'identité</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->id_number }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nationalité</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->nationality }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Genre</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->genre }}</div>
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
                                        <div class="col-lg-3 col-md-4 label">Date de Naiss.</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->dob }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->addresse }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Pays</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->pays }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Type D'employé</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->type_employé }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Role</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->role }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Description</div>
                                        <div class="col-lg-9 col-md-8">{!! $user->description !!}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Date Du Debut</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->date_du_debut }}</div>
                                    </div>

                                    @if ($user->file1_name !== null || $user->file1 !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ $user->file1_name }}</div>
                                            <div class="col-lg-9 col-md-8"><a
                                                    href="{{ asset('storage/offres_public/' . $user->file1) }}"
                                                    target="_blank">{{ $user->file1 }}</a></div>
                                        </div>
                                    @endif

                                    @if ($user->file2_name !== null || $user->file2 !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ $user->file2_name }}</div>
                                            <div class="col-lg-9 col-md-8"><a
                                                    href="{{ asset('storage/offres_public/' . $user->file2) }}"
                                                    target="_blank">{{ $user->file2 }}</a></div>
                                        </div>
                                    @endif

                                    @if ($user->file3_name !== null || $user->file3 !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ $user->file3_name }}</div>
                                            <div class="col-lg-9 col-md-8"><a
                                                    href="{{ asset('storage/offres_public/' . $user->file3) }}"
                                                    target="_blank">{{ $user->file3 }}</a></div>
                                        </div>
                                    @endif

                                    @if ($user->file4_name !== null || $user->file4 !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ $user->file4_name }}</div>
                                            <div class="col-lg-9 col-md-8"><a
                                                    href="{{ asset('storage/offres_public/' . $user->file4) }}"
                                                    target="_blank">{{ $user->file4 }}</a></div>
                                        </div>
                                    @endif

                                    @if ($user->file5_name !== null || $user->file5 !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ $user->file5_name }}</div>
                                            <div class="col-lg-9 col-md-8"><a
                                                    href="{{ asset('storage/offres_public/' . $user->file5) }}"
                                                    target="_blank">{{ $user->file5 }}</a></div>
                                        </div>
                                    @endif

                                    @if ($user->file6_name !== null || $user->file6 !== null)
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ $user->file6_name }}</div>
                                            <div class="col-lg-9 col-md-8"><a
                                                    href="{{ asset('storage/offres_public/' . $user->file6) }}"
                                                    target="_blank">{{ $user->file6 }}</a></div>
                                        </div>
                                    @endif

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo de
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="{{ asset('storage/photos_profile/' . $user->profile_picture) }}"
                                                alt="Profile">
                                            <div class="pl-2">
                                                @if ($user->profile_picture !== 'user.png')
                                                    <a href="{{ route('supprimer_photo', $user->id) }}"
                                                        class="btn btn-sm text-danger"
                                                        title="Surpimer photo de profile"><i class="bi bi-trash"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('users.update', $user->id) }}"
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

                                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                                        <div class="row mb-3">
                                            <label for="matricule"
                                                class="col-md-4 col-lg-3 col-form-label">Matricule</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="matricule" type="text"
                                                    class="form-control @error('matricule') is-invalid @enderror"
                                                    id="matricule" value={{ $user->matricule }} required>
                                                @error('matricule')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="id_number" class="col-md-4 col-lg-3 col-form-label">Numéro
                                                d'idendité</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="id_number" type="text"
                                                    class="form-control @error('id_number') is-invalid @enderror"
                                                    id="id_number" value={{ $user->id_number }} required>
                                                @error('id_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nationality"
                                                class="col-md-4 col-lg-3 col-form-label">Nationalité</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nationality" type="text"
                                                    class="form-control @error('nationality') is-invalid @enderror"
                                                    id="nationality" value={{ $user->nationality }} required>
                                                @error('nationality')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Genre</label>
                                            <div class="col-sm-9">

                                                <select class="form-select" name="genre">
                                                    <option value="Masculin"
                                                        {{ $user->genre == 'Masculin' ? 'selected' : '' }}>Masculin
                                                    </option>
                                                    <option value="Féminim"
                                                        {{ $user->genre == 'Féminim' ? 'selected' : '' }}>Féminim</option>
                                                </select>
                                                @error('genre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="surname" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="surname" type="text"
                                                    class="form-control @error('surname') is-invalid @enderror"
                                                    id="surname" value={{ $user->surname }} required>
                                                @error('surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" value={{ $user->name }} required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="dob" class="col-md-4 col-lg-3 col-form-label">Date De
                                                Naissance</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="date" name="dob"
                                                    class="form-control @error('dob') is-invalid @enderror"
                                                    value={{ $user->dob }} id="dob" class="form-control"
                                                    required>
                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text"
                                                    class="form-control @error('email') is-invalid @enderror "
                                                    id="email" value={{ $user->email }} required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="addresse"
                                                class="col-md-4 col-lg-3 col-form-label">Addresse</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="addresse" type="text"
                                                    class="form-control @error('addresse') is-invalid @enderror"
                                                    id="addresse" value="{{ $user->addresse }}" required> </input>
                                            </div>
                                            @error('addresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    id="phone" value={{ $user->phone }} required>
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Pays</label>
                                            <div class="col-sm-9">
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
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Type
                                                d'employé</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="type_employé" type="text"
                                                    class="form-control @error('type_employé') is-invalid @enderror"
                                                    id="type_employé" value={{ $user->type_employé }} required>
                                                @error('type_employé')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Service(Optionel)</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select class="form-select" name="service_id">
                                                    @if (count($services) > 0)
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option disabled>Service indisponible! Ajouter un service plus tard
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="role" class="col-md-4 col-lg-3 col-form-label">Role</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="role" type="text"
                                                    class="form-control @error('role') is-invalid @enderror"
                                                    id="fullName" value={{ $user->role }} required>
                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="description" class="col-md-4 col-lg-3 col-form-label">Description
                                                du role</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                                    id="description" required>
                            {{ $user->description }}
                          </textarea>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="date_du_debut" class="col-md-4 col-lg-3 col-form-label">Date Du
                                                Debut</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="date" name="date_du_debut" class="form-control"
                                                    value={{ $user->date_du_debut }} id="date_du_debut"
                                                    class="form-control @error('date_du_debut') is-invalid @enderror"
                                                    required>
                                                @error('date_du_debut')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        @if ($user->file1_name !== null && $user->file1 !== null)
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 1
                                                    (optionel)</label>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col col-sm-4">
                                                            <input
                                                                class="form-control @error('file1_name') is-invalid @enderror"
                                                                name="file1_name" type="text" id=""
                                                                value="{{ $user->file1_name }}"
                                                                placeholder="nom du fichier">
                                                            @error('file1_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col col-sm-8">
                                                            <input
                                                                class="form-control @error('file1') is-invalid @enderror"
                                                                name="file1" type="file" id="">
                                                            @error('file1')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($user->file2_name !== null && $user->file2 !== null)
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 2
                                                    (optionel)</label>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col col-sm-4">
                                                            <input
                                                                class="form-control @error('file2_name') is-invalid @enderror"
                                                                name="file2_name" type="text" id=""
                                                                value="{{ $user->file2_name }}"
                                                                placeholder="nom du fichier">
                                                            @error('file2_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col col-sm-8">
                                                            <input
                                                                class="form-control @error('file2') is-invalid @enderror"
                                                                name="file2" type="file" id="">
                                                            @error('file2')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($user->file3_name !== null && $user->file3 !== null)
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 3
                                                    (optionel)</label>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col col-sm-4">
                                                            <input
                                                                class="form-control @error('file3_name') is-invalid @enderror"
                                                                name="file3_name" type="text" id=""
                                                                value="{{ $user->file3_name }}"
                                                                placeholder="nom du fichier">
                                                            @error('file3_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col col-sm-8">
                                                            <input
                                                                class="form-control @error('file3') is-invalid @enderror"
                                                                name="file3" type="file" id="">
                                                            @error('file3')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($user->file4_name !== null && $user->file4 !== null)
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 4
                                                    (optionel)</label>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col col-sm-4">
                                                            <input
                                                                class="form-control @error('file4_name') is-invalid @enderror"
                                                                name="file4_name" type="text" id=""
                                                                value="{{ $user->file4_name }}"
                                                                placeholder="nom du fichier">
                                                            @error('file4_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col col-sm-8">
                                                            <input
                                                                class="form-control @error('file4') is-invalid @enderror"
                                                                name="file4" type="file" id="">
                                                            @error('file4')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($user->file5_name !== null && $user->file5 !== null)
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 5
                                                    (optionel)</label>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col col-sm-4">
                                                            <input
                                                                class="form-control @error('file5_name') is-invalid @enderror"
                                                                name="file5_name" type="text" id=""
                                                                value="{{ $user->file5_name }}"
                                                                placeholder="nom du fichier">
                                                            @error('file5_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col col-sm-8">
                                                            <input
                                                                class="form-control @error('file5') is-invalid @enderror"
                                                                name="file5" type="file" id="">
                                                            @error('file5')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        @if ($user->file6_name !== null && $user->file6 !== null)
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-4 col-form-label">Fichier 6
                                                    (optionel)</label>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col col-sm-4">
                                                            <input
                                                                class="form-control @error('file6_name') is-invalid @enderror"
                                                                name="file6_name" type="text" id=""
                                                                value="{{ $user->file6_name }}"
                                                                placeholder="nom du fichier">
                                                            @error('file6_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col col-sm-8">
                                                            <input
                                                                class="form-control @error('file6') is-invalid @enderror"
                                                                name="file6" type="file" id="">
                                                            @error('file6')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-primary col col-sm-12">Sauvegarder</button>
                                        </div>
                                    </form>

                                    <hr>
                                    <h4>Les Roles de l'utilisateur</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($user->roles)
                                                @foreach ($user->roles as $user_role)
                                                    <tr>
                                                        <th scope="row">{{ $user_role->created_at->diffForHumans() }}
                                                        </th>
                                                        <td>{{ $user_role->name }}</td>
                                                        <td>
                                                            {{-- <a href="{{route("users.roles.remove", [$user->id, $user_role->id])}}" class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a> --}}

                                                            <form method="POST"
                                                                action="{{ route('users.roles.remove', [$user->id, $user_role->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    onclick="return confirm('Etes-vous sûr de vouloir effectuer cette action ?');"
                                                                    class="btn btn-transparent"><i
                                                                        class="bi bi-trash text-danger"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>


                                    <div class="card">
                                        <div class="card-body mt-3">
                                            <form action="{{ route('users.roles', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label class="col-sm-4 col-form-label">Role</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select @error('role2') is-invalid @enderror"
                                                            name="role2">
                                                            @foreach ($roles as $role)
                                                                @if (!$user->hasRole($role))
                                                                    <option value="{{ $role->name }}">
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('role2')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-4 col-form-label">Assigner</label>
                                                    <div class="col-sm-8">
                                                        <button class="btn btn-primary">Assigner</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <h4>Les Permissions de l'utilisateur</h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Permission</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($user->permissions)
                                                @foreach ($user->permissions as $user_permission)
                                                    <tr>
                                                        <th scope="row">
                                                            #</th>
                                                        <td>{{ $user_permission->name }}</td>
                                                        <td>
                                                            <form method="POST"
                                                                action="{{ route('users.permissions.remove', [$user->id, $user_permission->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    onclick="return confirm('Etes-vous sûr de vouloir effectuer cette action ?');"
                                                                    class="btn btn-sm btn-warning">Revoquer</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="card">
                                        <div class="card-body mt-3">
                                            <form action="{{ route('users.permissions', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label class="col-sm-4 col-form-label">Permissions</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-select" name="permission">
                                                            @foreach ($permissions as $permission)
                                                                @if (!$user->hasPermissionTo($permission))
                                                                    <option value="{{ $permission->name }}">
                                                                        {{ $permission->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-4 col-form-label">Assigner</label>
                                                    <div class="col-sm-8">
                                                        <button class="btn btn-primary">Assigner</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    </table>
                                    @can('activater desactiver utilisateur')
                                        <div class="card">
                                            <div class="card-body mt-3">
                                                <form action="{{ route('activer_desactiver_utilisateur', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                                    <div class="row mb-3">
                                                        <label
                                                            class="col-sm-8 col-form-label">{{ $user->status == 1 ? 'Désactiver' : 'Activer' }}
                                                            cet utilisateur</label>
                                                        <div class="col-sm-4">
                                                            <select class="form-select" name="status">
                                                                @if ($user->status == 1)
                                                                    <option value="0">Désactiver</option>
                                                                @else
                                                                    <option value="1">Activer</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-sm-8 col-form-label">Action</label>
                                                        <div class="col-sm-4">
                                                            <button
                                                                class="btn {{ $user->status == 1 ? 'btn-danger' : 'btn-primary' }}"
                                                                onClick="confirm('Etes-vous sûr de cette action ?')">{{ $user->status == 1 ? 'Désactiver' : 'Activer' }}</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    @endcan

                                    @can('réinitialiser mot de passe')
                                        <div class="card">
                                            <div class="card-body mt-3">
                                                <form action="{{ route('reset_password', $user->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-8 col-form-label">Réinitialiser mot de passe à
                                                            <strong> Banki2022</strong></label>
                                                        <div class="col-sm-4">
                                                            <button class="btn btn-danger"
                                                                onClick="confirm('Etes-vous sûr de cette action ?')">Actionner</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endcan

                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
