<x-rural-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('New Task ') }}
        </h2>
    </x-slot>

       
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="max-w-7lx h-5/6 py-12 px-2 m-auto sm:px-8 lg:px-12">
            <div class="bg-white shadow-md w-full h-5/6 m-auto py-6 px-4 sm:px-6 lg:px-8 rounded-md">
        <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
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

            <!-- title -->
            <div class="mt-4">
                <x-label for="title" :value="__('Task Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />

                <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" placeholder="Description" autofocus />
            </div>

            <!-- date -->
            <div class="mt-4">
                <x-label for="date" :value="__('Date')" />

                <x-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required />
            </div>

             <!-- task images -->
             <div class="mt-4">
                <x-label for="task_images" :value="__('Task Images')" />

                <x-input id="task_images" class="block mt-1 w-full" type="file" name="task_images[]" :value="old('task_images')" placeholder="Task Images" autofocus multiple/>
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Add Task') }}
                </x-button>
            </div>
        </form>
            </div>
        </div>

</x-rural-layout>
