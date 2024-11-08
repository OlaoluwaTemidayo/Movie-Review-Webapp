@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Movie</h1>
    <form action="{{ route('movies.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" name="slug" required>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" class="form-control" name="year" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Movie</button>
    </form>
</div>
@endsection