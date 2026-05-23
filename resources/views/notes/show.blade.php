<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-white">
            {{ $note->title }}
        </h1>

        <p class="text-white">
            {{ $note->body }}
        </p>
    </div>
</x-app-layout>
