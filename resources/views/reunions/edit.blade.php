@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Reunions</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            @if (session()->has('message'))
                <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Editer une reunion</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('reunions.update', $reunion->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Titre</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="titre" value="{{ $reunion->titre }}"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Contenu</label>
                                    <div class="col-sm-10">
                                        <textarea id="description" class="form-control" name="contenu" style="height: 100px" required>
                       {!! $reunion->contenu !!}
                      </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Fichier (Optionel)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('fichier') is-invalid @enderror" name="fichier" type="file" id="formFile">
                                        @error('fichier')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Sauvegarder</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="card p-1">
                        <br>
                        <h5>Donner aux utilisateurs accès à ce rapport</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Utilisateur</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reunion->users as $user)
                                    <tr>
                                        <th scope="row">
                                            #</th>
                                        <td>{{ $user->name }} {{$user->surname}}</td>
                                        <td>
                                          <a class="btn btn-sm btn-warning" href="{{ route('detach_reunion_user', [$user->id, $reunion->id]) }}">Revoquer l'accès</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card">
                            <div class="card-body mt-3">
                                <form action="{{ route('attach_reunion_user') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="reunion_id" value="{{ $reunion->id }}">
                                    <div class="row mb-3">
                                        <div class="col-sm-8">
                                            <select class="form-select" name="user_id">
                                                @foreach ($users as $user)
                                                    @if (!$user->reunions($reunion)->exists())
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }} {{ $user->surname }} ({{ $user->role }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-8">
                                          <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" name="public" id="public">
                                            <label class="form-check-label" for="public">Public (Cocher pour rendre le rapport public)</label>
                                         </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label">Action</label>
                                        <div class="col-sm-8">
                                            <button class="btn btn-primary">Soumettre</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
