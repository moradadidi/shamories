<x-master title="Publications">
    <!-- Publications Section -->
    <section class="bg-gray-100 py-12">
        <div class="px-4 mx-auto max-w-7xl">

            <!-- Main Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Sidebar (Profiles to Follow) -->
                <aside class="lg:col-span-1">
                    <h3 class="mb-6 text-2xl font-semibold text-gray-800">Suggested Profiles</h3>

                    <!-- Profile List (as sidebar items) -->
                    <div class="space-y-6">
                        @foreach ($profiles as $profile)
                            <div class="flex items-center justify-between bg-white border border-gray-200 p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow ease-in-out duration-200">
                                <!-- Profile Image and Info -->
                                <div class="flex items-center space-x-4">
                                    <img class="w-12 h-12 rounded-full object-cover"
                                         src="{{ $profile->image ? asset('storage/' . $profile->image) : asset('images/default-avatar.jpg') }}" 
                                         alt="{{ $profile->name ?? 'No Name' }}">
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900">{{ $profile->name ?? 'Unknown' }}</h4>
                                        <p class="text-xs text-gray-500">{{ $profile->followers->count() ?? 0 }} followers</p>
                                    </div>
                                </div>
                                
                                <!-- Follow/Unfollow Button -->
                                <form action="{{ route('profiles.follow', $profile->id) }}" method="POST">
                                    @csrf

                                    <button type="submit" 
                                        
                                            class="text-xs px-3 py-1 font-semibold rounded-md transition-colors ease-in-out duration-150 
                                            {{ Auth::check() && Auth::guard('web')->user()->isFollowing($profile) ? 'text-red-500 hover:text-red-600' : 'text-blue-500 hover:text-blue-600' }}">
                                        {{ Auth::check() && Auth::guard('web')->user()->isFollowing($profile) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </aside>

                <!-- Publications List -->
                <main class="lg:col-span-3 space-y-8">
                    @if ($publications->count())
                        @foreach ($publications as $publication)
                            <!-- Publication Component -->
                            <x-publication :publication="$publication" />
                        @endforeach
                    @else
                        <p class="text-lg text-gray-600 text-center">No publications found.</p>
                    @endif
                </main>
            </div>
        </div>
    </section>
</x-master>
