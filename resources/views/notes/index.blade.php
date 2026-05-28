<x-app-layout>

    <div class="mx-auto p-4 max-w-2xl">

       <form
        x-data="{ search: '{{ request('search') }}' }"
        action="/notes"
        method="GET"
        class="flex items-center gap-2 mb-6 mt-4"
        >
            <input
                type="text"
                name="search"
                x-model="search"
                placeholder="Search notes..."
                class="w-full border rounded-lg px-4 py-2 dark:bg-gray-900 text-white"
            >

            <button
                type="submit"
                :disabled="!search.trim()"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Search
            </button>

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

        @forelse ($notes as $note)

            <x-note-card :note="$note" />

        @empty

            <p class="text-white text-center mt-12">
                Create your first note to get started!
            </p>

        @endforelse

        <div class="mt-6 p-4">
            {{ $notes->links() }}
        </div>

    </div>

</x-app-layout>