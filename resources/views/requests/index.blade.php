<x-urban-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Hire Rural Farmer') }}
        </h2>
    </x-slot>

    <div class="mx-8 py-12 grid grid-cols-3 gap-8">

        @foreach ($farmers as $farmer)

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
              <div class="text-accent-color mb-2 whitespace-nowrap">About: {{ $farmer->description }}</div>
              <form action="{{ route('urban.requests.store') }}" method="POST">
                @csrf
                <x-input id="rural_farmer" type="hidden" name="rural_farmer" value="{{ $farmer->id }}"/>
                <x-input id="status" type="hidden" name="status" value="Requested"/>
                <x-button class="w-24 p-2 rounded-md shadow-md cursor-pointer">
                  {{ __('Request') }}
              </x-button>
              </form>  
            </div>
          </div>
        </div>

        @endforeach
      </div>
</x-urban-layout>
