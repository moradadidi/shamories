<!-- resources/views/profil.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />

    <title>social network - {{ $title }}</title>
</head>
<script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
<body class="flex flex-col min-h-screen">
    <div class="flex-grow bg-gray-100 mx-4">
        @include('partials.nav')

        <main class="py-4">

<div class="alert w-1/2">
            @if (session('success'))
                <x-alert color="green">
                    {{ session('success') }}

                </x-alert>
            @endif
        </div>

            {{ $slot }}
        </main>
    </div>

    <footer class=" text-white py-4">
        @include('partials.footer')
    </footer>
</body>

</html>
