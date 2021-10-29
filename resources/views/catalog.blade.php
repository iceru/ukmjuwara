<x-app-layout>
    @section('title')
        {{ $catalog->title }}
    @endsection
    @section('meta-content')Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan kebutuhan UKM untuk meroket.@endsection

    <a href="https://wa.me/c/628118995115" target="_blank">
        <div class="floating-button">
            <div class="row">
                <div class="col-9">
                    Katalog Whatsapp <br>
                    UKM Indonesia
                </div>
                <div class="col-3">
                    <img src="/images/whatsapp.png" alt="">
                </div>
            </div>
        </div>
    </a>

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
                                <div class="col-12 col-lg-2 most-viewed-text">
                                    <div>
                                        <h5 class="mb-3">Banyak Dikunjungi</h5>
                                        <div class="d-none d-lg-flex">
                                            <i class="fa fa-arrow-right me-3" style="font-size: 25px" aria-hidden="true"></i>
                                            <i class="fa fa-arrow-right" style="font-size: 25px" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10">
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
                                                        <a href="{{ $ukm->whatsapp }}">
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
                            {{-- <form action="{{ route('search') }}" role="search" id="search_form" action="" method="GET"> --}}
                            <input type="text" class="form-control" placeholder="Search" type="search" id="search_ukm">
                            <div class="icon-search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            </form>
                        </div>
                        <div class="category-filter mb-4">
                            <h5 class="mb-2">Kategori Produk</h5>
                            @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input category-large" type="checkbox" value="{{ $category->id }}" id="category" name="category[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $category->title }}
                            </div>
                            @endforeach
                        </div>
                        <div class="location-filter mb-4">
                            <h5 class="mb-2">Lokasi</h5>
                            @foreach ($states as $item)
                            <div class="form-check">
                                <input class="form-check-input state state-large" type="checkbox" value="{{ $item->state_name }}" id="state" name="state[]">
                                <label class="form-check-label text-capitalize" for="flexCheckDefault" > @if ($item->state_name == 'DKI JAKARTA') DKI Jakarta @elseif ($item->state_name == 'P A P U A') Papua @else {{ strtolower($item->state_name) }} @endif
                            </div>
                            @endforeach
                        </div>
                        <div class="owner-gender-filter">
                            <h5 class="mb-2">Gender Pemilik</h5>
                            <div class="form-check">
                                <input class="form-check-input owner" type="checkbox" value="pria" id="owner_gender" name="owner_gender[]">
                                <label class="form-check-label" for="flexCheckDefault"> Pria
                            </div>
                            <div class="form-check">
                                <input class="form-check-input owner" type="checkbox" value="wanita" id="owner_gender" name="owner_gender[]">
                                <label class="form-check-label" for="flexCheckDefault"> Wanita
                            </div>
                            <div class="form-check">
                                <input class="form-check-input owner" type="checkbox" value="pria-wanita" id="owner_gender" name="owner_gender[]">
                                <label class="form-check-label" for="flexCheckDefault"> Pria & Wanita
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-2 d-block d-lg-none">
                        <div class="mb-3">
                            <a class="filter-mobile mb-3" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                <i class="fas fa-filter" style="font-size: 1rem"></i>&nbsp;Filter
                            </a>
                        </div>
                        <div class="mb-2 category-data" hidden>
                            <b>Kategori: </b> <span class="category-selected"></span>
                        </div>
                        <div class="mb-2 state-data" hidden>
                            <b>Lokasi: </b> <span class="state-selected text-capitalize"></span>
                        </div>
                        <div class="mb-2 owner_gender-data" hidden>
                            <b>Gender Pemilik: </b> <span class="owner_gender-selected"></span>
                        </div>
                    </div>

                    <div class="offcanvas filter-offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn button-close" data-bs-dismiss="offcanvas">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
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
                        <div class="category-filter mb-3">
                            <h5 class="mb-2">Kategori</h5>
                            @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category" name="category[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $category->title }}
                            </div>
                            @endforeach
                            <div class="show-filter category-more">
                                <p>Show More</p>
                            </div>
                        </div>
                        <div class="location-filter mb-3">
                            <h5 class="mb-2">Lokasi</h5>
                            @foreach ($states as $item)
                            <div class="form-check">
                                <input class="form-check-input state" type="checkbox" value="{{ $item->state_name }}" id="state" name="state[]">
                                <label class="form-check-label text-capitalize" for="flexCheckDefault" > {{ strtolower($item->state_name) }}
                            </div>
                            @endforeach
                            <div class="show-filter location-more">
                                <p>Show More</p>
                            </div>
                        </div>
                        <div class="owner-gender-filter mb-3">
                            <h5 class="mb-2">Gender Pemilik</h5>
                            <div class="form-check">
                                <input class="form-check-input owner" type="checkbox" value="pria" id="owner_gender" name="owner_gender[]">
                                <label class="form-check-label" for="flexCheckDefault"> Pria
                            </div>
                            <div class="form-check">
                                <input class="form-check-input owner" type="checkbox" value="wanita" id="owner_gender" name="owner_gender[]">
                                <label class="form-check-label" for="flexCheckDefault"> Wanita
                            </div>
                            <div class="form-check">
                                <input class="form-check-input owner" type="checkbox" value="pria-wanita" id="owner_gender" name="owner_gender[]">
                                <label class="form-check-label" for="flexCheckDefault"> Pria & Wanita
                            </div>
                        </div>
                        <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">
                            Filter
                        </button>
                    </div>
                    <div class="col-12 col-md-9 katalog-ukm" id="catalog">
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
            $('.loading-spinner').hide();

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
                        
            $(window).on('hashchange',function(){
                if (window.location.hash) {
                    var page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    } else{
                        ajaxFilter(page);
                    }
                }
            });

            $(document).ready(function(){
                $(document).on('click','.pagination a',function(event){
                    event.preventDefault();
                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');
                    var url = $(this).attr('href');
                    var page = $(this).attr('href').split('page=')[1];
                    ajaxFilter(page);
                });
            });
        
            function get_filter(filter)
            {
                var filters = [];
                var filter_selected = [];

                $('#'+filter+':checked').each(function(){
                    filters.push($(this).val());
                    filter_selected.push($(this).next('label').text());
                });

                var filter_text = filter_selected.join(', ');
                $('.'+filter+'-selected').html(filter_text);

                if (filter_selected.length > 0) {
                    $('.'+filter+'-data').removeAttr('hidden')
                } else {
                    $('.'+filter+'-data').attr('hidden', 'hidden')
                }

                return filters;
            }

            $('input[type="checkbox"], input[type="radio"]').click(function(){
                ajaxFilter();
            });

            $('#search_ukm').on('keyup',function(){
                ajaxFilter()
            })

            function getData(page) {
                // body...
                $.ajax({
                    url : '?page=' + page,
                    type : 'get',
                    datatype : 'html',
                }).done(function(data){
                    $('#tag_container').empty().html(data);
                    location.hash = page;
                }).fail(function(jqXHR,ajaxOptions,thrownError){
                    alert('No response from server');
                });
            }
            
            function ajaxFilter(page) {
                var catalog = '{{ $catalog->id }}'
                var states = get_filter('state');
                var owner_genders = get_filter('owner_gender');
                var categories = get_filter('category');
                var search = $('#search_ukm').val();
                $('.loading-spinner').show();
                $('.ukm-content').hide();

                $.ajax({
                    url:"/katalog/{{ $catalog->slug }}?page="+page,
                    type: "GET",
                    datatype : 'html',
                    data: {states: states, owner_genders: owner_genders, categories: categories, catalog: catalog, search: search}
                    }).done( function(results){
                        $('#catalog').html(results);
                        $('.ukm-content').show();
                        location.hash = page;
                        $('.loading-spinner').hide();
                })
            };
        });
            
    </script>
</x-app-layout>
