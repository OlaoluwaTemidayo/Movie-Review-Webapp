@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Movie</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $movie->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" required>{{ $movie->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" class="form-control" value="{{ $movie->slug }}" required>
        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" name="year" class="form-control" value="{{ $movie->year }}" min="1900" max="2100" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Movie</button>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
