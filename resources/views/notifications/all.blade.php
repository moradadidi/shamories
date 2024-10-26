<x-master>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-semibold mb-4">Your Notifications</h1>
    
            @if ($notifications->isEmpty())
                <p class="text-gray-600">You have no notifications at the moment.</p>
            @else
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        @foreach ($notifications as $notification)
                            <li class="p-4 {{ $notification->read_at ? 'bg-gray-100' : 'bg-white' }}">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium">
                                            {{ $notification->data['message'] ?? 'Notification' }}
                                        </p>
                                        <p class="text-gray-600 text-sm">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
    
                                    @if (!$notification->read_at)
                                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-600 hover:underline">Mark as read</button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
    
                <!-- Pagination links -->
                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    @endsection
    

</x-master>