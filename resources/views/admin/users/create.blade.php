<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Register Agro-company') }}
        </h2>
    </x-slot>

       
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="max-w-7lx h-5/6 py-12 px-2 m-auto sm:px-8 lg:px-12">
            <div class="bg-white shadow-md w-full h-5/6 m-auto py-6 px-4 sm:px-6 lg:px-8 rounded-md">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Agro-company Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Company Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

             <!-- Phone number -->
             <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

             <!-- National Id -->
             <div class="mt-4">
                <x-label for="national-id" :value="__('Company id')" />

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

             <!-- Location -->
             <div class="mt-4">
                <x-label for="location" :value="__('Location(Ward)')" />

                <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
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
                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
            </div>
        </div>

</x-admin-layout>
