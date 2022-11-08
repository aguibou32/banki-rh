@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        {{-- @if ($départements->isEmpty())
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      Liste des roles est vide.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif --}}

        <div class="pagetitle">
            <h1>Permissions</h1>
            <nav>
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
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

                    <div class="card recent-sales overflow-auto">
                        <div class="card-header">
                            {{-- <a href="{{ route("permissions.create") }}" class="btn btn-primary"><i class="bi bi-plus-circle" >{{ " " }}</i>Ajouter</a> --}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Liste des permissions</h5>
                            <!-- Table with hoverable rows -->
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        {{-- <th scope="col"> Actions </th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <th scope="row">{{ $permission->id }}</th>
                                            <td>{{ $permission->name }}</td>
                                            {{-- <td>
                <a href="{{ route("permissions.edit", $permission->id) }}" class="btn btn-transparent"><i class="bi bi-pencil-square"></i></a>
                <form method="POST" action="{{ route("permissions.destroy", $permission->id) }}">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="btn btn-transparent"><i class="bi bi-trash text-danger"></i></button>
                </form>
                </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- @if ($permissions->hasPages())
                                <nav class="Page navigation example">
                                    <div class="pagination">
                                        {{ $permissions->links() }}
                                    </div>
                                </nav>
                            @endif --}}
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('utils.data_table')
@endsection
