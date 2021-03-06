<x-agro-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Edit Product ') }}
        </h2>
    </x-slot>

       
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="max-w-7lx h-5/6 py-12 px-2 m-auto sm:px-8 lg:px-12">
            <div class="bg-white shadow-md w-full h-5/6 m-auto py-6 px-4 sm:px-6 lg:px-8 rounded-md">
        <form method="POST" action="{{ route('agro.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Product Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $product->name }}" required autofocus />
            </div>

            <!-- Slug -->
            <div class="mt-4">
                <x-label for="slug" :value="__('Slug')" />

                <x-input id="slug" class="block mt-1 w-full" type="text" name="slug" value="{{ $product->slug }}" required />
            </div>

             <!-- Price -->
             <div class="mt-4">
                <x-label for="price" :value="__('Price')" />

                <x-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{ $product->price }}" required />
            </div>

             <!-- Product image -->
             <div class="mt-4">
                <x-label for="product_image" :value="__('Change product Image')" />
    
                <x-input id="product_image" class="block mt-1 w-full" type="file" name="product_image" :value="old('product_image')" placeholder="product Image" autofocus />
    
                <x-input id="old_product_image" type="hidden" name="old_product_image" value="{{ $product->product_image_path }}" autofocus />
            </div>

            <!-- Description -->
            <!-- Description -->
         <div class="mt-4">
            <x-label for="description" :value="__('Description')" />

            <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $product->description }}" placeholder="Description" autofocus>{{ $product->description }}</x-textarea>
        </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Edit Product') }}
                </x-button>
            </div>
        </form>
            </div>
        </div>

</x-agro-layout>
