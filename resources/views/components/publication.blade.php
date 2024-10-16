<div class="bg-white border border-gray-300 p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                            
    <!-- Profile Section (User Avatar and Name like Facebook) -->
    @if($publication->profile)
        <div class="flex items-center mb-4">
            <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('storage/' . $publication->profile->image) }}" alt="{{ $publication->profile->name }}">
            <div class="ml-3">
                <h4 class="text-sm font-bold text-gray-900">{{ $publication->profile->name }}</h4>
                <p class="text-xs text-gray-500">{{ $publication->created_at->diffForHumans() }}</p>
            </div>
        </div>
    @else
        <div class="flex items-center mb-4">
            <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('storage/profile/default-profile.jpg') }}" alt="Unknown User">
            <div class="ml-3">
                <h4 class="text-sm font-bold text-gray-900">Unknown User</h4>
                <p class="text-xs text-gray-500">{{ $publication->created_at->diffForHumans() }}</p>
            </div>
        </div>
    @endif

    <h3 class="text-lg font-bold text-gray-900">{{ $publication->titre }}</h3>
    <p class="mt-2 text-gray-700">{{ \Illuminate\Support\Str::limit($publication->body, 150) }}</p>

    <!-- Show image if it exists -->
    @if($publication->image)
        <div class="mt-4">
            <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->titre }}" class="w-full h-48 object-cover rounded-lg">
        </div>
    @endif

    <!-- Only show edit and delete buttons if the authenticated user is the owner -->
    @auth
        <!-- Compare authenticated user's id with the user_id of the publication's profile -->
        @if (auth()->user()->id === $publication->profile_id)
            <!-- Interaction Buttons (Edit and Delete) -->
            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('publications.show', $publication->id) }}" class="text-blue-600 hover:underline">Read More</a>
            
                <div class="flex space-x-4">
                    <!-- Edit button with tooltip -->
                    <div data-tooltip-target="tooltip-edit">
                        <a href="{{ route('publications.edit', $publication->id) }}" class="text-yellow-500 hover:text-yellow-600 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L3 14.172V17h2.828l11.586-11.586a2 2 0 000-2.828zM4 16v-1.586l10.586-10.586 1.586 1.586L5.586 16H4z" />
                            </svg>
                        </a>
                    </div>
                    <div id="tooltip-edit" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300">
                        Edit
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
            
                    <!-- Delete button with tooltip -->
                    <div data-tooltip-target="tooltip-delete">
                        <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this publication?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7 4H4a1 1 0 000 2h12a1 1 0 100-2h-3l-1.106-1.447A1 1 0 0011 2H9zM5 7a1 1 0 011-1h8a1 1 0 011 1v8a2 2 0 11-4 0H9a2 2 0 11-4 0V7zm2 8a1 1 0 002 0H7z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div id="tooltip-delete" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300">
                        Delete
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>
            
        @endif
    @endauth

</div>