<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection
    @section('meta-content')Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan kebutuhan UKM untuk meroket.@endsection

    <div id="floating_button">
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
    </div>

    @if($catalog->ukm->count() > 0)
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
                            <h2 class="catalog-title">{{ $catalog->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="body">
            <div class="most-viewed">
                <div class="container pe-lg-0">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <div class="most-viewed-text">
                                <h5 class="mb-3">Banyak Dikunjungi</h5>
                            </div>
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
                                        <div class="ukm-title mt-3">
                                            <h5 title="{{ $ukm->title }}">{{ $ukm->title }}</h5>
                                        </div>
                                        <div class="ukm-desc">
                                            <small title="{{ $ukm->product }}" class="ellipsis categories-text">
                                                @foreach ($ukm->categories as $item)
                                                    <span>{{ $item->title }}</span>
                                                @endforeach
                                            </small>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 filter" id="filter_container">
                        <h3 class="mb-3">Filter</h3>
                        <div class="filter-desktop-checkbox">
                            <div class="search-ukm">
                                {{-- <form action="{{ route('search') }}" role="search" id="search_form" action="" method="GET"> --}}
                                <input type="text" class="form-control search-ukm" placeholder="Search" type="search" name="search-ukm" id="search_ukm">
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
                                    <input class="form-check-input owner-large" type="checkbox" value="pria" id="owner_gender" name="owner_gender[]">
                                    <label class="form-check-label" for="flexCheckDefault"> Pria
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input owner-large" type="checkbox" value="wanita" id="owner_gender" name="owner_gender[]">
                                    <label class="form-check-label" for="flexCheckDefault"> Wanita
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input owner-large" type="checkbox" value="pria-wanita" id="owner_gender" name="owner_gender[]">
                                    <label class="form-check-label" for="flexCheckDefault"> Pria & Wanita
                                </div>
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
                        <div class="filter-mobile-checkbox">
                            <div class="search-ukm">
                                <input type="text" class="form-control search-ukm-mobile" placeholder="Search" type="search" >
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
                            </div>
                            <div class="location-filter mb-3">
                                <h5 class="mb-2">Lokasi</h5>
                                @foreach ($states as $item)
                                <div class="form-check">
                                    <input class="form-check-input state" type="checkbox" value="{{ $item->state_name }}" id="state" name="state[]">
                                    <label class="form-check-label text-capitalize" for="flexCheckDefault" > @if ($item->state_name == 'DKI JAKARTA') DKI Jakarta @elseif ($item->state_name == 'P A P U A') Papua @else {{ strtolower($item->state_name) }} @endif
                                </div>
                                @endforeach
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
                    </div>
                    <div class="col-12 col-md-9 katalog-ukm" id="catalog">
                        @include('catalog-ukm')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="d-flex justify-content-center p-5">
        <h1 class="primary-color">Coming Soon!</h1>
    </div>
    @endif
    <script>
        $(document).ready(function(){
            $('#ukm_bests').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
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
            desktop = $('.filter-desktop-checkbox');
            mobile = $('.filter-mobile-checkbox');

            checkUrlParams();
            
            if($(window).width() > 641) {
                mobile.detach();
            } else {
                desktop.detach();
            }
        });

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

        $(window).resize(function() {
            if($(window).width() > 641) {
                mobile.detach();
                desktop.appendTo($('#filter_container'))
            } else {
                desktop.detach();
                mobile.appendTo($('.filter-offcanvas'))
            }
            $('#search_ukm').val('');
            $('.search-ukm-mobile').val('');
        });

        $(document).on('click','.pagination a',function(event){
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            var page = parseInt($(this).attr('href').split('page=')[1])
            ajaxFilter(page);
        });

        function checkUrlParams() {
            var params = (new URL(document.location)).searchParams;
            var states_params = params.get('states');
            var owner_genders_params = params.get('owner_genders');
            var categories_params = params.get('categories');
            var search_params = params.get('search');

            if (states_params) {
                state_array = states_params.split(",");
                state_array.forEach(element => {
                    $(":checkbox[value='"+element+"']").prop("checked","true");
                });
            }

            if (owner_genders_params) {
                owner_genders_params = owner_genders_params.split(",");
                owner_genders_params.forEach(element => {
                    $(":checkbox[value='"+element+"']").prop("checked","true");
                });
            }

            if (categories_params) {
                categories_params = categories_params.split(",");
                categories_params.forEach(element => {
                    element = parseInt(element);
                    $(":checkbox[value="+element+"]").prop("checked","true");
                });
            }

            if(search_params) {
                $('#search_ukm').val(search_params);
                $('.search-ukm-mobile').val(search_params);
            }
        }

        function get_filter(filter) {
            // NOTES: Harus Push nya sesuai di klik pertama. Kalau ga clicks nya bakal ga akurat
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

        $('.search-ukm-mobile').on('keyup',function(){
            ajaxFilter()
        })

        $('#floating_button').click(function (e) { 
            e.preventDefault();
            var catalog = '{{ $catalog->id }}'
            window.open('https://wa.me/c/628118995115', '_blank');

            $.ajax({
                url: '/katalog-click/floating-click',
                type: 'GET',
                data: {catalog: catalog}
            }).done(function(res) {
                console.log('Click recorded');
            })
        });
            
        function ajaxFilter(page) {
            var catalog = '{{ $catalog->id }}'
            states = get_filter('state');
            owner_genders = get_filter('owner_gender');
            categories = get_filter('category');
            var search = $('#search_ukm').val();
            if ($(window).width() < 645) {
                search = $('.search-ukm-mobile').val();
            }
            $('.loading-spinner').show();
            $('.ukm-content').hide();

            $.ajax({
                url:"/katalog/{{ $catalog->slug }}?page="+page,
                type: "GET",
                datatype : 'html',
                data: {states: states, owner_genders: owner_genders, categories: categories, catalog: catalog, search: search, page: page}
                }).done( function(results){
                    $('#catalog').html(results);
                    $('.ukm-content').show();
                    $('.loading-spinner').hide();

                    var url = new URL(window.location.href);
                    var stateObj = {
                        states: states, owner_genders: owner_genders, categories: categories, catalog: catalog, search: search, page: page
                    }

                    if(stateObj.states.length > 0 )
                        url.searchParams.set('states', states)
                    else 
                        url.searchParams.delete('states')
                    if(stateObj.owner_genders.length > 0 )
                        url.searchParams.set('owner_genders', owner_genders)
                    else 
                        url.searchParams.delete('owner_genders')
                    if(stateObj.categories.length > 0 )
                        url.searchParams.set('categories', categories)
                    else 
                        url.searchParams.delete('categories')
                    if(stateObj.search !== '' )
                        url.searchParams.set('search', search)
                    else 
                        url.searchParams.delete('search')

                    history.pushState(stateObj, '', url)
            })
        };

        window.addEventListener('popstate', function (e) {
            if (!e.state) {
                return;
            }
            $('input:checkbox').prop('checked',false);
            e.state.categories.forEach(element => {
                var data = parseInt(element);
                $(":checkbox[value="+data+"]").prop("checked","true");
            });

            e.state.owner_genders.forEach(element => {
                $(":checkbox[value='"+element+"']").prop("checked","true");
            });

            e.state.states.forEach(element => {
                $(":checkbox[value='"+element+"']").prop("checked","true");
            });

            $('#search_ukm').val(e.state.search);
            if ($(window).width() < 645) {
                $('.search-ukm-mobile').val(e.state.search);
            }
            var page = 1;

            if(e.state.page)
                page = e.state.page

            ajaxFilter(page);
        });
            
    </script>
</x-app-layout>
