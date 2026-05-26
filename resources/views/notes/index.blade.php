<x-app-layout>
    <div class="mx-auto p-4  max-w-2xl">

        <form action="/notes" method="GET" class="mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search notes..."
                class="w-full border rounded-lg px-4 py-2 dark:bg-gray-900 text-white">
        </form>
        
        @if (request('tag'))
            <div class="mb-4 text-white">

                Filtering by tag:
                <strong>{{ request('tag') }}</strong>

                <a href="/notes" class="text-red-500 ml-2">
                    Clear
                </a>

            </div>
        @endif

        @if ($notes->count())
            @foreach ($notes as $note)
                <div class="border max-w-2xl mx-auto rounded-lg p-4 my-4 text-white">
                    <a href="/notes/{{ $note->id }}" class="text-blue-500 hover:underline">
                        <h2 class="text-xl font-bold mb-2">
                            {{ $note->title }}
                        </h2>
                    </a>

                    <p>
                        {{ $note->body }}
                    </p>

                    <div class="mt-4 space-x-4">
                        <a href="/notes/{{ $note->id }}/edit" class="bg-gray-700 text-white px-3 py-1 rounded-lg">
                            Edit
                        </a>

                        <form action="/notes/{{ $note->id }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="mt-6 p-4">
                {{ $notes->links() }}
            </div>
        @else
            <p class="text-white">No notes found.</p>
        @endif
    </div>

</x-app-layout>
