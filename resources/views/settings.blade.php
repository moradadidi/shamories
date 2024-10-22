<x-master title="show_profile">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div role="article" aria-labelledby="profile-title"
            class="w-full sm:w-1/2 lg:w-1/4 mx-auto mt-10 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">

            <!-- Profile Image Section -->
            <div class="h-[250px] sm:h-[300px] w-full relative">
                <img class="w-full h-full object-cover object-center" src="{{ asset('storage/' . $profile->image) }}"
                    alt="Profile image of {{ $profile->name }}">
            </div>

            <!-- User Information Section -->
            <div class="w-full p-6 text-gray-600">

                <!-- Name -->
                <h1 id="profile-title" class="text-2xl font-semibold leading-tight text-gray-900">
                    <a href="#" class="hover:text-blue-600 transition-colors duration-300">
                        {{ $profile->name }}
                    </a>
                </h1>

                <!-- Email -->
                <p class="text-sm text-gray-400 font-medium mt-2">
                    <a href="mailto:{{ $profile->email }}"
                        class="hover:underline hover:text-blue-600 transition-colors duration-300">
                        @ {{ $profile->email }}
                    </a>
                </p>

                <!-- Bio Section -->
                <div class="mt-4">
                    <p class="text-base text-gray-700 font-light leading-relaxed">
                        {{ $profile->bio }}
                    </p>
                </div>

                <!-- Profile Created At Section -->
                <div class="mt-4">
                    <p class="text-xs text-gray-400">
                        Profile created on: {{ $profile->created_at->format('F j, Y') }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!-- Publications Section -->
    <div class="w-full  lg:w-5/6 mx-auto mt-10">
        <!-- Publications Title -->
        <div class="publication">
            <h2 class="text-xl font-semibold p-6 text-gray-900 border-b border-gray-200">Publications by {{ $profile->name }}</h2>
        </div>

        <!-- Publications Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @if ($profile->publications->isEmpty())
                <p class="text-center text-gray-500">This profile has no publications yet.</p>
            @else
                @foreach ($profile->publications as $publication)
                    <x-publication :publication="$publication" />
                @endforeach
            @endif
        </div>
    </div>

</x-master>
    <!-- component -->
    {{-- <div class="flex justify-center">
        <!-- Main Container -->
        <div class="w-3/4 flex justify-between">
    
            <!-- Post Section (Centered) -->
            <div class="w-full md:w-2/3 bg-white border border-gray-300 p-4 my-10 rounded-lg shadow-lg">
    
                <!-- Profile Section (User Avatar and Name) -->
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
    
                <!-- Post Content -->
                <h3 class="text-lg font-bold text-gray-900">{{ $publication->titre }}</h3>
                <p class="mt-2 text-gray-700">{{ \Illuminate\Support\Str::limit($publication->body, 150) }}</p>
    
                <!-- Show image if it exists -->
                @if($publication->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->titre }}" class="w-full h-60 object-fit rounded-lg">
                    </div>
                @endif
    
                <!-- Edit and Delete Buttons (Only for the owner) -->
                @auth
                    @if (auth()->user()->id === $publication->profile_id)
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('publications.show', $publication->id) }}" class="text-blue-600 hover:underline">Read More</a>
                            <div class="flex space-x-4">
                                <!-- Edit Button -->
                                <a href="{{ route('publications.edit', $publication->id) }}" class="text-yellow-500 hover:text-yellow-600 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L3 14.172V17h2.828l11.586-11.586a2 2 0 000-2.828zM4 16v-1.586l10.586-10.586 1.586 1.586L5.586 16H4z" />
                                    </svg>
                                </a>
    
                                <!-- Delete Button -->
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
                        </div>
                    @endif
                @endauth
            </div>
    
           
        </div>
    </div> --}}
    