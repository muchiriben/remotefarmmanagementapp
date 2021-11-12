
@php
$classes = 
             'flex items-center justify-center w-32 bg-accent-color rounded-md my-2 px-4 py-2 border border-accent-color shadow-lg text-md font-medium leading-5 text-primary-color outline-none focus:outline-none focus:border-accent-color transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
