<x-rural-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

       
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="max-w-7lx h-5/6 py-12 px-2 m-auto sm:px-8 lg:px-12">
            <div class="bg-white shadow-md w-full h-5/6 m-auto py-6 px-4 sm:px-6 lg:px-8 rounded-md">
        <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Company Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
            </div>

             <!-- Phone number -->
             <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{$user->phone}}" required />
            </div>

             <!-- National Id -->
             <div class="mt-4">
                <x-label for="national_id" :value="__('Id')" />

                <x-input id="national_id" class="block mt-1 w-full" type="number" name="national_id" value="{{ $user->national_id }}" required />
            </div>

            <!-- Profile image -->
         <div class="mt-4">
            <x-label for="profile_image" :value="__('Change Profile Image')" />

            <x-input id="profile_image" class="block mt-1 w-full" type="file" name="profile_image" :value="old('profile_image')" placeholder="Profile Image" autofocus />

            <x-input id="old_profile_image" type="hidden" name="old_profile_image" value="{{ $user->profile_image }}" autofocus />
        </div>

         <!-- Description -->
         <div class="mt-4">
            <x-label for="description" :value="__('Description')" />

            <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" autofocus > {{ $user->description }} </x-textarea>
        </div>


            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
            </div>
        </div>

</x-rural-layout>
