<x-app-layout>

    <div class="mx-auto p-4 max-w-2xl">

        <form action="/notes" method="GET" class="mb-6">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search notes..."
                class="w-full border rounded-lg px-4 py-2 dark:bg-gray-900 text-white"
            >

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