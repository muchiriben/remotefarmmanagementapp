<x-rural-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('My requests') }}
      </h2>
  </x-slot>
  
  <div class="bg-neutral-color py-4">
      
    <div class="flex flex-col mx-6 my-2">

        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-secondary-color">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                      Id
                  </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                      Farmer's Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                      Farmer's Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                      Farmer's Phone
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                      Farmer's Location
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                      Request Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                      Download Contract
                  </th>
                    <th scope="col" class="px-6 py-3">
                      <span class="sr-only">Accept/Reject</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                
                  @foreach ($requests as $request)
                      
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900"> {{   $loop->iteration }} </div>
                    </td>
                    
                      @foreach ($farmers as $farmer)
                          @if ($farmer->id == $request->urban_farmer_id)
                          <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $farmer->name }}
                                </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm font-medium text-gray-900">
                              {{ $farmer->email }}
                              </div>
                          </td> 
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                            {{ $farmer->phone }}
                            </div>
                        </td> 
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm font-medium text-gray-900">
                          {{ $farmer->location }}
                          </div>
                      </td> 
                          @endif
                      @endforeach
                  
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ $request->created_at }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <div class="text-sm text-gray-900">{{ $request->status }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      @if ($request->status == "Accepted")
                         <x-link-button :href="route('download', $request->urban_farmer_id)" class="h-12 px-4 ">
                           {{ __('Contract') }}
                         </x-link-button>
                      @endif
                    </td>
                    <td class="flex justify-center items-center px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form action="{{ route('rural.requests.update', $request->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <x-input id="status" type="hidden" name="status" value="Accepted"/>
                            <x-button class="w-20 mx-2 p-2 pt-2 bg-red-600 rounded-md text-neutral-color shadow-md cursor-pointer">
                              {{ __('Accept') }}
                          </x-button>
                          </form>  

                          <form action="{{ route('rural.requests.update', $request->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <x-input id="status" type="hidden" name="status" value="Rejected"/>
                        <x-button class="w-20 p-2 bg-red-600 rounded-md text-neutral-color shadow-md cursor-pointer">
                          {{ __('Reject') }}
                      </x-button>
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
      
      </x-rural-layout>