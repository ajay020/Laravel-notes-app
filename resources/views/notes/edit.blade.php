<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-white">
            Update Note
        </h1>

        <form action="/notes/{{ $note->id }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block mb-2 font-medium">
                    Title
                </label>

                <input type="text" name="title" id="title" value="{{ old('title', $note->title) }}"
                    placeholder="Title" class="w-full border text-white rounded-lg px-4 py-2 dark:bg-gray-900">

                @error('title')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="tags">
                    Tags
                </label>

                <input value="{{ old('tags', $note->tags->pluck('name')->join(', ')) }}" type="text" name="tags"
                    id="tags" placeholder="php, laravel, backend"
                    class="w-full border rounded-lg px-4 py-2 dark:bg-gray-900 text-white">
            </div>

            <div>
                <label for="body" class="block mb-2 font-medium">
                    Body
                </label>

                <textarea name="body" id="body" rows="8" placeholder="Body"
                    class="w-full border text-white rounded-lg px-4 py-2 dark:bg-gray-900">{{ old('body', $note->body) }}</textarea>

                @error('body')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            @can('update', $note)
                <button type="submit" class="bg-black text-white px-5 py-2 rounded-lg">
                    Update Note
                </button>
            @endcan
           
        </form>
    </div>
</x-app-layout>
