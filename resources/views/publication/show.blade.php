<x-master title="My Publications">
    <section class="bg-gray-100 dark:bg-gray-900">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            
            @if ($publications->isEmpty())
                <p class="text-center text-gray-500 dark:text-gray-400">This profile has no publications yet.</p>
            @else
                @foreach ($publications as $publication)
                    <div class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                        
                        <!-- Profile Header with Image and Date -->
                        <div class="flex items-center mb-4">
                            <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('storage/' . $profile->image) }}" alt="{{ $profile->name }}">
                            <div class="ml-3">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $profile->name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($publication->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $publication->titre }}</h3>
                        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ \Illuminate\Support\Str::limit($publication->body, 150) }}</p>

                        <!-- Show image if it exists -->
                        @if($publication->image)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->titre }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- Actions -->
                        @auth
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('publications.show', $publication->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Read More</a>
                                
                                <div class="flex space-x-4">
                                    <!-- Edit button with tooltip -->
                                    <a href="{{ route('publications.edit', $publication->id) }}" class="relative text-yellow-500 dark:text-yellow-400 hover:text-yellow-600 transition-colors duration-200" aria-label="Edit">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L3 14.172V17h2.828l11.586-11.586a2 2 0 000-2.828zM4 16v-1.586l10.586-10.586 1.586 1.586L5.586 16H4z" />
                                        </svg>
                                        <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded-lg py-1 px-2 opacity-0 hover:opacity-100 transition-opacity">Edit</span>
                                    </a>
                                
                                    <!-- Delete button with tooltip -->
                                    <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this publication?');" class="relative">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 dark:text-red-400 hover:text-red-600 transition-colors duration-200" aria-label="Delete">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7 4H4a1 1 0 000 2h12a1 1 0 100-2h-3l-1.106-1.447A1 1 0 0011 2H9zM5 7a1 1 0 011-1h8a1 1 0 011 1v8a2 2 0 11-4 0H9a2 2 0 11-4 0V7zm2 8a1 1 0 002 0H7z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded-lg py-1 px-2 opacity-0 hover:opacity-100 transition-opacity">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                @endforeach
            @endif
        </div>
    </section>
</x-master>
