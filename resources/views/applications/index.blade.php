@extends('layouts.app')
@section('content')
<main id="main" class="main">

  @if ($offre_applications->isEmpty())
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      Ce repertoire est encore vide !
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="pagetitle">
    <h1>Applications</h1>
    <nav>
      <ol class="breadcrumb">
        {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
      </ol>
    </nav>
  </div><!-- End Page Title -->

<section class="section">
<div class="row">
  <div class="col-lg-12">
    @if(session()->has('message'))
      <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-body">
        <h5 class="card-title">Liste des application</h5>
        <!-- Table with hoverable rows -->
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th scope="col">Prénom</th>
              <th scope="col">Date de naissace</th>
              <th scope="col">Email</th>
              <th scope="col">Téléphone</th>
              <th scope="col">Address</th>
              <th scope="col"> Actions </th>
            </tr>
          </thead>
          <tbody>
              @foreach ($offre_applications as $op)
              <tr>
                <th scope="row">1</th>
                <td>{{ $op->nom }}</td>
                <td>{{ $op->prénom }}</td>
                <td>{{ $op->date_de_naissance }}</td>
                <td>{{ $op->email }}</td>
                <td>{{ $op->phone }}</td>
                <td>{{ $op->addresse }}</td>
                <td>
                <a href="{{ route("applications.show", $op->id) }}" class="btn btn-transparent"><i class="bi bi-eye"></i></a>
                  <button type="button" class="btn btn-transparent"><i class="bi bi-trash text-danger"></i></button>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
        <!-- End Table with hoverable rows -->

      </div>
    </div>
  </div>
</div>
</section>
</main>


  @endsection