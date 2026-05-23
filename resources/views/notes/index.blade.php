<x-app-layout>
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
                <a
                    href="/notes/{{ $note->id }}/edit"
                    class="bg-gray-700 text-white px-3 py-1 rounded-lg"
                >
                    Edit
                </a>

                <form action="/notes/{{ $note->id }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="bg-red-500 text-white px-3 py-1 rounded-lg"
                    >
                        Delete
                    </button>
                </form>
            </div>
        </div>
        
    @endforeach
</x-app-layout>
