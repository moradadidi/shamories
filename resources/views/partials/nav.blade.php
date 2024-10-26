<nav class="bg-white border-gray-200 border-b-2 fixed top-0 w-full z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('homepage') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('storage/profile/okkke.jpeg') }}" class="opacity-80 h-16" alt="Flowbite Logo" />
            {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span> --}}
        </a>

        <!-- Mobile menu button -->
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Desktop menu -->
        <div class="hidden w-full md:block md:w-auto " id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
               

                <li>
                    <a href="{{ route('publications.index') }}"
                        class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-700 md:p-0">Publications</a>
                </li>

                <li>
                    <a href="{{ route('profiles.index') }}"
                        class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-700 md:p-0">Profiles</a>
                </li>


                {{-- <li>
          <a href="{{route('settings.index')}}" class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Mes Informations</a>
        </li> --}}

                @auth

                    <li>
                        <a href="{{ route('publications.create') }}"
                            class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Ajouter
                            Publication</a>
                    </li>
                    <li>
                        {{-- <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a> --}}



                        <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                            class="relative inline-flex mt-1 items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none"
                            type="button">
                            <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 14 20">
                                <path
                                    d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                            </svg>

                            <!-- Notification badge for unread notifications -->
                            @if ($notifications->count() > 0)
                                <div
                                    class="absolute block mt-0.5 w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0 start-4 dark:border-gray-900">
                                </div>
                            @endif
                        </button>


                        <!-- Dropdown menu -->
                        <div id="dropdownNotification"
                            class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
                            aria-labelledby="dropdownNotificationButton">
                            <div
                                class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                Notifications
                            </div>

                            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                              @if (isset($notifications) && $notifications->count() > 0)
                                  
                                
                                @forelse($notifications as $notification)
                                    <a href="{{ route('notifications.read', $notification->id) }}"
                                        class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <div class="flex-shrink-0">
                                          {{-- <img class="rounded-full w-11 h-11" src="{{ asset('storage/' . $notification->data['image_url']) }}" alt="Profile image"> --}}
                                          <img class="rounded-full w-11 h-11" src="{{ $notification->data['image_url'] ?? asset('storage/profile/default-profile.jpg') }}" alt="Profile image">
                                        </div>
                                        <div class="w-full ps-3">
                                            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                                                {{ $notification->data['message'] }}
                                            </div>
                                            <div class="text-xs text-blue-600 dark:text-blue-500">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                                        No new notifications
                                    </div>
                                @endforelse
                                @endif
                            </div>

                            <a href="{{ route('notifications.all') }}"
                                class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                <div class="inline-flex items-center">
                                    <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                        <path
                                            d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                    </svg>
                                    View all
                                </div>
                            </a>
                        </div>


                    </li>
                    <li>
                        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                            class="bg-cover bg-center text-white hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-full text-sm px-5  text-center inline-flex items-center w-10 h-10 "
                            style="background-image: url('{{ asset('storage/' . Auth::user()->image) }}')">
                            <svg class="w-2.5 h-2.5 ms-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>



                        <!-- Dropdown menu -->
                        <div id="dropdownInformation"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownInformationButton">


                                <li>
                                    <a href="{{ route('profiles.show', Auth::id()) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mon
                                        Profil</a>

                                </li>

                                <li>
                                    <a href="{{ route('publications.show', auth()->user()->id) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                                        Publications</a>

                                </li>

                                <li>
                                    <a href="{{ route('allSaves') }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Saves</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <a href="{{ route('login.logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                    out</a>
                            </div>
                        </div>
                    </li>
                @endauth


                @guest


                    <li>
                        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                            class="bg-cover bg-center text-white hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-full text-sm px-5  text-center inline-flex items-center w-10 h-10 "
                            style="background-image: url('{{ asset('storage/publication/default-profile.jpg') }}')">
                            <svg class="w-2.5 h-2.5 ms-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>



                        <!-- Dropdown menu -->
                        <div id="dropdownInformation"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">

                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownInformationButton">


                                @guest
                                    <div class="py-2">
                                        <a href="{{ route('profiles.create') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Create
                                            Account</a>
                                    </div>
                                    <div class="py-2">
                                        <a href="{{ route('login.show') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Se
                                            connecter</a>
                                    </div>
                                @endguest


                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
