{{-- Alternatively you can use layout as a component instead of @extends and @section --}}
<x-layout>

{{-- call the partials from view/partials folder --}}
@include('partials._hero')
@include('partials._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

@foreach($listings as $listing)
    <x-custom-component :listing='$listing'/>
    
@endforeach

@php    
// php codes can be inserted here
@endphp

{{-- if else statement --}}
{{-- @if(count($postings) == 0)
<h1>No postings found here!</h1>
@endif --}}

{{-- unless statement --}}
@unless (count($listings) == 0)
    <h1>Listings should show here</h1>
    
@endunless

</x-layout>