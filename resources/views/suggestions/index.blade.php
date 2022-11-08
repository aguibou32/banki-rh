@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">
        @if ($suggestions->isEmpty())
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                La boite à suggestion est vide
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="pagetitle">
            <h1>Suggestions</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message'))
                        <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <a href="{{ route('suggestions.create') }}" class="btn btn-primary mb-3"><i
                            class="bi bi-plus-circle">{{ ' ' }}</i>Ajouter</a>

                    @foreach ($suggestions as $suggestion)
                        <div class="card">
                            <div class="card-header text-primary">
                                <h5>{{ $suggestion->title }}</h5>
                            </div>
                            <div class="card-body">
                                {{ $suggestion->title }}
                                {{ $suggestion->details }}
                            </div>
                            <div class="card-footer">
                                <small>{{ $suggestion->created_at->diffForHumans() }}</small>,
                                @if ($suggestion->user)
                                    <small>par {{ $suggestion->user->name }} {{ $suggestion->user->surname }}</small>
                                @endif

                                <br>
                                @if (auth()->user()->id == $suggestion->user_id)
                                    <a href="{{ route('suggestions.edit', $suggestion->id) }}"
                                        class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a>
                                @endif

                                @if (auth()->user()->id == $suggestion->user_id ||
                                    auth()->user()->can('editer boite suggestions'))
                                    <form method="POST" action="{{ route('suggestions.destroy', $suggestion->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-transparent"><i
                                                class="bi bi-trash text-danger"
                                                onclick="return confirm('Etes-vous sûr? Cette action est irreversible !');"></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($suggestions->hasPages())
                    <nav class="Page navigation example">
                        <div class="pagination">
                            {{ $suggestions->links() }}
                        </div>
                    </nav>
                @endif
            </div>
        </section>
    </main>
@endsection
