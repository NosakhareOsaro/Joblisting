@props(['joblisting'])

<x-card>
  <div class="flex">
    <img class="hidden w-48 mr-6 md:block"
      src="{{$joblisting->logo ? asset('storage/' . $joblisting->logo) : asset('/images/no-image.png')}}" alt="" />
    <div>
      <h3 class="text-2xl">
        <a href="/joblistings/{{$joblisting->id}}">{{$joblisting->title}}</a>
      </h3>
      <div class="mb-4 text-xl font-bold">{{$joblisting->company}}</div>
      <x-listing-tags :tagsCsv="$joblisting->tags" />
      <div class="mt-4 text-lg">
        <i class="fa-solid fa-location-dot"></i> {{$joblisting->location}}
      </div>
    </div>
  </div>
</x-card>