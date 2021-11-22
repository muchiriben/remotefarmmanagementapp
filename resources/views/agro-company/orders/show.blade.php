<x-agro-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __('Order Products') }}
        </h2>
    </x-slot>

    <div class="bg-white py-4">
        <div class="flex flex-col mx-6 my-2">

            <div class="flex flex-row">
                @foreach ($orders->take(1) as $order)
                <div class="text-lg text-gray-900 font-semibold p-2">Order Key:<br>  {{ $order->order}}</div>
                @foreach ($customers as $customer)
                    @if ($customer->orders()->where('orders.id', $order->id)->first())
                    <div class="text-lg text-gray-900 font-semibold p-2 mx-6">Customer Name: <br> {{ $customer->name}}</div>
                    <div class="text-lg text-gray-900 font-semibold p-2 mx-6">Customer Email:<br>  {{ $customer->email}}</div>
                    <div class="text-lg text-gray-900 font-semibold p-2 mx-6">Customer Phone:<br>  {{ $customer->phone}}</div>
                    @endif
                @endforeach
                @endforeach
            </div>  

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
                          Product Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                          Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Quantity
                          </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                          Total
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Date
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                          $total_paid = 0;
                        ?>
                      @foreach ($orders as $order)
                      <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-black"> {{ $loop->iteration }} </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-black">{{ $order->product_name}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-black">{{ $order->price}} /=</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-black">{{ $order->quantity}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $order->total}} /=</div>
                            <?php $total_paid += $order->total ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $order->created_at->toDateString() }}</div>
                          </td>
                      </tr>
                      @endforeach
          
                      <!-- More items... -->
                    </tbody>
                  </table>
                </div>
                <span class="text-2xl font-semibold text-accent-color">Total Paid: Ksh {{ $total_paid }} /=</span> <br>
                {{ $orders->links()}}
              </div>
            </div>
          </div>
        
      
      </div>
</x-agro-layout>
