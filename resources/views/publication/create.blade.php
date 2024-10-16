<x-master title="publication">

    <section class="bg-white ">
        
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Add New Publication</h2>
            <form method="POST" action="{{ route('publications.store') }}" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="profile_id" value="{{ Auth::user()->id }}"> --}}
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    
                    <!-- Title -->
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Title</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter publication title" value="{{ old('title') }}">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <!-- Author -->
                    <div class="sm:col-span-2">
                        <label for="author" class="block mb-2 text-sm font-medium text-gray-900 ">Author</label>
                        <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Author's name" value="{{ old('author') }}">
                        @error('author')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                        <textarea id="body" name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Publication description here...">{{ old('description') }}</textarea>
                        @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- File Upload (optional) -->
                    <div class="sm:col-span-2">
                        <label for="file" class="block mb-2 text-sm font-medium text-gray-900 ">Upload File (Optional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 ">PDF, DOC, or TXT (MAX. 10MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="image" class="hidden" />
                            </label>
                        </div> 
                    </div>
                    @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                </div>

                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm border-black font-medium text-center text-black bg-gray-200 rounded-lg focus:ring-4 focus:ring-gray-200 hover:bg-gray-800 hover:text-white">
                    Add Publication
                </button>
            </form>
        </div>
    </section>

</x-master>
