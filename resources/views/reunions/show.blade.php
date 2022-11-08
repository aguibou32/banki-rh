@extends('layouts.app')
@section('content')
    @include('utils.to_french')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Note de reunion</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
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
                        <div class="card-header">Note de réunion du
                            {{ $reunion->created_at->formatLocalized('%d %B %Y') }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $reunion->title }}</h5>
                            <p>
                                {!! $reunion->contenu !!}
                            </p>
                        </div>
                        <div class="card-footer">
                            @if ($reunion->fichier !== null)
                                Télécharger fichier
                                <a href="{{ route('telecharger_fichier_reunion', $reunion->fichier) }}">ici</a>
                                !
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
