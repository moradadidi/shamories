<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: false }" x-bind:class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Component -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- Flowbite CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>Social Network - {{ $title }}</title>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100" x-data="{ isDark: false }">
    <div class="flex-grow mx-4">
        <button @click="darkMode = !darkMode" class="p-2 m-4 text-lg bg-gray-200 dark:bg-gray-800 rounded-lg">
            Toggle Dark Mode
        </button>
        
        @include('partials.nav')

        <main class="mt-24 z-50">
            {{-- Alert notifications using Tailwind and Toastr --}}
            {{ $slot }}
        </main>
    </div>

    {{-- <footer class="text-white py-4">
        @include('partials.footer')
    </footer> --}}

    @if(session('success') || session('error') || session('warning') || session('info'))
    <script>
        $(document).ready(function() {
            // Toastr configuration
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Show messages
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if(session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
            @if(session('info'))
                toastr.info("{{ session('info') }}");
            @endif
        });
    </script>
    @endif
</body>
</html>
