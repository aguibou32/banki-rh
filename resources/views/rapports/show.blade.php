@extends('layouts.app')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Service</h1>
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
                        <div class="card-header">Rapport du {{ date('d F, Y', strtotime($rapport->created_at)) }} | par
                            {{ $rapport->user->name }} {{ $rapport->user->surname }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $rapport->title }}</h5>
                            <p>
                                {!! $rapport->content !!}
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('generateRepportPdf', $rapport->id) }}" class="btn btn-primary">Convertir en
                                pdf</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
