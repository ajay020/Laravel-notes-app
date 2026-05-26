<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-white">
            {{ $note->title }}
        </h1>

        <p class="text-white">
            {{ $note->body }}
        </p>

        <div class="space-x-2 mt-4">
            @foreach ($note->tags as $tag)
                <a href="/notes?tag={{ $tag->name }}" class="bg-gray-200 px-2 py-1 rounded text-sm">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
