@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        {{ $attributes->merge(['class' => 'mb-6 bg-green-500 w-1/3 text-white px-4 py-3 rounded']) }}>


        {{ session('success') }}

    </div>
@endif
