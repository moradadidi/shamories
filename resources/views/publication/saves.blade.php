<x-master title="Saves">
    <div class="flex justify-center">
        <!-- Main Container -->
        <div class="w-full lg:w-5/6 bg-white border border-gray-200 p-6 rounded-xl shadow-md mb-30">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">My Saved Publications</h2>

            @if ($saves->isEmpty())
                <p class="text-gray-600">You have not saved any publications yet.</p>
            @else
                @foreach ($saves as $save)
                    <div class="border-b border-gray-200 pb-4 mb-4">
                        <!-- Profile and Timestamp -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <a href="{{ route('profiles.show', $save->profile->id) }}">
                                    <img class="w-12 h-12 rounded-full object-cover cursor-pointer"
                                        src="{{ $save->profile && $save->profile->image ? asset('storage/' . $save->profile->image) : asset('storage/profile/default-profile.jpg') }}"
                                        alt="{{ $save->profile->name ?? 'Unknown User' }}">
                                </a>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-900">
                                        <a href="{{ route('profiles.show', $save->profile->id) }}">{{ $save->profile->name ?? 'Unknown User' }}</a>
                                    </h4>
                                    <p class="text-sm text-gray-500">{{ $save->publication->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <!-- Dropdown Button -->
                            <button aria-haspopup="true" aria-expanded="false" onclick="toggleDropdown(this)"
                                class="inline-flex items-center p-2 text-sm text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div class="dropdownDots hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute right-10 mt-2">
                                <ul class="py-2 text-sm text-gray-700">
                                    <li>
                                        <form action="{{ route('publications.toggleSave', $save->publication->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center w-full px-4 py-2 hover:bg-gray-100 {{ Auth::check() && Auth::guard('web')->user()->hasSaved($save->publication) ? 'text-yellow-500' : 'text-gray-700' }}">
                                                {{ Auth::check() && Auth::guard('web')->user()->hasSaved($save->publication) ? 'Unsave' : 'Save' }}
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="flex items-center px-4 py-2 hover:bg-gray-100 {{ Auth::check() && Auth::guard('web')->user()->isFollowing($save->profile) ? 'text-blue-500' : 'text-gray-700' }}">
                                            {{ Auth::check() && Auth::guard('web')->user()->isFollowing($save->profile) ? 'Unfollow' : 'Follow' }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 text-gray-700">Not Interested</a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">Report Post</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Post Title and Content -->
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            <a href="{{ route('publications.show', $save->publication->id) }}">{{ $save->publication->title }}</a>
                        </h3>
                        <p class="text-gray-600">{{ \Illuminate\Support\Str::limit($save->publication->body, 150) }}</p>

                        <!-- Image Section -->
                        @if ($save->publication->image)
                            <div class="mt-6">
                                <img src="{{ asset('storage/' . $save->publication->image) }}" alt="{{ $save->publication->title }}"
                                    class="w-full h-64 object-cover rounded-lg shadow-sm border border-gray-300">
                            </div>
                        @endif

                        <!-- Like and Comment Section -->
                        <div class="flex items-center justify-between mt-6">
                            <form action="{{ route('publications.like', $save->publication->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center space-x-1 {{ Auth::check() && Auth::guard('web')->user()->hasLiked($save->publication) ? 'text-red-500' : 'text-gray-500' }} hover:text-red-600 transition">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                    <span class="ml-2">{{ $save->publication->likes->count() }} Likes</span>
                                </button>
                            </form>
                            <button onclick="toggleComments({{ $save->publication->id }})" class="text-sm text-blue-500 hover:underline">
                                Show {{ $save->publication->comments->count() }} Comments
                            </button>
                        </div>

                        <!-- Comments Section -->
                        <div id="comments-{{ $save->publication->id }}" class="mt-6 space-y-6 hidden">
                            @foreach ($save->publication->comments as $comment)
                                <div class="flex items-start bg-gray-100 p-4 rounded-lg space-x-4">
                                    <img class="w-10 h-10 rounded-full object-cover"
                                        src="{{ $comment->profile && $comment->profile->image ? asset('storage/' . $comment->profile->image) : asset('storage/profile/default-profile.jpg') }}"
                                        alt="{{ $comment->profile->name ?? 'Unknown User' }}">
                                    <div class="flex flex-col">
                                        <div class="flex justify-between items-center gap-96">
                                            <p class="text-gray-900 font-medium">{{ $comment->profile->name ?? 'Unknown User' }}</p>
                                            <p class="text-gray-600 text-xs pl-16">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        <p class="text-gray-700 text-sm">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Toggle Comments and Dropdown Script -->
    <script>
        function toggleDropdown(button) {
            button.nextElementSibling.classList.toggle('hidden');
        }

        function toggleComments(publicationId) {
            document.getElementById('comments-' + publicationId).classList.toggle('hidden');
        }
    </script>
</x-master>
