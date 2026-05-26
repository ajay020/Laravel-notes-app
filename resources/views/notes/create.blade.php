<x-app-layout>
    <div class="max-w-2xl mx-auto py-4 mt-10">
        <h1 class="text-3xl font-bold mb-6 text-white">
            Create Note
        </h1>

        <form action="/notes" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block mb-2 font-medium">
                    Title
                </label>

                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Title"
                    class="w-full border text-white rounded-lg px-4 py-2 dark:bg-gray-900">

                @error('title')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="body" class="block mb-2 font-medium">
                    Body
                </label>

                <textarea name="body" id="body" rows="8" placeholder="Body"
                    class="w-full border text-white rounded-lg px-4 py-2 dark:bg-gray-900">{{ old('body') }}</textarea>

                @error('body')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Tags are optional, but they can help you organize your notes. You can add multiple tags by separating them with commas. --}}
            <div>
                <label for="tags">
                    Tags
                </label>

                <input type="text" name="tags" id="tags" placeholder="php, laravel, backend"
                    class="w-full border rounded-lg px-4 py-2 dark:bg-gray-900 text-white">
            </div>

            <button type="submit" class="bg-black text-white px-5 py-2 rounded-lg">
                Create Note
            </button>
        </form>
    </div>
</x-app-layout>
