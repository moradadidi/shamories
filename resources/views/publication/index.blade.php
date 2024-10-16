<x-master title="Publications">
    <section class="bg-gray-100">
        <div class="py-8 px-4 mx-auto max-w-7xl lg:py-16">
            <h2 class="mb-6 text-2xl font-bold text-gray-900 text-center">Publications List</h2>

            <!-- Check if there are any publications -->
            @if($publications->count())
            
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($publications as $publication)
                        <x-publication :publication="$publication" />
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center">No publications found.</p>
            @endif
        </div>
    </section>
</x-master>
