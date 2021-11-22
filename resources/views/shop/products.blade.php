<x-urban-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Shop Products') }}
      </h2>
  </x-slot>
  
  <div class="bg-neutral-color py-4">
    <div class="grid grid-cols-3 gap-8 my-4 mx-8">
        @foreach($products as $product)
          <div class="flex flex-col bg-neutral-color shadow-lg rounded-lg">
               <div class=" rounded-t-lg">
                   <img class="h-48 w-full rounded-t-lg object-cover" src="{{ asset('storage/product_image/' .$product->id.  '/' .$product->product_image_path) }}" alt="">
               </div>
               <div class="flex flex-col justify-between p-4">
                   <div class="font-semibold text-lg text-accent-color mb-2">{{ $product->name }}</div>
                   <div class="text-md"> {{ $product->description }} </div> <br>
                   <div class="flex flex-col justify-self-end">
                       <h3 class="text-sm mb-2">Price: Ksh {{ $product->price }}/=</h3>
                       <form action="{{ route('urban.cart.store') }}" method="POST">
                        @csrf
                        <x-input type="hidden" name="id" value="{{ $product->id }}"/>
                        <x-input type="hidden" name="name" value="{{ $product->name }}"/>
                        <x-input type="hidden" name="price" value="{{ $product->price }}"/>
                        <x-button class="w-auto p-2 bg-accent-color rounded-md text-neutral-color shadow-md cursor-pointer">
                          {{ __('Add to cart') }}
                      </x-button>
                      </form>  
                   </div>
               </div>
          </div>
          @endforeach
    </div>
  </div>
      
</x-urban-layout>