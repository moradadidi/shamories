<div class="flex justify-center">
    <!-- Main Container -->
    <div class="w-full lg:w-5/6 bg-white border border-gray-200 p-6 rounded-xl shadow-md mb-10">

        <!-- Profile and Timestamp -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <a href="{{ route('profiles.show', $publication->profile->id) }}">
                    <img class="w-12 h-12 rounded-full object-cover cursor-pointer"
                        src="{{ $publication->profile && $publication->profile->image ? asset('storage/' . $publication->profile->image) : asset('storage/profile/default-profile.jpg') }}"
                        alt="{{ $publication->profile->name ?? 'Unknown User' }}">
                </a>
                <div class="ml-4">
                    <h4 class="text-lg font-semibold text-gray-900">
                        <a href="{{ route('profiles.show', $publication->profile->id) }}">{{ $publication->profile->name ?? 'Unknown User' }}</a>
                    </h4>
                    <p class="text-sm text-gray-500">{{ $publication->created_at->diffForHumans() }}</p>
                </div>
            </div>

                   <!-- Dropdown Button -->
                   <button onclick="toggleDropdown(this)" id="dropdownMenuIconButton"
                   class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none"
                   type="button">
                   <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                       viewBox="0 0 4 15">
                       <path
                           d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                   </svg>
               </button>
   
               <!-- Dropdown menu -->
               <div id="dropdownDots"
                   class="dropdownDots z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute right-56 mt-2">
                   <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownMenuIconButton">
                       <!-- Save/Unsave Option -->
                       <li>
                           <form action="{{ route('publications.toggleSave', $publication->id) }}" method="POST"
                               class="flex items-center">
                               @csrf
                               <button type="submit"
                                   class="flex items-center w-full px-4 py-2 hover:bg-gray-100 {{ Auth::check() && Auth::guard('web')->user()->hasSaved($publication) ? 'text-yellow-500' : 'text-gray-700' }}">
                                   {{ Auth::check() && Auth::guard('web')->user()->hasSaved($publication) ? 'Unsave' : 'Save' }}
                               </button>
                           </form>
                       </li>
   
                       <!-- Follow/Unfollow Option -->
                       <li>
                           <a href="#"
                               class="flex items-center px-4 py-2 hover:bg-gray-100 {{ Auth::check() &&Auth::guard('web')->user()->isFollowing($publication->profile)? 'text-blue-500': 'text-gray-700' }}">
                               {{ Auth::check() &&Auth::guard('web')->user()->isFollowing($publication->profile)? 'Unfollow': 'Follow' }}
                           </a>
                       </li>
   
                       <!-- Not Interested Option -->
                       <li>
                           <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 text-gray-700">
                               Not Interested
                           </a>
                       </li>
   
                       <!-- Report Post Option -->
                       <li>
                           <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100 ">
                               Report Post
                           </a>
                       </li>
                   </ul>
               </div>
        </div>

        <!-- Post Title and Content -->
        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $publication->title }}</h3>
        <p class="text-gray-600 text-base">{{ \Illuminate\Support\Str::limit($publication->body, 3250) }}</p>

        <!-- Image Section with Placeholder Spinner -->
        @if ($publication->image)
            <div class="mt-6 relative">
                <!-- Spinner Placeholder -->
                <div id="spinner-{{ $publication->id }}" class="absolute inset-0 flex items-center justify-center bg-gray-200 rounded-lg">
                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-gray-900"></div>
                </div>

                <!-- Publication Image -->
                <img 
                    src="{{ asset('storage/' . $publication->image) }}" 
                    alt="{{ $publication->title }}" 
                    class="w-full h-64 object-cover rounded-lg shadow-sm border border-gray-300"
                    onload="hideSpinner({{ $publication->id }})"
                >
            </div>
        @endif

        <!-- Like and Comment Section -->
        <div class="flex items-center justify-between mt-6">
            <!-- Like Button -->
            <form action="{{ route('publications.like', $publication->id) }}" method="POST" class="flex items-center">
                @csrf
                <button type="submit"
                    class="flex items-center space-x-1 {{ Auth::check() && Auth::guard('web')->user()->hasLiked($publication) ? 'text-red-500' : 'text-gray-500' }} hover:text-red-600 transition ease-in-out">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    <span class="ml-2">{{ $publication->likes->count() }} J'aime</span>
                </button>
            </form>

            <!-- Comment Count Link -->
            <button onclick="toggleComments({{ $publication->id }})" class="text-sm text-blue-500 hover:underline">
                Afficher les {{ $publication->comments->count() }} commentaires
            </button>
        </div>

        <!-- Comment Input Form -->
        @auth
            <form action="{{ route('publications.comment', $publication->id) }}" method="POST"
                class="mt-6 flex items-center space-x-2">
                @csrf
                <textarea id="chat" name="content" rows="1"
                    class="w-full text-sm border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Écrivez un commentaire..."></textarea>
                <button type="submit"
                    class="inline-flex items-center p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-full transition">
                    <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="M17.914 18.594L1.07.408a1 1 0 0 0-1.828 0L-8 18.594a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 1 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                    </svg>
                </button>
            </form>
        @endauth

        <!-- Comments Section -->
        <div id="comments-{{ $publication->id }}" class="mt-6 space-y-6 hidden">

            @foreach ($publication->comments as $comment)
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
</div>

<!-- Toggle Comments, Dropdown, and Spinner Script -->
<script>
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown if clicked outside
    window.addEventListener('click', function(e) {
        document.querySelectorAll('.dropdownDots').forEach(dropdown => {
            if (!dropdown.contains(e.target) && !dropdown.previousElementSibling.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });

    function toggleComments(publicationId) {
        const commentsSection = document.getElementById('comments-' + publicationId);
        commentsSection.classList.toggle('hidden');
    }

    // Hide spinner once image loads
    function hideSpinner(publicationId) {
        document.getElementById('spinner-' + publicationId).style.display = 'none';
    }
</script>
