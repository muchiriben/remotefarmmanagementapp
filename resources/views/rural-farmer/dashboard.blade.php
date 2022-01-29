<x-rural-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    My Urban Farmers
                </div>
            </div>
            <div class="mx-8 py-12 grid grid-cols-3 gap-8">

                @foreach ($urban_farmers as $farmer)
        
                <div class="flex flex-col bg-white border-l-4 border-secondary-color max-w-sm shadow-md py-8 px-10 md:px-8 rounded-md">
                  <div class="flex flex-col md:flex-row gap-6 md:gap-8">
                    @if ($farmer->profile_image != null)
                                      <img class="h-20 w-20 rounded-full object-cover" src="{{ asset('storage/profile_image/' .$farmer->id.  '/' .$farmer->profile_image) }}" alt="">
                                      @else
                                      <img class="h-20 w-20 rounded-full object-cover" src="{{ asset('storage/profile_image/profile_icon.png') }}" alt="">
                                      @endif
                    <div class="flex flex-col text-center md:text-left">
                      <div class=" text-accent-color mb-2 whitespace-nowra">Name: {{ $farmer->name }}</div>
                      <div class="text-accent-color mb-2 whitespace-nowrap">Email: {{ $farmer->email }}</div>
                      <div class="text-accent-color mb-2 whitespace-nowrap">Phone: {{ $farmer->phone }}</div>
                      <div class="text-accent-color mb-2 whitespace-nowrap">Location: {{ $farmer->location }}</div>
                      <div class="text-accent-color mb-2 whitespace-nowrap">About: {{ $farmer->description }}</div>
                    </div>
                  </div>
                </div>
        
                @endforeach
              </div>
        </div>
    </div>
</x-rural-layout>
