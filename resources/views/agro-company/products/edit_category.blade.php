<x-agro-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Edit Category') }}
      </h2>
  </x-slot>
  
      <div class="bg-white py-4">

      <div class="max-w-7lx h-5/6 pb-4 px-2 m-auto sm:px-8 lg:px-12">
      <div class="border-t-8 border-accent-color shadow-lg w-full h-5/6 m-auto py-6 px-4 sm:px-6 lg:px-8 rounded-md">
        <form method="POST" action="{{ route('agro.product-categories.update', $category)}}">
          @csrf
          @method('PATCH')

          <!-- Name -->
          <div>
              <x-label for="name" :value="__('Category Name')" />

              <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $category->name }}" required autofocus />
          </div>

          <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Edit Category') }}
            </x-button>
        </div>

        </form>
      </div>
      </div>
        
        </div>
      
      </x-agro-layout>