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
