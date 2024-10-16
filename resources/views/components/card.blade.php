<div role="card"
    class="relative inline-block w-80 mx-10 my-10 text-sm text-gray-500 duration-300 bg-white border border-gray-200 rounded-lg shadow-lg p-6">

    <!-- Stretched Link Wrapper -->
    <a href="{{ route('profiles.show', $profile->id) }}" class="absolute inset-0 z-10"></a>

    <!-- Profile Image -->
    <a href="#">
        <img class="w-20 h-20 rounded-full mx-auto object-cover" 
             src="{{ asset('storage/'.$profile->image) }}" 
             alt="Profile image of {{ $profile->name }}">
    </a>

    <!-- User Name -->
    <p class="mt-4 text-xl font-semibold leading-none text-gray-900 text-center">
        <a href="#" class="hover:text-blue-600 transition-colors duration-300">{{ $profile->name }}</a>
    </p>

    <!-- Email -->
    <p class="mb-3 text-sm font-normal text-center">
        <a href="mailto:{{ $profile->email }}" class="hover:underline hover:text-blue-500">@ {{ $profile->email }}</a>
    </p>

    <!-- Show Profile Button -->
    <div class="text-center mt-4">
        <a href="{{ route('profiles.show', $profile->id) }}" 
           class="z-20 font-medium text-blue-600 hover:underline">Show User</a>
    </div>

    <!-- Footer Section with Edit/Delete (only visible for the profile owner) -->
    @if (Auth::id() == $profile->id)
    <div class="mt-6 pt-4 border-t border-gray-200 relative z-20">
        <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="text-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 font-medium hover:underline mr-4">
                Supprimer
            </button>
            <a href="{{ route('profiles.edit', $profile->id) }}" class="font-medium text-blue-600 hover:underline">
                Edit
            </a>
        </form>
    </div>
    @endif
</div>
