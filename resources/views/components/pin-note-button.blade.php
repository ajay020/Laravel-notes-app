@props(['note'])

<form
    action="{{ route('notes.pin', $note) }}"
    method="POST"
>
    @csrf
    @method('PATCH')

    <button
        type="submit"
        class="bg-gray-500 text-white px-3 py-1 rounded-lg"
    >
        {{ $note->is_pinned ? 'Unpin' : 'Pin' }}
    </button>

</form>