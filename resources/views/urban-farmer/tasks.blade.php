<x-urban-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Tasks') }}
      </h2>
  </x-slot>
  
      <div class="bg-white py-4">
        
          <div class="flex flex-col mx-6 my-2">
            
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
                          Farmer
                        </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Task Title
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Task Date
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                          </th>
                          <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">View</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                          
                        @foreach ($tasks as $task)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black"> {{ $task->id }} </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($rural_farmers as $farmer)
                                @if($farmer->id == $task->rural_id)
                                <div class="text-sm text-black">{{ $farmer->name }}</div>
                                @endif
                            @endforeach
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black"> {{ $task->title }} </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $task->date}}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <x-link-button :href="route('tasks.show', $task->id)">
                              {{ __('View Task') }}
                          </x-link-button>
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