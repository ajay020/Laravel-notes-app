<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $tag = request('tag');

        $notes = Auth::user()
            ->notes()
            ->when($search, function ($query, $search) {

                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            })
            ->when($tag, function ($query, $tag) {
                
                $query->whereHas('tags', function ($query) use ($tag) {

                    $query->where('name', $tag);
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('notes.index', [
            'notes' => $notes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'tags' => ['nullable'],
        ]);

        $note = Auth::user()->notes()->create($validated);

        if ($request->filled('tags')) {

            $tagNames = explode(',', $request->tags);

            $tagIds = [];

            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate([
                    'name' => trim($tagName),
                ]);

                $tagIds[] = $tag->id;
            }

            $note->tags()->attach($tagIds);
        }

        return redirect('/notes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('notes.show', [
            'note' => $note,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('notes.edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'tags' => ['nullable'],
        ]);

        $note->update([
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        $tagIds = [];

        if ($request->filled('tags')) {

            $tagNames = explode(',', $request->tags);

            foreach ($tagNames as $tagName) {

                $tag = Tag::firstOrCreate([
                    'name' => trim($tagName),
                ]);

                $tagIds[] = $tag->id;
            }
        }

        $note->tags()->sync($tagIds);

        return redirect('/notes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        // use destroy with the model id to ensure the deletion receives the expected argument
        Note::destroy($note->id);

        return redirect('/notes');
    }
}
