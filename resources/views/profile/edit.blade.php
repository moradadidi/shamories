<x-master title="edit_profil">
    
    <section class="bg-white ">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Edit Profile</h2>
            <form method="post" action="{{ route('profiles.update', $profile->id ) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <!-- Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">New Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter Profile name" value="{{ old('name', $profile->name) }}">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2"> <!-- This class makes it take full width -->
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">New Email</label>
                        <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Profile@example.com" value="{{ old('email', $profile->email) }}">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="w-full">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">New Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="w-full">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Confirm password">
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    
                    <div class="sm:col-span-2">
                        <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 ">Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 ">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" name="image" type="file" class="hidden" />
                            </label>
                        </div> 
                    </div>
                    <!-- Bio -->
                    <div class="sm:col-span-2">
                        <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 ">Bio</label>
                        <textarea id="bio" name="bio" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500" placeholder="Profile bio here...">{{ old('bio', $profile->bio) }}</textarea>
                        @error('bio')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Location -->
        <div class="sm:col-span-2">
            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Location</label>
            <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Enter your location" value="{{ old('location', $profile->location) }}">
            @error('location')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Occupation -->
        <div class="sm:col-span-2">
            <label for="occupation" class="block mb-2 text-sm font-medium text-gray-900">Occupation</label>
            <input type="text" name="occupation" id="occupation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Enter your occupation" value="{{ old('occupation', $profile->occupation) }}">
            @error('occupation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- University -->
        <div class="sm:col-span-2">
            <label for="university" class="block mb-2 text-sm font-medium text-gray-900">University</label>
            <input type="text" name="university" id="university" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Enter your university" value="{{ old('university', $profile->university) }}">
            @error('university')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
                </div>

                <button type="submit" class="inline-flex items-center flex-end px-5 py-2.5 mt-4 sm:mt-6 text-sm border-black font-medium text-center text-black bg-gray-200 rounded-lg focus:ring-4 focus:ring-gray-200 hover:bg-gray-800 hover:text-white">
                    Update Profile
                </button>
            </form>
        </div>
    </section>

</x-master>
