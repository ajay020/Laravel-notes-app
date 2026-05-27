@props(['note'])

<div class="border max-w-2xl mx-auto rounded-lg p-4 my-4 text-white group">

    @if ($note->is_pinned)
        📌
    @endif

    <a href="/notes/{{ $note->id }}" class="text-blue-500 hover:underline">
        <h2 class="text-xl font-bold mb-2">
            {{ $note->title }}
        </h2>
    </a>

    <p>
        {{ $note->body }}
    </p>

    <div class="mt-4 flex space-x-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

        <a
            href="/notes/{{ $note->id }}/edit"
            class="bg-gray-700 text-white px-3 py-1 rounded-lg"
        >
            Edit
        </a>

        <x-delete-note-button :note="$note" />

        <x-pin-note-button :note="$note" />

    </div>
</div>