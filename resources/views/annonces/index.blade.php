@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">
        @if ($annonces->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Les annonces sont vides
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Annonces</h1>
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
                    @can('editer annonces')
                        <a href="{{ route('annonces.create') }}" class="btn btn-primary mb-3"><i
                                class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>
                    @endcan

                    @foreach ($annonces as $annonce)
                        <div class="card">
                            <div class="card-header text-primary pb-0">
                                <h4>{{ $annonce->titre }}</h3>
                            </div>
                            <div class="card-body">
                                {!! $annonce->contenu !!}
                                @if ($annonce->fichier !== null)
                                    cliquer
                                    <a href="{{ route('telecharger_fichier_annonce', $annonce->fichier) }}">ici</a> !
                                @endif

                                <br>
                                <small>{{ $annonce->created_at->diffForHumans() }}</small>
                                @can('editer annonces')
                                    <a href="{{ route('annonces.edit', $annonce->id) }}" class="btn btn-sm"
                                        title="Editer cette annonce"><i class="bi bi-pencil-square"></i></a>

                                    <form method="POST" action="{{ route('annonces.destroy', $annonce->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-transparent"><i
                                                class="bi bi-trash text-danger"></i></button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($annonces->hasPages())
                    <nav class="Page navigation example">
                        <div class="pagination">
                            {{ $annonces->links() }}
                        </div>
                    </nav>
                @endif
            </div>
        </section>
    </main>
@endsection
