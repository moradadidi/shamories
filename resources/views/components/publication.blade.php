<div class="flex justify-center">
    <!-- Main Container -->
    <div class="w-full lg:w-4/5 bg-white border border-gray-200 p-6 rounded-xl shadow-md mb-10">

        <!-- Profile and Timestamp -->
        <div class="flex items-center mb-4">
            <img class="w-12 h-12 rounded-full object-cover"
                src="{{ $publication->profile && $publication->profile->image ? asset('storage/' . $publication->profile->image) : asset('storage/profile/default-profile.jpg') }}"
                alt="{{ $publication->profile->name ?? 'Unknown User' }}">
            <div class="ml-4">
                <h4 class="text-lg font-semibold text-gray-900">{{ $publication->profile->name ?? 'Unknown User' }}</h4>
                <p class="text-sm text-gray-500">{{ $publication->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <!-- Post Title and Content -->
        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $publication->title }}</h3>
        <p class="text-gray-600 text-base">{{ \Illuminate\Support\Str::limit($publication->body, 150) }}</p>

        <!-- Image Section -->
        @if ($publication->image)
        <div class="mt-6">
            <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->title }}"
                class="w-full h-64 object-fit rounded-lg shadow-sm border border-gray-300">
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
        <form action="{{ route('publications.comment', $publication->id) }}" method="POST" class="mt-6 flex items-center space-x-2">
            @csrf
            <textarea id="chat" name="content" rows="1"
                class="w-full text-sm border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Écrivez un commentaire..."></textarea>
            <button type="submit" class="inline-flex items-center p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-full transition">
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
                <div>
                    <p class="text-gray-900 font-medium">{{ $comment->profile->name ?? 'Unknown User' }}</p>
                    <p class="text-gray-700 text-sm">{{ $comment->content }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Toggle Comments Script -->
<script>
    function toggleComments(publicationId) {
        const commentsSection = document.getElementById('comments-' + publicationId);
        commentsSection.classList.toggle('hidden');
    }
</script>
