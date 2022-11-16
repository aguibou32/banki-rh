@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employés</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message'))
                        <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Table des employés <span>|
                                    <a href="{{ route('users.create') }}" class="btn btn-primary"><i
                                            class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                                </span></h5>
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-top">
                                </div>
                                <div class="">
                                    <table id="myTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>Matricule</th>
                                                <th>Nom et Prénom</th>
                                                <th>Dernière connexion</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Pays</th>
                                                <th>A commencé le</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->matricule }}</td>
                                                    <td>
                                                        {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                                    </td>
                                                    <td>{{ $user->name }} {{ $user->surname }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>{{ $user->pays }}</td>
                                                    <td>{{ Carbon\Carbon::parse($user->date_du_debut)->formatLocalized('%d %B %Y') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('users.show', $user->id) }}" type="button"
                                                            class="btn btn-transparent"><i class="bi bi-eye"></i></a>
                                                        <form method="POST"
                                                            action="{{ route('users.destroy', $user->id) }}">
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
                                        </tbody>
                                    </table>
                                    {{-- @if ($users->hasPages())
                                        <nav class="Page navigation example">
                                            <div class="pagination">
                                                {{ $users->links() }}
                                            </div>
                                        </nav>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('utils.data_table')
@endsection
