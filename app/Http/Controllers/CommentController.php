<?php
namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request; // Include this for Request handling
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        \Log::info('Comment Store Request:', $request->all());
        
        // Validate the comment input
        $request->validate([
            'content' => 'required|string|max:1000',
            'movie_id' => 'required|exists:movies,id',
        ]);

        // Create and save the comment
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'content' => $request->content,
        ]);
        
        \Log::info('Comment Created:', $comment->toArray());

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
