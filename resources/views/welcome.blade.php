<x-app-layout>
    <x-slot name="header">
    @include('includes/header')
    </x-slot>
    <div class="container px-4 mx-auto my-12">
        <h3 class="mt-4 mb-4 text-2xl">{{ __('Most visited sites') }} </h3><hr/>
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach($places as $place)
            <div class="w-full px-1 my-1 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                <article class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <a href="{{ route('place.show', [$place->id, $place->slug]) }}">
                        <img alt="Placeholder" class="block w-full h-auto" src="{{ $place->image }}">
                    </a>
                    <header class="items-center justify-between p-2 leading-tight md:p-4">
                        <h1 class="mb-3 text-base">
                            <a class="text-black no-underline hover:underline" href="{{ route('place.show', [$place->id, $place->slug]) }}">
                                {{ $place->name }}
                            </a>
                        </h1>
                        <h4 class="text-xs"> {{ $place->address }}</h4>
                    </header>
                </article>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container px-4 mx-auto my-12">
        <h3 class="mt-4 mb-4 text-2xl">{{ __('All locations available') }} </h3><hr/>
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @foreach($allPlaces as $place)
            <div class="w-full px-1 my-1 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                <article class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <a href="{{ route('place.show', [$place->id, $place->slug]) }}">
                        <img alt="Placeholder" class="block w-full h-auto" src="{{ $place->image }}">
                    </a>
                    <header class="items-center justify-between p-2 leading-tight md:p-4">
                        <h1 class="mb-3 text-base">
                            <a class="text-black no-underline hover:underline" href="{{ route('place.show', [$place->id, $place->slug]) }}">
                                {{ $place->name }}
                            </a>
                        </h1>
                        <h4 class="text-xs"> {{ $place->address }}</h4>
                    </header>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
@include('includes.footer')

