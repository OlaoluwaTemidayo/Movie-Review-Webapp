@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Movies List</h1>
    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Add Movie</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($movies as $movie)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p class="card-text"><strong>Description:</strong>{{ $movie->description }}</p>
                        <!--<p class="card-text"><strong>Description:</strong> {{ $movie->slug }}</p> -->
                        <p class="card-text"><strong>Year:</strong> {{ $movie->year }}</p> <!-- Added year field -->
                        <a href="{{ route('movies.show', $movie->slug) }}" class="btn btn-info">View</a>
                        

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">No movies found.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
