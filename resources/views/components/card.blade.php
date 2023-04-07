{{-- $attributes merge will allow us to extend the class in the main blade file --}}
<div {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6']) }}>
    {{-- the slot acts as a placeholder for whatever the content of the component will be --}}
    {{ $slot }}    
</div>