<nav class="bg-white border-gray-200 border-b-2 fixed top-0 w-full z-50">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{route('homepage')}}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('storage/profile/image.png') }}" class="h-12" alt="Flowbite Logo" />
      {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span> --}}
    </a>

    <!-- Mobile menu button -->
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>

    <!-- Desktop menu -->
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
        <li>
          <a href="{{route('homepage')}}" class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-700 md:p-0">Accueil</a>
        </li>
        
        <li>
          <a href="{{route('publications.index')}}" class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-700 md:p-0">Publications</a>
        </li>

        <li>
          <a href="{{route('profiles.index')}}" class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-700 md:p-0">Profiles</a>
        </li>
        
        
        {{-- <li>
          <a href="{{route('settings.index')}}" class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Mes Informations</a>
        </li> --}}

        @auth
       
        <li>
          <a href="{{route('publications.create')}}" class="block mt-1.5 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Ajouter Publication</a>
        </li>
        <li>
          <button id="dropdownInformationButton" 
        data-dropdown-toggle="dropdownInformation" 
        class="bg-cover bg-center text-white hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-full text-sm px-5  text-center inline-flex items-center w-10 h-10 " 
        style="background-image: url('{{ asset('storage/' . Auth::user()->image) }}')">
    <svg class="w-2.5 h-2.5 ms-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
</button>



          <!-- Dropdown menu -->
          <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
              <div>{{ Auth::user()->name }}</div>
              <div class="font-medium truncate">{{ Auth::user()->email }}</div>
            </div>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
              
              
              <li>
                <a href="{{route('profiles.show', Auth::id())}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mon Profil</a>
                
              </li>
              
              <li>
                <a href="{{route('publications.show' , auth()->user()->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My Publications</a>
                
              </li>
              {{-- <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
              </li> --}}
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
              </li>
            </ul>
            <div class="py-2">
              <a href="{{route('login.logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
            </div>
          </div>
        </li>
        @endauth


        @guest
       
       
        <li>
          <button id="dropdownInformationButton" 
        data-dropdown-toggle="dropdownInformation" 
        class="bg-cover bg-center text-white hover:bg-orange-500 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-full text-sm px-5  text-center inline-flex items-center w-10 h-10 " 
        style="background-image: url('{{ asset('storage/publication/default-profile.jpg') }}')">
    <svg class="w-2.5 h-2.5 ms-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
</button>



          <!-- Dropdown menu -->
          <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
      
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
              
              
              @guest
            <div class="py-2">
              <a href="{{route('profiles.create')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Create Account</a>
            </div>
            <div class="py-2">
              <a href="{{route('login.show')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Se connecter</a>
            </div>
            @endguest
           
            
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
