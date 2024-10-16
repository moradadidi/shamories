<x-master title="profil">

    <h1 class="text-4xl font-bold text-center text-blue-600 my-6">
        WELCOME
    </h1>
    
    <p class="text-lg text-center text-gray-700 mb-8">
        This is the profile page
    </p>
    

    <div class="relative overflow-x-auto shadow-md  sm:rounded-lg">
                @foreach ($profiles as $profile)
                <x-card :profile="$profile" />
                
                @endforeach
                {{$profiles->links()}}

    </div>

</x-master>
