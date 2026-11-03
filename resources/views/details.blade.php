<x-app-layout>
    <x-slot name="header">
        @include('includes.header')
    </x-slot>
    <div class="py-12">
        <div class="p-5 mt-5 text-center">
            <h1 class="mb-2 text-2xl">{{ $place->name }}</h1>
            <small>{{ $place->address }}</small>
        </div>
        <div class="grid grid-cols-1 gap-5 mx-auto mt-5 max-w-7xl lg:grid-cols-3">
            <div class="col-span-2 p-5 bg-white rounded shadow-lg">
                <div class="">
                    <h1 class="mb-4 text-2xl">{{ __('About the site') }}</h1>
                    <p class="text-sm">{{ $place->overview }}</p>
                </div>
                <div class="mt-5 ">
                    <h3 class="mb-4 text-2xl">الموقع</h3>
                    <div id="mapid" style="height: 350px;"></div>
                    <input id="name" type="hidden" value="{{ $place->name }}">
                    <input id="latitude" type="hidden" value="{{ $place->latitude }}">
                    <input id="longitude" type="hidden" value="{{ $place->longitude }}">
                </div>
            </div>
            <div class="p-4 bg-white rounded shadow-lg h-52">
                <div class="p-5 bg-white shadow-sm">
                    <h3>{{ $place->user->name }}</h3>
                    <p></p>
                    <ul class="mt-3">
                        <li><i class="fa fa-envelope"></i> &nbsp;&nbsp;{{ $place->user->email }} </li>
                    </ul>
                </div>
                <hr/>
                <div class="p-3">
                    @guest
                    <div class="button-container">
                        <a href="{{ route('login') }}" class="p-1 ml-3 text-xs text-teal-500 border border-teal-500 rounded hover:bg-teal-500 hover:text-gray-100">
                            <span class=""><i class="fa 'fa-bookmark' : 'fa-bookmark-o' }} fa-lg"></i></span> علامة مرجعية
                        </a>
                    </div>
                    @endguest
                    @auth
                    @auth
                    <div class="button-container">
                        <a href="{{ route('bookmark', $place->id) }}" class="p-1 ml-3 text-xs text-teal-500 border border-teal-500 rounded hover:bg-teal-500 hover:text-gray-100">
                            <span class=""><i class="fa {{ Auth::user()->alreadyBookmarked($place->id) ? 'fa-bookmark' : 'fa-bookmark-o' }} fa-lg"></i></span> علامة مرجعية
                        </a>
                        <a href="{{ route('report.create') }}" class="p-1 text-xs text-red-500 border border-red-500 rounded hover:bg-red-500 hover:text-gray-200">
                            <span class=""><i class="fa fa-warning"></i></span>إبلاغ موقع مكرر
                        </a>
                    </div>
                    @endauth

                    @endif

                </div>
            </div>
            <div class="grid grid-cols-1 col-span-2 p-5 bg-white rounded shadow-lg lg:grid-cols-3">
                <div class="text-center v_line">
                    <h1>
                        {{ round($total,1) }}
                    </h1>
                    <div class="rating">
                        <h3>
                            @for($i=1; $i<=5; $i++)
                            @if($i <= $total)
                            <span class="fa fa-star" aria-hidden="true"></span>
                            @elseif($i == round($total))
                            <span class="fas fa-star-half-alt fa-flip-horizontal" aria-hidden="true"></span>
                            @else
                            <span class="fa fa-star-o" aria-hidden="true"></span>
                            @endif
                        @endfor
                        </h3>
                    </div>
                    <div>
                        <span>{{ __('Number of reviews') }}</span>{{ $place->reviews_count }}

                    </div>
                </div>
                <div class="col-span-2 mr-2">
                    <div class="text-right">
                        <span class=""></span>{{ __('service') }}
                    </div>
                    <div class="text-right">
                        <progress value="{{$service_rating}}" class="w-full" max="5" title="{{ round($service_rating,1) }}"></progress>
                    </div>
                    <!-- end 4 -->
                    <div class="text-right">
                        <span class=""></span>{{ __('quality') }}
                    </div>
                    <div class="text-right">
                        <progress value="{{ $quality_rating }}" class="w-full" max="5" title="{{ round($quality_rating,1) }}"></progress>
                    </div>
                    <!-- end 3 -->
                    <div class="text-right">
                        <span class=""></span>{{ __('cleanliness') }}
                    </div>
                    <div class="">
                        <progress value="{{ $cleanliness_rating }}" class="w-full" max="5" title="{{ round($cleanliness_rating,1) }}"></progress>
                    </div>
                    <!-- end 2 -->
                    <div class="text-right">
                        <span class=""></span>{{ __('price') }}
                    </div>
                    <div class="">
                        <progress value="{{ $pricing_rating }}" class="w-full" max="5" title="{{ round($pricing_rating,1) }}"></progress>
                    </div>
                    <!-- end 1 -->
                </div>
                <!-- end row -->
            </div>
            <div class="col-span-2 p-5 bg-white rounded shadow-lg">
                @foreach($place->reviews as $review)
                <div class="p-4 text-right bg-white shadow-sm row">
                    <div class="review-block">
                        <div class="grid grid-cols-3 p-5">
                            <div class="text-sm" style="flex: flex;align-items:center">
                                <img style="width:100px"  class="img-rounded" src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}" />
                            </div>
                            <div class="col-span-2">
                                <div class="text-blue-400"><a href="#">{{ $review->user->name }}</a></div>
                                <div class="review-block-date">{{ $review->created_at->diffForHumans() }}</div>
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->avgRating())
                                    <span class="fa fa-star" aria-hidden="true"></span>
                                    @elseif($i == round($review->avgRating()))
                                    <span class="fa fa-star-half-o fa-flip-horizontal" aria-hidden="true"></span>
                                    @else
                                    <span class="fa fa-star-o" aria-hidden="true"></span>
                                    @endif
                                    @endfor
                                </div>
                                <div class="review-block-description">{{ $review->review }}</div>
                                <div class="mt-1 text-xs text-gray-600 text-muted" style="font-size: 0.8rem;">
                                    <button id="like" type="button" data-id="{{ $review->id }}" class="p-1 text-xs border rounded like">
                                        @auth
                                            {!! Auth::user()->alreadyliked($review->id)
                                                ? '<i class="fa fa-thumbs-down"></i><small> ' . __('Unlike') . '</small>'
                                                : '<i class="fa fa-thumbs-up"></i><small> ' . __('like') . '</small>' !!}
                                        @else
                                            <i class="fa fa-thumbs-up"></i><small> {{ __('like') }} </small>
                                        @endauth
                                        <span>{{ $review->likes_count }}</span>
                                    </button>

                                </div>
                                <div class="mt-3">
                                </div>
                    </div>
                </div>
            </div>
            <hr />
        </div>
        @endforeach
    </div>
    <div  id="review-div" class="col-span-2 p-5 bg-white rounded shadow-lg">
        @if (session('success'))
        <x-alert :color="'blue'" :message="session('success')"/>
    @elseif(session('fail'))
        <x-alert :color="'red'" :message="session('fail')"/>
    @endif

                <h3 class="mt-3 mb-4">{{ __('Add review') }}</h3>
                <hr/>
                <form class="form-contact" action="{{ route('review.store') }}" method="post">
                    @csrf
                    <div class="grid grid-cols-2 mt-5">
                        <div class="">
                            <div class="float-right rating" >
                                <h5>{{ __('service') }}</h5>
                                <input type="radio" id="rating_service1" name="service_rating" value="5" /><label for="rating_service1" title="ممتاز"></label>
                                <input type="radio" id="rating_service2" name="service_rating" value="4" /><label for="rating_service2" title="جيد جدًا"></label>
                                <input type="radio" id="rating_service3" name="service_rating" value="3" /><label for="rating_service3" title="متوسط"></label>
                                <input type="radio" id="rating_service4" name="service_rating" value="2" /><label for="rating_service4" title="سيء"></label>
                                <input type="radio" id="rating_service5" name="service_rating" value="1" /><label for="rating_service5" title="سيء للغاية"></label>
                            </div>
                        </div>
                        <div class="">
                            <div class="float-right rating">
                                <h5>{{ __('quality') }}</h5>
                                <input type="radio" id="rating_quality1" name="quality_rating" value="5" /><label for="rating_quality1" title="ممتاز"></label>
                                <input type="radio" id="rating_quality2" name="quality_rating" value="4" /><label for="rating_quality2" title="جيد جدًا"></label>
                                <input type="radio" id="rating_quality3" name="quality_rating" value="3" /><label for="rating_quality3" title="متوسط"></label>
                                <input type="radio" id="rating_quality4" name="quality_rating" value="2" /><label for="rating_quality4" title="سيء"></label>
                                <input type="radio" id="rating_quality5" name="quality_rating" value="1" /><label for="rating_quality5" title="سيء للغاية"></label>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="">
                            <div class="float-right rating">
                                <h5>{{ __('cleanliness') }}</h5>
                                <input type="radio" id="rating_cleanliness1" name="cleanliness_rating" value="5" /><label for="rating_cleanliness1" title="ممتاز"></label>
                                <input type="radio" id="rating_cleanliness2" name="cleanliness_rating" value="4" /><label for="rating_cleanliness2" title="جيد جدًا"></label>
                                <input type="radio" id="rating_cleanliness3" name="cleanliness_rating" value="3" /><label for="rating_cleanliness3" title="متوسط"></label>
                                <input type="radio" id="rating_cleanliness4" name="cleanliness_rating" value="2" /><label for="rating_cleanliness4" title="سيء"></label>
                                <input type="radio" id="rating_cleanliness5" name="cleanliness_rating" value="1" /><label for="rating_cleanliness5" title="سيء للغاية"></label>
                            </div>
                        </div>
                        <div class="">
                            <div class="float-right rating">
                                <h5>{{ __('price') }}</h5>
                                <input type="radio" id="rating_price1" name="pricing_rating" value="5" /><label for="rating_price1" title="ممتاز"></label>
                                <input type="radio" id="rating_price2" name="pricing_rating" value="4" /><label for="rating_price2" title="جيد جدًا"></label>
                                <input type="radio" id="rating_price3" name="pricing_rating" value="3" /><label for="rating_price3" title="متوسط"></label>
                                <input type="radio" id="rating_price4" name="pricing_rating" value="2" /><label for="rating_price4" title="سيء"></label>
                                <input type="radio" id="rating_price5" name="pricing_rating" value="1" /><label for="rating_price5" title="سيء للغاية"></label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="form-group">
                            <input class="form-control" name="place_id" id="place_id" type="hidden" value="{{ $place->id }}">
                            <textarea class="w-full border" name="review" id="review" cols="30" rows="9"></textarea>
                        </div>
                        @error('review')
                        <x-alert :color="'red'" message="{{ $message }}" />
                    @enderror

                        <button type="submit" class="px-4 py-2 mt-3 text-gray-200 bg-blue-600 rounded hover:bg-blue-500 focus:outline-none">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" ></script>
<script type="text/javascript">
    $(function(){
        $('button.like').on('click', function() {
            var review = $(this).data('id');
            var likebtn = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:"{{ route('like.store') }}",
                type:'POST',
                data:{'review_id' : review}
            }).done(function(data){
                if(data) {
                    $.trim(likebtn.find('small').text()) == 'أعجبني' ? showUnLike(data) : showlike(data);
                } else {
                    alert('لا يمكنك الإعجاب بهذه المراجعة');
                }
            });

            function showUnLike(count) {
                likebtn.html('<li class="fa fa-thumbs-down"></li> <small>' + 'إلغاء الإعجاب' + '</small>' + count);
            }

            function showlike(count) {
                likebtn.html('<li class="fa fa-thumbs-up"></li> <small>' + 'أعجبني' +'</small>'+ count );
            }

        })
    });

    var longitude = $('#longitude').val();
    var latitude = $('#latitude').val();

    var map = L.map('mapid', {
        center : [latitude , longitude],
        zoom : 13
    });

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([latitude, longitude]).bindPopup($('#name').val()).addTo(map).openPopup();
</script>
</x-app-layout>

