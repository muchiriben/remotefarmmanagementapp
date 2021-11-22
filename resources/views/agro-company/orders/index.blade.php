<x-agro-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="bg-white py-4">

        <div class="flex flex-col mx-6 my-2">

            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mb-4 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-accent-color">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                          Id
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Order Key
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Date
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Status
                       </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Update Status </span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">View </span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                      @foreach ($orderKeys as $orderKey)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-black"> {{ $loop->iteration }} </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $orderKey->order_key }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-black">{{ $orderKey->created_at->toDateString() }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-black">{{ $orderKey->status}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('order-keys.update', $orderKey->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <x-input id="status" type="hidden" name="status" value="Delivered"/>
                                <x-button class=" bg-accent-color rounded-md text-neutral-color shadow-md cursor-pointer">
                                  {{ __('Delivered') }}
                              </x-button>
                              </form>  
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-link-button :href="route('orders.show', $orderKey->order_key)">
                                {{ __('View') }}
                            </x-link-button>
                        </td>
                      </tr>
                      @endforeach
          
                      <!-- More items... -->
                    </tbody>
                  </table>
                </div>
                {{ $orderKeys->links()}}
              </div>
            </div>
          </div>
        
      
      </div>
</x-agro-layout>
