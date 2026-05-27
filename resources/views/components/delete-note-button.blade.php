@props(['note'])

@can('delete', $note)

    <form
        action="/notes/{{ $note->id }}"
        method="POST"
        class="inline-block"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="bg-red-500 text-white px-3 py-1 rounded-lg"
        >
            Delete
        </button>

    </form>

@endcan