<x-master title="Edit Publication">
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-gray-100">Edit Publication</h2>
            <form method="POST" action="{{ route('publications.update', $publication->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    
                    <!-- Title -->
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Title</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter publication title" value="{{ old('title', $publication->titre) }}">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Description</label>
                        <textarea id="body" name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-300 dark:border-gray-700 focus:ring-primary-500 focus:border-primary-500" placeholder="Publication description here...">{{ old('body', $publication->body) }}</textarea>
                        @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- File Upload (optional) -->
                    <div class="sm:col-span-2">
                        <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">Upload File (Optional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOC, or TXT (MAX. 10MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="image" class="hidden" />
                            </label>
                        </div>
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        
                        <!-- Image Preview -->
                        @if ($publication->image)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->title }}" class="w-24 h-24 object-cover rounded-lg">
                            </div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-black bg-gray-200 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 hover:bg-gray-800 hover:text-white dark:hover:bg-gray-600">
                    Modify Publication
                </button>
            </form>
        </div>
    </section>
</x-master>
