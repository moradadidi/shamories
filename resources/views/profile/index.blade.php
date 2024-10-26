<x-master title="Profile">

    <!-- Search Bar Section -->
    <div class="bg-blue-50 py-8">
        <div class="container mx-auto">
            <form class="flex items-center justify-center max-w-lg mx-auto mb-4" action="{{ route('profiles.index') }}" method="GET">   
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" 
                           class="bg-white border border-gray-300 text-gray-900 text-sm rounded-full shadow-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 py-2.5" 
                           placeholder="Search profile name..." 
                           name="search" value="{{ request('search') }}" />
                </div>
                <button type="submit" class="ms-3 p-2.5 text-sm font-medium text-white bg-blue-600 rounded-full shadow-md hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </form>

            <h1 class="text-5xl font-extrabold text-center text-blue-600">Welcome to the Profile Page</h1>
            <p class="text-xl text-center text-gray-700 mt-4">Find and connect with other users.</p>
        </div>
    </div>

    <!-- Profile Cards Section -->
    <div class="container mx-auto py-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($profiles as $profile)
            <x-card :profile="$profile" />
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="container mx-auto py-6 flex justify-center">
        {{ $profiles->links() }}
    </div>

</x-master>
