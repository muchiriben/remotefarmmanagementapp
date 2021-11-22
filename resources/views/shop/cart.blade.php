<x-urban-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Shopping Cart') }}
      </h2>
  </x-slot>

  <script src="https://js.stripe.com/v3/"></script>
  
  <div class="bg-neutral-color py-4 mx-8">

    <x-link-button :href="route('urban.checkout.index')">
      {{ __('Checkout') }}
    </x-link-button>

    <div class="flex flex-col justify-center items-center bg-white shadow-md p-4 rounded-lg my-4">
     
       <table class="min-w-full divide-y-2 divide-gray-200">
        <thead>
          <tr>
            <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Id</span>
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-accent-color uppercase tracking-wider">
              Product Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-accent-color uppercase tracking-wider">
                Product Price
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-accent-color uppercase tracking-wider">
                Quantity
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-accent-color uppercase tracking-wider">
                Total 
            </th> 
            <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Remove</span>
            </th> 
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            
          @foreach (Cart::content() as $item)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-black"> {{ $loop->iteration }} </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
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
              <select class="quantity" data-id="{{ $item->rowId }}" data-price="{{$item->model->price}}" data-productQuantity="{{ $item->model->quantity }}">
                @for ($i = 1; $i < 5 + 1 ; $i++)
                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-black">Ksh {{ $item->model->price * $item->qty}} /=</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <form action="{{ route('urban.cart.destroy',  $item->rowId) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <x-input id="delete" class="p-2 bg-red-500 rounded-md text-white shadow-md cursor-pointer" type="submit" name="remove" value="Remove"/>
                  </form>
            </td>
          </tr>
          @endforeach

          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="pt-4"><span class="text-left font-semibold text-xl text-accent-color">Total: {{ Cart::instance('default')->subtotal() }} /=</span></td>
            <td class="pt-4"><x-link-button :href="route('urban.checkout.index')">
              {{ __('Checkout') }}
            </x-link-button></td>
          </tr>
          <!-- More items... -->
        </tbody>
      </table>
    </div>
  </div>
      
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    (function(){
        const classname = document.querySelectorAll('.quantity')
        Array.from(classname).forEach(function(element) {
            element.addEventListener('change', function() {
                const id = element.getAttribute('data-id')
                const price = element.getAttribute('data-price')
                const productQuantity = element.getAttribute('data-productQuantity')
                axios.patch(`/urban-farmer/cart/${id}`, {
                    quantity: this.value,
                    price: price,
                    productQuantity: productQuantity,
                })
                .then(function (response) {
                    //console.log(response);
                    window.location.href = '{{ route('urban.cart.index') }}'
                })
                .catch(function (error) {
                     //console.log(error);
                    window.location.href = '{{ route('urban.cart.index') }}'
                });
            })
        })
    })();
</script>

</x-urban-layout>