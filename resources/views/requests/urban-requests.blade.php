<x-urban-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('My Requests') }}
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
                      Request Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                        Status
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
                          @if ($farmer->id == $request->rural_farmer_id)
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
                          @endif
                      @endforeach
                  
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ $request->created_at }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      <div class="text-sm text-gray-900">{{ $request->status }}</div>
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
      
      </x-urban-layout>