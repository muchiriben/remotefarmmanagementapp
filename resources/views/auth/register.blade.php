<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

             <!-- Phone number -->
             <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <!-- National Id -->
            <div class="mt-4">
                <x-label for="national-id" :value="__('National id')" />

                <x-input id="national-id" class="block mt-1 w-full" type="number" name="national_id" :value="old('national_id')" required />
            </div>

            <!-- Profile image -->
            <div class="mt-4">
                <x-label for="profile_image" :value="__('Profile Image')" />

                <x-input id="profile_image" class="block mt-1 w-full" type="file" name="profile_image" :value="old('profile_image')" placeholder="Profile Image" autofocus />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />

                <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" placeholder="Description" autofocus />
            </div>

            <!-- Role -->
            <div class="grid grid-rows mt-4 ">
                <x-label :value="__('Roles')" class="mb-2"/>
                <div class="flex flex-row items-center ">
                    <div class="flex flex-row items-center mr-2">
                        <x-input id="urban-farmer" class="mr-2" type="radio" name="roles[]" value="2"/>
                        <x-label for="urban-farmer" value="Urban Farmer" />
                    </div>
                    <div class="flex flex-row items-center mr-2">
                        <x-input id="rural-farmer" class="mr-2" type="radio" name="roles[]" value="3"/>
                        <x-label for="rural-farmer" value="Rural Farmer"/>
                    </div>
                </div>  
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
