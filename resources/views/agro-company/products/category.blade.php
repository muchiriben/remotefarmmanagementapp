<x-agro-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-accent-color leading-tight">
          {{ __('Product Categories') }}
      </h2>
  </x-slot>
  
      <div class="bg-white py-4">

      <div class="max-w-7lx h-5/6 pb-4 px-2 m-auto sm:px-8 lg:px-12">
      <div class="border-t-8 border-accent-color shadow-lg w-full h-5/6 m-auto py-6 px-4 sm:px-6 lg:px-8 rounded-md">
        <form method="POST" action="{{ route('agro.product-categories.store') }}">
          @csrf

          <!-- Name -->
          <div>
              <x-label for="name" :value="__('Category Name')" />

              <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
          </div>

          <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Add Category') }}
            </x-button>
        </div>

        </form>
      </div>
      </div>

        
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
                            Category Name
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
                          
                        @foreach ($categories as $category)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black"> {{ $loop->iteration }} </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-black">{{ $category->name}}</div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a href="{{ route('agro.product-categories.edit', $category ) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('agro.product-categories.destroy',  $category ) }}" method="POST">
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