<x-app-layout>
    <x-slot name="header">
        @include('includes/header')
    </x-slot>

    <div class="container p-5 mx-auto my-12 md:px-12">
        <h1 class="p-5 mb-2 text-2xl">أضف موقعًا </h1>
        <hr class="mb-5"/>
        <form class="form-contact" action="{{ route('place.store') }}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="">
                    <label for="name">{{ __('Site name') }}</label>
                    <input required type="text" class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" name="name" />
                </div>
                <div class="">
                    <label for="catg">{{ __('Select the category') }}</label>
                    <select class="w-full px-4 py-2 pr-10 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" name="category_id" >
                    @include('includes.category_list')
                    </select>
                </div>
            </div>
            <div class="">
                    <label for="overview">{{ __('About the site') }}</label>
                    <textarea type="text" class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" name="overview" id="overview" rows="5"></textarea>
            </div>
            <div class="">
                    <label for="details">{{ __('Choose an image') }}</label>
                    <input required type="file" name="image"  class="form-control">
            </div>
            <div class="mt-2">
                <div id="mapid" style="height: 350px;"></div>
            </div>
            <div class="mt-4">
                    <label for="address1"> {{ __('the address') }}</label>
                    <input required type="text" class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" name="address" id="address1"/>
            </div>
            <div class="form-group col-lg-6">
                    <label for="long">{{ __('Longitude') }}</label>
                    <input required type="number" step="any" class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" name="longitude" id="longitude" value=""/>
                </div>
            <div class="form-group col-lg-6">
                <label for="lat">{{ __('latitude') }}</label>
                <input required type="text" class="w-full px-4 py-2 mt-2 mb-6 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-400" name="latitude" id="latitude" value=""/>
            </div>
            <button type="submit" class="px-4 py-2 mt-3 text-gray-200 bg-blue-600 rounded hover:bg-blue-500 focus:outline-none">{{ __('Create') }}</button>
        </form>
    </div>
</x-app-layout>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet@2.3.3/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.js"></script>
<script type="text/javascript">
var map = L.map('mapid');
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

map.locate({setView : true, maxZoom: 10})

map.on('locationfound', function(e) {
    L.marker(e.latlng).addTo(map);
});
map.on('locationerror', function(e){
alert(e.message);
});
    var geocodeService = L.esri.Geocoding.geocodeService();

    map.on('mousedown', function(e) {
        $('#latitude').val(e.latlng.lat);
        $('#longitude').val(e.latlng.lng);
        geocodeService.reverse().latlng(e.latlng).run(function(error, result) {
            if(error){
                return;
            }

            L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
        })

});
</script>
