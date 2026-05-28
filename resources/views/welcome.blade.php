<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Notes App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center">

    <div class="text-center max-w-2xl px-6">

        <h1 class="text-5xl font-bold mb-6">
            Notes App
        </h1>

        <p class="text-gray-400 text-lg mb-8">
            Organize your thoughts, ideas, and daily notes in one place.
        </p>

        <div class="flex items-center justify-center gap-4">

            @auth

                <a
                    href="{{ route('notes.index') }}"
                    class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg"
                >
                    Go to Notes
                </a>

            @else

                <a
                    href="{{ route('login') }}"
                    class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg"
                >
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-lg"
                >
                    Register
                </a>

            @endauth

        </div>

    </div>

</body>

</html>