<x-master title="show_profile">

    <main class="profile-page">
        <section class="relative block h-500-px">
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                style="background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');">
                <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                style="transform: translateZ(0px)">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>

        <section class="relative py-16 bg-blueGray-200 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-gray-700 w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <!-- Profile Image -->
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative">
                                    <img alt="{{ $profile->name }}" src="{{ asset('storage/' . $profile->image) }}"
                                        class="shadow-xl w-40 rounded-full h-40 align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                                </div>
                            </div>

                            <!-- Edit/Follow Button -->
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">
                                    <button
                                        class="bg-pink-500 hover:bg-pink-600 text-white font-bold shadow text-xs px-4 py-2 rounded transition ease-linear duration-150"
                                        type="button">
                                        @if (Auth::user()->id == $profile->id)
                                            <a href="{{ route('profiles.edit', $profile->id) }}">Edit Profile</a>
                                        @else
                                            @if (Auth::user()->isFollowing($profile))
                                                <a href="{{ route('profiles.follow', $profile->id) }}">Unfollow</a>
                                            @else
                                                <a href="{{ route('profiles.follow', $profile->id) }}">Add Friend</a>
                                            @endif
                                        @endif
                                    </button>
                                </div>
                            </div>

                            <!-- Profile Stats -->
                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                    <div class="mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block tracking-wide text-blueGray-600 dark:text-gray-200">{{ $profile->follow }}</span>
                                        <span class="text-sm text-blueGray-400 dark:text-gray-400">Friends</span>
                                    </div>
                                    <div class="mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block tracking-wide text-blueGray-600 dark:text-gray-200">{{ $profile->count }}</span>
                                        <span class="text-sm text-blueGray-400 dark:text-gray-400">Photos</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block tracking-wide text-blueGray-600 dark:text-gray-200">{{ $profile->comments }}</span>
                                        <span class="text-sm text-blueGray-400 dark:text-gray-400">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Details -->
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 dark:text-gray-200">
                                {{ $profile->name }}
                            </h3>

                            <div class="text-sm mt-0 mb-2 text-blueGray-400 dark:text-gray-400 font-bold uppercase">
                                <i class="fas fa-map-marker-alt mr-2 text-lg"></i>
                                {{ $profile->location ?? 'Location not set' }}
                            </div>

                            <div class="mb-2 text-blueGray-600 dark:text-gray-300">
                                <i class="fas fa-briefcase mr-2 text-lg"></i>{{ $profile->occupation ?? 'Occupation not set' }}
                            </div>

                            <div class="mb-2 text-blueGray-600 dark:text-gray-300">
                                <i class="fas fa-university mr-2 text-lg"></i>{{ $profile->university ?? 'University not set' }}
                            </div>
                        </div>

                        <!-- Bio Section -->
                        <div class="mt-10 py-10 border-t border-blueGray-200 dark:border-gray-600 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">
                                    <p class="mb-4 text-lg leading-relaxed text-blueGray-700 dark:text-gray-300">
                                        {{ $profile->bio ?? 'Description not set' }}
                                    </p>
                                    <a href="#more" class="text-pink-500 dark:text-pink-400">Show more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="relative bg-blueGray-200 dark:bg-gray-800 pt-8 pb-6 mt-8">
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap items-center md:justify-between justify-center">
                        <div class="w-full md:w-6/12 px-4 mx-auto text-center">
                            <div class="text-sm text-blueGray-500 dark:text-gray-400 font-semibold py-1">
                                Made with <a href="https://www.creative-tim.com/product/notus-js" class="hover:text-gray-800 dark:hover:text-gray-300" target="_blank">Notus JS</a> by <a href="https://www.creative-tim.com" class="hover:text-blueGray-800 dark:hover:text-blueGray-400" target="_blank">Creative Tim</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </section>
    </main>

</x-master>
