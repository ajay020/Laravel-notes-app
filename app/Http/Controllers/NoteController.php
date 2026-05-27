<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\Tag;
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
    public function store(StoreNoteRequest $request)
    {
        try {
            $validated = $request->validated();

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

            return redirect('/notes')
                ->with('success', 'Note created successfully!');
        } catch (\Exception $e) {
            return redirect('/notes')
                ->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // Authorization check using the NotePolicy`s view method
        $this->authorize('view', $note);

        return view('notes.show', [
            'note' => $note,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        // Authorization check using the NotePolicy`s update method
        $this->authorize('update', $note);

        return view('notes.edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        try {

            $this->authorize('update', $note);

            $validated = $request->validated();

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

            return redirect('/notes')
                ->with('success', 'Note updated successfully!');

        } catch (\Exception $e) {
            return redirect('/notes')
                ->with('error', 'Something went wrong while updating the note. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        try {
            $note->tags()->detach();
            Note::destroy($note->id);

            return redirect('/notes')
                ->with('success', 'Note deleted successfully!');
        } catch (\Exception $e) {
            return redirect('/notes')
                ->with('error', 'Something went wrong while deleting the note. Please try again.');
        }
    }
}
