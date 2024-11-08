<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    // Display a listing of the movies
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    // Show the form for creating a new movie
    public function create()
    {
        return view('movies.create');
    }

    // Store a newly created movie in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'slug' => 'required|string|unique:movies,slug',
            'year' => 'required|integer|min:1900|max:2100',
        ]);

        // Associate the movie with the authenticated user
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'year' => $request->year,
            'user_id' => Auth::id(), // Store the user ID
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    // Display the specified movie
    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        return view('movies.show', compact('movie'));
    }

    // Show the form for editing the specified movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        // Ensure the user is authenticated and is the owner of the movie
        if (!Auth::check() || Auth::id() !== $movie->user_id) {
            return redirect()->route('movies.index')->with('error', 'You need to be logged in and authorized to edit this movie.');
        }

        return view('movies.edit', compact('movie'));
    }

    // Update the specified movie in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'slug' => 'required|string|unique:movies,slug,' . $id,
            'year' => 'required|integer|min:1900|max:2100',
        ]);

        $movie = Movie::findOrFail($id);

        // Ensure the user is authenticated and is the owner of the movie
        if (!Auth::check() || Auth::id() !== $movie->user_id) {
            return redirect()->route('movies.index')->with('error', 'You need to be logged in and authorized to update this movie.');
        }

        $movie->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'year' => $request->year,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    
}
