<x-urban-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Shopping Cart') }}
      </h2>
  </x-slot>

  <script src="https://js.stripe.com/v3/"></script>
  
  <div class="bg-neutral-color py-4 mx-8">

    <x-link-button :href="route('orders.index')">
      {{ __('My Orders') }}
    </x-link-button>

    <div class="flex flex-col justify-center items-center bg-white shadow-md p-4 rounded-lg my-4">
         <h1 class="uppercase font-bold text-4xl text-accent-color">Thank you for your purchase!!</h1>
         <span class="font-medium text-lg">Your payment was succesful. Delivery is within 24 hours.</span>
    </div>
  </div>

</x-urban-layout>