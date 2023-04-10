{{-- checks if there is a message passed here --}}

{{-- imported a minimal js framework called alpinejs to control the fadeout from the frontend --}}
@if(session()->has('message'))
    <div x-data="{show: true}" 
        x-init="setTimeout(() => show = false, 3000 )" 
        x-show="show" 
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3"
        x-transition:enter.duration.500ms
        x-transition:leave.duration.400ms
    >
        <p>
            {{ session('message') }}
        </p>        
    </div>
@endif