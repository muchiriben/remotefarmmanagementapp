<x-rural-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row gap-12 p-6 bg-white border-b border-gray-200 text-left text-lg text-md">

                    <div class="flex justify-center items-center flex-initial p-4">
                        <div class="flex justify-center items-center h-32 w-32 rounded-full   bg-neutral-color">
                            @if (Auth::user()->profile_image != null)
                            <img class="h-32 w-32 rounded-full object-cover" src="{{ asset('storage/profile_image/' .Auth::user()->id.  '/' .Auth::user()->profile_image) }}" alt="">
                            @else
                            <img class="h-32 w-32 rounded-full object-cover" src="{{ asset('storage/profile_image/profile_icon.png') }}" alt="">
                            @endif
                        </div>  
                    </div>  
                <div class=" border-r-2 border-accent-color p-4">
                    <div class="p-4 text-black font-semibold">
                        <span class="text-accent-color">Name:</span><br> {{ $user->name }}
                    </div>
                    <div class="p-4 text-black font-semibold">
                        <span class="text-accent-color">Email:</span><br> {{ $user->email }}
                    </div>
                    <div class="p-4 text-black font-semibold">
                        <span class="text-accent-color">Phone:</span><br> {{ $user->phone }}
                    </div>
                    <div class="p-4 text-black font-semibold">
                        <span class="text-accent-color"> National_id: </span><br> {{ $user->national_id }}
                    </div>
                </div>

                    
              <div class="flex justify-center items-center flex-col p-4 text-black text-center font-semibold">
                <h1 class="text-accent-color">My Description</h1>
                <div>
                    {{ $user->description }}
                </div>
             </div>
                <div class="flex justify-center items-end p-4 pb-0">
                    <x-link-button :href="route('profile.edit', $user->id)" class="h-12 ">
                        {{ __('Edit Profile') }}
                    </x-link-button>
                </div>
              
                </div>
            </div>
        </div>
    </div>
</x-rural-layout>
