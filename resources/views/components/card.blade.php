<div role="card"
    class="relative inline-block w-72 mx-10 my-10 text-sm text-gray-500 bg-white border border-gray-200 rounded-lg shadow-lg p-4">

    <!-- Profile Image and Follow Button -->
    <div class="flex items-center justify-between mb-3">
        <a href="{{ route('profiles.show', $profile->id) }}">
            <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $profile->image) }}"
                alt="Profile image of {{ $profile->name }}">
        </a>
        <form action="{{ route('profiles.follow', $profile->id) }}" method="POST">
            @csrf
            <button type="submit"
                class="text-white {{ Auth::check() && Auth::guard('web')->user()->isFollowing($profile) ? 'bg-red-700 hover:bg-red-800' : 'bg-blue-700 hover:bg-blue-800' }} focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5  {{ Auth::check() && Auth::guard('web')->user()->isFollowing($profile) ? ' hover:text-white' : 'text-blue-500 hover:text-white' }}">
                {{ Auth::check() && Auth::guard('web')->user()->isFollowing($profile) ? 'Unfollow' : 'Follow' }}
            </button>
        </form>
    </div>

    <!-- Profile Name -->
    <p class="text-base font-semibold leading-none text-gray-900">
        <a href="{{ route('profiles.show', $profile->id) }}">{{ $profile->name }}</a>
    </p>

    <!-- Username (Email Link) -->
    <p class="text-sm font-normal text-gray-600 mb-2">
        <a href="mailto:{{ $profile->email }}" class="hover:underline">@ {{ $profile->email }}</a>
    </p>

    <!-- Occupation and University -->
    <p class="mb-2 text-sm text-gray-700">
        <strong>{{ $profile->occupation ?? 'Occupation not specified' }}</strong>
    </p>
    <p class="mb-4 text-sm text-gray-500">
        Studied at {{ $profile->university ?? 'University not specified' }}
    </p>

    <!-- Follower/Following Stats -->
    <ul class="flex text-sm text-gray-900">
        <li class="mr-4">
            <a href="#" class="hover:underline">
                <span class="font-semibold">{{ $profile->following_count }}</span>
                <span class="text-gray-600">Following</span>
            </a>
        </li>
        <li>
            <a href="#" class="hover:underline">
                <span class="font-semibold">{{ $profile->followers_count }}</span>
                <span class="text-gray-600">Followers</span>
            </a>
        </li>
    </ul>
</div>
