<x-agro-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Products') }}
      </h2>
  </x-slot>
  
      <div class="bg-white py-4">
          <div class="flex flex-col mx-6 my-2">

            <x-link-button :href="route('agro.products.create')">
                {{ __('Add Product') }}
            </x-link-button>

              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-accent-color">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Id
                        </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Product Name
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Product Category
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Slug
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Price
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Description
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Delete</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                          
                        @foreach ($products as $product)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black"> {{ $loop->iteration }} </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="flex justify-center items-center h-10 w-10 rounded-full   bg-neutral-color">
                                @if ($product->product_image_path != null)
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/product_image/' .$product->id.  '/' .$product->product_image_path) }}" alt="">
                                @else
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/product_image/product_icon.png') }}" alt="">
                                @endif
                            </div>  
                              <div class="ml-4">
                                <div class="text-sm font-medium text-black">
                                {{ $product->name}}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            {{implode(',' , $product->categories()->get()->pluck('name')->toArray())}}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $product->slug}}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $product->price}}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $product->description}}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('agro.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('agro.products.destroy',  $product) }}" method="POST">
                              @csrf
                              @method("DELETE")
                              <x-input id="delete" class="p-2 bg-red-500 rounded-md text-white shadow-md cursor-pointer" type="submit" name="delete" value="DELETE"/>
                            </form>
                          </td>
                          
                        </tr>
                        @endforeach
            
                        <!-- More items... -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          
        
        </div>
      
      </x-agro-layout>