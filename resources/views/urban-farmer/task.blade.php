<x-urban-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-accent-color leading-tight">
            {{ __($task->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mb-10">
                   <span class="text-accent-color">Description:</span>  {{ $task->description }} <br><br>
                   <span class="text-accent-color">Task Date:</span> {{ $task->date }}  <br><br>
                   <span class="text-accent-color">Upload Date:</span> {{ $task->created_at->toDateString()}}
                </div>

                <div class="grid grid-cols-3 gap-8 my-4 mx-8">
                     @foreach ($task_images as $image) 
                         <img src="{{ asset('storage/'. $image ) }}" alt="" class="object-cover h-30 w-30">
                     @endforeach
                </div>
            </div>
        </div>
    </div>
</x-urban-layout>
