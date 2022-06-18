<x-layout>
    @if (!Auth::check())
      @include('partials._hero')
    @endif
  
    @include('partials._search')
  
    <div class="gap-4 mx-4 space-y-4 lg:grid lg:grid-cols-2 md:space-y-0">
  
      @unless(count($joblistings) == 0)
  
      @foreach($joblistings as $joblisting)
      <x-listing-card :joblisting="$joblisting" />
      @endforeach
  
      @else
      <p>No Job listings found</p>
      @endunless
  
    </div>
  
    <div class="p-4 mt-6">
      {{$joblistings->links()}}
    </div>
  </x-layout>