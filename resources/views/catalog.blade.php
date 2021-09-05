<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection

    <div class="catalog">
        <div class="header">
            <div class="header-image">
                <div class="image-container ratio1x4">
                    @if ($catalog->image == '')
                    <img src="/images/header.png" alt="">
                    @else
                    <img src="{{ Storage::url('catalog-image/'.$catalog->image) }}" alt="">
                    @endif
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <h2>{{ $catalog->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="body">
            <div class="most-viewed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-2 most-viewed-text">
                                    <div>
                                        <h5 class="mb-3">Banyak Dikunjungi</h5>
                                        <div>
                                            <i class="fa fa-arrow-right me-3" style="font-size: 25px" aria-hidden="true"></i>
                                            <i class="fa fa-arrow-right" style="font-size: 25px" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div id="ukm_bests">
                                        @foreach ($bests as $ukm)
                                        <div>
                                            <a href="{{ route('ukm.show', $ukm->slug) }}">
                                                <div class="ukm">
                                                    <div class="ukm-image">
                                                        <div class="ratio ratio-1x1">
                                                            @foreach ((array)json_decode($ukm->images)[0] as $image)
                                                            <img src="{{ Storage::url('ukm-image/'.$image) }}" alt="">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="ukm-wa">
                                                        <a href="https://wa.me/{{ $ukm->whatsapp }}">
                                                            <img src="/images/whatsapp.png" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="{{ route('ukm.show', $ukm->slug) }}">
                                                <div class="ukm-title mt-2">
                                                    <p title="{{ $ukm->title }}">{{ $ukm->title }}</p>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 filter">
                        <h3 class="mb-3">Filter</h3>
                        <div class="search-ukm">
                            <form action="{{ route('search') }}" role="search" id="search_form" action="" method="GET">
                            <input type="text" class="form-control" placeholder="Search" type="search" name="search_query">
                            <div class="icon-search">
                                <button type="submit" value="" class="btn">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                            </form>
                        </div>
                        <div class="category-filter mb-4">
                            <h5 class="mb-2">Kategori</h5>
                            @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="cat{{ $category->id }}" name="cat[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $category->title }}
                            </div>
                            @endforeach
                        </div>
                        <div class="location-filter">
                            <h5 class="mb-2">Lokasi</h5>
                            @foreach ($cities as $item)
                            <div class="form-check">
                                <input class="form-check-input city" type="checkbox" value="{{ $item->city_name }}" id="city" name="city[]">
                                <label class="form-check-label text-capitalize" for="flexCheckDefault" > {{ strtolower($item->city_name) }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9 katalog-ukm" id="catalog">
                        @include('catalog-ukm')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#ukm_bests').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 567,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });
            // var states=[];
            // var cities=[];

            // $('.city').each(function() { 
            //     var state = ($(this).attr('state-id'));
            //     var city = ($(this).val());
            //     $.ajax({
            //         url:"{{url('getCity')}}?state_id=" + state,
            //         success: function (res) {
            //             if (res) {
            //                 $.each(res, function(i, val){
            //                     if(val.id == city)
            //                         $('#city_label_'+city).html(val.nama.toLowerCase());

            //                     $('#city_label_'+city).css('text-transform', 'capitalize');
            //                 })
            //             }
            //         },
            //     })
            // });
            $('input[name="cat[]"]').on('change', function (e) {
                var categories = [];
                var catalog = '{{ $catalog->id }}'
                $('input[name="cat[]"]:checked').each(function(){
                    categories.push($(this).val());
                });

                $.ajax({
                    url:"/katalog/filter",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {categories: categories, catalog: catalog}
                    }).done( function(results){
                        $('#catalog').html(results);
                    })
                });
            });

            $('input[name="city[]"]').on('change', function (e) {
                var cities = [];
                var catalog = '{{ $catalog->id }}'

                $('input[name="city[]"]:checked').each(function(){
                    cities.push($(this).val());
                });

                $.ajax({
                    url:"/katalog/filter",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {cities: cities, catalog: catalog}
                    }).done( function(results){
                        $('#catalog').html(results);
                })
            });
    </script>
</x-app-layout>
