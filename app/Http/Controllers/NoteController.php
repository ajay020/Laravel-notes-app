<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Auth::user()
            ->notes()
            ->latest()
            ->get();

        // dd($notes);

        return view('notes.index', [
            'notes' => $notes
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
            'body' => ['required']
        ]);

        Auth::user()->notes()->create($validated);
        // auth()->user()->notes()->create($validated);

        return redirect('/notes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('notes.show', [
            'note' => $note
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('notes.edit', [
            'note' => $note
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
            'body' => ['required']
        ]);

        $note->update($validated);

        return redirect('/notes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        $note->delete($note->id);

        return redirect('/notes');
    }
}
