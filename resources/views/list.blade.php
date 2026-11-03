<x-app-layout>
    <x-slot name="header">
        @include('includes/header')
    </x-slot>

    <div class="py-12">
      @if(!$places->count())
        <div class="relative px-6 py-4 mx-auto text-blue-900 bg-gray-200 rounded max-w-7xl">
            <span class="inline-block mr-8 align-middle">
                 لا يوجد مواقع ضمن هذا التصنيف.
            </span>
        </div>
      @else
        <div class="grid grid-cols-1 gap-4 mx-auto max-w-7xl lg:grid-cols-2">
          <div>
             @foreach($places as $place)
             <div class="flex mb-5 bg-white">
                <div class="relative flex-none w-48">
                    <a href="{{ route('place.show', [$place->id, $place->slug]) }}">
                        <img src="{{ $place->image }}" alt="" class="absolute inset-0 object-cover w-full h-full" />
                    </a>
                </div>
                <div class="flex-auto p-6">
                    <div class="flex flex-wrap">
                        <h1 class="flex-auto text-xl font-semibold">
                        {{ $place->name }}
                        </h1>
                    </div>
                    <div class="flex mt-5 mb-4 space-x-3 text-sm font-medium">
                        <div class="flex flex-auto space-x-3">
                        {{ $place->address }}
                        </div>
                    </div>
                </div>
            </div>
             @endforeach
          </div>

          <div class="ml-3">
                {{--  <div id="mapid" style="height: 500px"></div>  --}}
            </div>
        <div>
    @endif
    </div>

</x-app-layout>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script>
    var longitude = {!! $places->pluck('longitude') !!}
    var latitude = {!! $places->pluck('latitude') !!}

    var map = L.map('mapid');

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

    var markers = [];

    for(var i=0; i < longitude.length ; i++) {
        markers.push(new L.marker([latitude[i], longitude[i]]).addTo(map));
    }

    var group = new L.featureGroup(markers).getBounds();

    map.fitBounds([
        group
    ]);
</script>
