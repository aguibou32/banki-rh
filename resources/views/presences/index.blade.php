@extends('layouts.app')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Présences</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            @if (session()->has('message'))
                <div class="alert alert-primary bg-tranparent border-0 alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Table des présences</h5>
                        <div class="col">
                            <form method="POST" action="{{ 'presences_import' }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="presences_file"
                                    class="@error('presences_file') is-invalid @enderror">
                                @error('presences_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn-primary ri-upload-2-fill"></button>
                            </form>
                        </div>

                        <br>
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-container">
                                <table id="myTable" class="table table-borderless datatable dataTable-table">
                                    <thead>
                                        <tr>
                                            <th scope="col" data-sortable="" style="">#</th>
                                            <th scope="col" data-sortable="" style=""><a href="#"
                                                    class="dataTable-sorter">Emp. No</a></th>
                                            <th scope="col" data-sortable="" style=""><a href="#"
                                                    class="dataTable-sorter">Ac. No</a></th>
                                            <th scope="col" data-sortable="" style=""><a href="#"
                                                    class="dataTable-sorter">No</a></th>
                                            <th scope="col" data-sortable="" style=""><a href="#"
                                                    class="dataTable-sorter">Name</a></th>
                                            <th scope="col" data-sortable="" style=""><a href="#"
                                                    class="dataTable-sorter">Auto Assign</a></th>
                                            <th scope="col" data-sortable="" style=""><a href="#"
                                                    class="dataTable-sorter">Date</a></th>
                                            <th scope="col" data-sortable="" style=""><a href="#"
                                                    class="dataTable-sorter">Timetable</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presences as $presence)
                                            <tr>
                                                <th scope="row">{{ $presence->id }}</th>
                                                <td>{{ $presence->emp_no }}</td>
                                                <td>{{ $presence->ac_no }}</td>
                                                <td>{{ $presence->no }}</td>
                                                <td>{{ $presence->name }}</td>
                                                <td>{{ $presence->auto_assign }}</td>
                                                <td>{{ $presence->date }}</td>
                                                <td>{{ $presence->timetable }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('utils.data_table')
@endsection
