@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Are you sure you want to delete the movie "{{ $movie->title }}"?</h1>

    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
