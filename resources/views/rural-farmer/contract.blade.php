<x-rural-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Upload Signed Contract ') }}
        </h2>
    </x-slot>


        <div class="max-w-7lx h-5/6 py-12 px-2 m-auto sm:px-8 lg:px-12">
            <div class="bg-white shadow-md w-full h-5/6 m-auto py-6 px-4 sm:px-6 lg:px-8 rounded-md">
        <form method="POST" action="{{ route('ruralupload') }}" enctype="multipart/form-data">
            @csrf

            <!-- urban farmer -->
            <div>
                <x-label for="urban_farmer" :value="__('Task for:')" />

                <select name="urban_farmer" id="urban_farmer" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                    @foreach ($urban_farmers as $urban_farmer)
                        <option value="{{ $urban_farmer->id }}">{{ $urban_farmer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4"> 
            <x-label for="contract" :value="__('Upload Signed Contract')" />

            <x-input id="contract" class="block w-full mt-4" type="file" name="contract" :value="old('contract')" placeholder="Upload contract" autofocus />
           </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Upload Contract') }}
                </x-button>
            </div>
        </form>
            </div>
        </div>

</x-rural-layout>
