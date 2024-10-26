<x-master title="profil">

    <section class="my-72">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <!-- Card container -->
            <div class="w-full bg-white dark:bg-gray-800 rounded-lg shadow border md:mt-0 sm:max-w-xl xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="#" class="flex items-center justify-center space-x-2 mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="w-24 h-24 mr-2" src="{{ asset('storage/profile/okkke.jpeg') }}" alt="logo">
                    </a>
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl">
                        Create Your account
                    </h1>

                    <form method="POST" action="{{ route('profiles.store') }}" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
                        @csrf

                        <!-- Two-column Grid -->
                        <div class="grid grid-cols-2 gap-6">

                            <!-- Name Field -->
                            <div class="flex flex-col">
                                <label for="name" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter your name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="flex flex-col">
                                <label for="email" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Profile@example.com" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="flex flex-col">
                                <label for="password" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                                <input type="password" name="password" id="password" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="••••••••">
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="flex flex-col">
                                <label for="password_confirmation" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="••••••••">
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                        </div> <!-- End of Two-column Grid -->

                        <!-- Bio Field (Full Width) -->
                        <div class="flex flex-col">
                            <label for="bio" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bio</label>
                            <textarea id="bio" name="bio" rows="4" class="block w-full text-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg p-2.5 focus:ring-primary-600 focus:border-primary-600" placeholder="Profile bio here...">{{ old('bio') }}</textarea>
                            @error('bio')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload Field (Full Width) -->
                        <div class="flex flex-col">
                            <label for="image" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Profile Image</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 2.22-1.78 4-4 4s-4-1.78-4-4m8 0a4 4 0 100-8 4 4 0 00-8 0m0 8v8m4 0v-8" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG, or GIF (MAX. 800x400px)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" name="image" class="hidden" />
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button (Full Width) -->
                        <button type="submit" class="w-full text-black dark:text-white bg-gray-200 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Sign Up
                        </button>
                    </form>
                    
                    <!-- Already have an account? -->
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="{{route('login')}}" class="font-medium text-gray-600 dark:text-gray-300 hover:underline">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

</x-master>

