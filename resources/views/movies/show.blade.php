@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $movie->title }}</h1>
    <p><strong>Description:</strong> {{ $movie->description }}</p>
    <p><strong>Year:</strong> {{ $movie->year }}</p>

    <!-- Comments Section -->
    <h2>Comments</h2>

    <!-- Display existing comments -->
    @if($movie->comments->isEmpty())
        <p>No comments yet. Be the first to comment!</p>
    @else
        @foreach($movie->comments as $comment)
            <div class="mb-3">
                <strong>{{ $comment->user->name }}</strong> says:
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach
    @endif

    <!-- Comment form for authenticated users -->
    @auth
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">

            <div class="form-group">
                <label for="content">Leave a comment</label>
                <textarea name="content" id="content" rows="4" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Post Comment</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Log in</a> to leave a comment.</p>
    @endauth

    <!-- Back button -->
    <a href="{{ route('movies.index') }}" class="btn btn-primary mt-3">Back to Movies List</a>
</div>
@endsection
