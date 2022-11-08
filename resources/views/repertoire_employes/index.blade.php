@extends('layouts.app')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row align-items-top">
                @foreach ($users as $user)
                    <div class="col-lg-4">
                        <!-- Card with an image on top -->
                        <div class="card">
                            <img src="{{ asset('storage/photos_profile/' . $user->profile_picture) }}" class=""
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }} {{ $user->surname }}
                                    @if (Cache::has('user-is-online-' . $user->id))
                                        <span class="text-success">En ligne</span>
                                    @else
                                        <span class="text-secondary">Hors ligne</span>
                                    @endif
                                </h5>
                                <ul class="list-unstyled">
                                    <li>{{ $user->matricule }}</li>
                                    <li>{{ $user->role }}</li>
                                    <li>{{ $user->email }}</li>
                                    <li>{{ $user->phone }}</li>
                                    <li>{!! $user->description !!}</li>
                                </ul>
                            </div>
                        </div><!-- End Card with an image on top -->
                        {{-- @if ($users->hasPages())
                            <nav class="Page navigation example">
                                <div class="pagination">
                                    {{ $users->links() }}
                                </div>
                            </nav>
                        @endif --}}
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
