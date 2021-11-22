<x-urban-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Shopping Cart') }}
      </h2>
  </x-slot>
  
  <div class="bg-neutral-color py-4">
    <div class="flex flex-row justify-evenly bg-white shadow-md p-8 rounded-lg my-4 mx-4">
        
        <div class="w-full">
             <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('urban.checkout.store') }}">
            @csrf
        <div class="flex flex-row justify-around mr-6">    
            <div id="billing" class="mr-6">
                <h1 class="font-semibold capitalize text-lg mb-6 text-accent-color">Billing Details</h1>

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email Address')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{ auth()->user()->email }}" required autofocus />
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="Name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ auth()->user()->name }}" required />
            </div>

             <!-- Location -->
             <div class="mt-4">
                <x-label for="location" :value="__('location')" />

                <x-input id="location" class="block mt-1 w-full" type="text" name="location" placeholder="e.g. West Madaraka, Nairobi" :value="old('location')" required />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ auth()->user()->phone }}" required />
            </div>
        </div>
            
        <div id="payment"> 
           <h1 class="font-semibold capitalize text-lg mb-6 text-accent-color">Payment Details</h1>
      
           <!-- Card Number -->
           <div class="mt-4">
            <x-label for="card_number" :value="__('Card Number')" />

            <x-input id="card_number" class="block mt-1 w-full" type="text" name="card_number" :value="old('card_number')" required />
           </div>

           <!-- Expiry month -->
           <div class="mt-4">
            <x-label for="exp_month" :value="__('Expiry month')" />

            <x-input id="exp_month" class="block mt-1 w-full" type="text" name="exp_month" :value="old('exp_month')" placeholder="MM" required />
           </div>

           <!-- Expiry year -->
           <div class="mt-4">
            <x-label for="exp_year" :value="__('Expiry year')" />

            <x-input id="exp_year" class="block mt-1 w-full" type="text" name="exp_year" :value="old('exp_year')" placeholder="YYYY" required />
           </div>

           <!-- CVC -->
           <div class="mt-4">
            <x-label for="cvc" :value="__('CVC')" />

            <x-input id="cvc" class="block mt-1 w-full" type="password" name="cvc" :value="old('cvc')" placeholder="CVC" required />
           </div>
           <br>


           <div class="flex items-center justify-end mt-4">
               <x-button class="ml-4">
                   {{ __('Make Payment') }}
               </x-button>
           </div>

        </div>
    </div>
    </form>
</div>

        <div>
            <h1 class="font-semibold capitalize text-lg mb-6 text-accent-color">Your Orders</h1>
            <table class="min-w-full divide-y-2 divide-gray-200">
                
                <tbody class="bg-white divide-y divide-gray-200">
                    
                  @foreach (Cart::content() as $item)
                  <tr>
                    <td class="py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="flex justify-center items-center h-16 w-16 rounded-lg   bg-neutral-color">
                            @foreach ($products as $product) 
                            @if ($product->id == $item->model->id)
                            @if ($product->product_image_path != null)
                            <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset('storage/product_image/' .$product->id.  '/' .$product->product_image_path) }}" alt="">
                            @else
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/product_image/product_icon.png') }}" alt="">
                            @endif
                            @endif
                            @endforeach
                        </div>  
                          <div class="ml-6">
                            <div class="text-sm font-medium text-black">
                            {{ $item->model->name }}
                            </div>
                          </div>
                        </div>
                      </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black">Ksh {{ $item->model->price }} /=</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black">{{ $item->qty }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black">{{ $item->model->price * $item->qty}} /=</div>
                    </td>
                  </tr>
                  @endforeach
        
                  <!-- More items... -->
                </tbody>
                <span class="text-left font-semibold text-xl text-accent-color">Total to be paid: {{ Cart::instance('default')->subtotal()}} /=</span>
              </table>
        </div>
      
    </div>
  </div>
      
</x-urban-layout>