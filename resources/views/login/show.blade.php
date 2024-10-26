<x-master title="Se connecter">
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <a href="#" class="flex items-center justify-center space-x-2 mb-6 text-2xl font-semibold text-gray-900">
                        <img class="w-24 h-24 mr-2" src="{{ asset('storage/profile/okkke.jpeg') }}" alt="Logo" aria-label="Website Logo">
                    </a>
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                            <input type="email" name="email" id="email" aria-describedby="emailHelp" 
                                   class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                   placeholder="name@company.com" value="{{ old('email') }}" required>
                            @error('email')
                                <x-alert color="red">
                                    {{ $message }}
                                </x-alert>
                            @enderror
                        </div>
                        
                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                   required>
                            @error('password')
                                <x-alert color="red">
                                    {{ $message }}
                                </x-alert>
                            @enderror
                        </div>
                        
                        <!-- Submit Button with Loading Spinner -->
                        <button type="submit" class="w-full flex justify-center items-center text-black bg-gray-200 hover:bg-gray-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <span>Sign in</span>
                            <svg class="ml-2 hidden animate-spin h-5 w-5 text-white" id="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </button>

                        <!-- Register Link -->
                        <p class="text-sm font-light text-gray-500">
                            Don’t have an account yet? <a href="{{ route('profiles.create') }}" class="font-medium text-gray-600 hover:underline">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('spinner').classList.remove('hidden');  // Show spinner on form submit
        });
    </script>
</x-master>
