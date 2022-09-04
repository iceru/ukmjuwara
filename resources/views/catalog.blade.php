<x-app-layout>
    @section('title')
        {{ $catalog->title }}
    @endsection
    @section('meta-content')
        Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog
        c-commerce s.id/UKMJUWARA dan katalog pada situs www.UKMJAGOWAN.id, kanal ini akan terus memproduksi katalog berkala
        dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus
        pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan
        kebutuhan UKM untuk meroket.
    @endsection

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

    @if ($catalog->ukm->count() > 0)
        <div class="catalog">
            <div class="header">
                <div class="header-image">
                    <div class="image-container ratio1x4">
                        @if ($catalog->image == '')
                            <img src="/images/header.png" alt="">
                        @else
                            <img src="{{ Storage::url('catalog-image/' . $catalog->image) }}" alt="">
                        @endif
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <div class="catalog-title">
                                    <img style="filter: brightness(0) invert(1)" src="/images/logo-primary.png"
                                        alt="">
                                    <h2>{{ str_replace('#UKMJuWAra', '', $catalog->title) }}</h2>
                                </div>
                                <div class="catalog-desc">{!! $catalog->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="body">
                <div class="most-viewed">
                    <div class="container pe-lg-0">
                        <div class="row">
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-9">
                                <div class="most-viewed-text">
                                    <h5 class="mb-3">Trending</h5>
                                </div>
                                <div id="ukm_bests">
                                    @foreach ($bests as $ukm)
                                        <div>
                                            <a href="{{ route('ukm.show', $ukm->slug) }}">
                                                <div class="ukm">
                                                    <div class="ukm-image">
                                                        <div class="ratio ratio-1x1">
                                                            @foreach ((array) json_decode($ukm->images)[0] as $image)
                                                                <img src="{{ Storage::url('ukm-image/' . $image) }}"
                                                                    alt="">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="ukm-wa">
                                                        <a href="#" class="whatsapp-click"
                                                            data-id={{ $ukm->id }} data-href={{ $ukm->whatsapp }}>
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
                                                    <small title="{{ $ukm->product }}"
                                                        class="ellipsis categories-text">
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
                        <div class="col-lg-3 d-none d-lg-block filter" id="filter_container">
                            <h3 class="mb-3">Filter</h3>

                            <div class="filter-desktop-checkbox">
                                <div class="search-ukm">
                                    {{-- <form action="{{ route('search') }}" role="search" id="search_form" action="" method="GET"> --}}
                                    <input type="text" class="form-control search-ukm" placeholder="Search"
                                        type="search" name="search-ukm" id="search_ukm">
                                    <div class="icon-search">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </div>
                                    </form>
                                </div>
                                <a href='#' class="reset-filter global mb-2">
                                    Reset Filter
                                </a>
                                <div class="category-filter mb-4">
                                    <h5 class="mb-2">Kategori Produk</h5>
                                    @foreach ($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input category-large" type="checkbox"
                                                value="{{ $category->id }}" id="category" name="category[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $category->title }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="program-filter mb-4">
                                    <h5 class="mb-2">Asal Program</h5>
                                    @foreach ($programs as $program)
                                        <div class="form-check">
                                            <input class="form-check-input program-large" type="checkbox"
                                                value="{{ $program->id }}" id="program" name="program[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $program->title }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="range-filter mb-4">
                                    <h5 class="mb-2">Rentang Harga</h5>
                                    <div class="row ">
                                        <div class="col-6">
                                            <label for="min_amount">Harga Min.</label>
                                            <input class="form-control min_amount" type="text" id="min_amount">
                                        </div>
                                        <div class="col-6">
                                            <label for="max_amount">Harga Max.</label>
                                            <input class="form-control max_amount" type="text" id="max_amount">
                                        </div>
                                        <div class="col-12 mt-3">

                                            <div id="slider-range"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="location-filter mb-4">
                                    <h5 class="mb-2">Lokasi</h5>
                                    @foreach ($states as $item)
                                        <div class="form-check">
                                            <input class="form-check-input state state-large" type="checkbox"
                                                value="{{ $item->state_name }}" id="state" name="state[]">
                                            <label class="form-check-label text-capitalize" for="flexCheckDefault">
                                                @if ($item->state_name == 'DKI JAKARTA')
                                                    DKI Jakarta
                                                @elseif ($item->state_name == 'P A P U A')
                                                    Papua
                                                @else
                                                    {{ strtolower($item->state_name) }}
                                                @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="owner-gender-filter">
                                    <h5 class="mb-2">Gender Pemilik</h5>
                                    <div class="form-check">
                                        <input class="form-check-input owner-large" type="checkbox" value="pria"
                                            id="owner_gender" name="owner_gender[]">
                                        <label class="form-check-label" for="flexCheckDefault"> Pria
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input owner-large" type="checkbox" value="wanita"
                                            id="owner_gender" name="owner_gender[]">
                                        <label class="form-check-label" for="flexCheckDefault"> Wanita
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input owner-large" type="checkbox"
                                            value="pria-wanita" id="owner_gender" name="owner_gender[]">
                                        <label class="form-check-label" for="flexCheckDefault"> Pria & Wanita
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3 mb-2 d-block d-lg-none">
                            <div class="mb-3">
                                <a class="filter-mobile mb-3" data-bs-toggle="offcanvas" href="#offcanvasExample"
                                    role="button" aria-controls="offcanvasExample">
                                    <i class="fas fa-filter" style="font-size: 1rem"></i>&nbsp;Filter
                                </a>
                            </div>
                            <div class="mb-2 category-data" hidden>
                                <b>Kategori: </b> <span class="category-selected"></span>
                            </div>
                            <div class="mb-2 program-data" hidden>
                                <b>Program: </b> <span class="program-selected"></span>
                            </div>
                            <div class="mb-2 state-data" hidden>
                                <b>Lokasi: </b> <span class="state-selected text-capitalize"></span>
                            </div>
                            <div class="mb-2 owner_gender-data" hidden>
                                <b>Gender Pemilik: </b> <span class="owner_gender-selected"></span>
                            </div>
                        </div>

                        <div class="offcanvas filter-offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                            aria-labelledby="offcanvasExampleLabel">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn button-close" data-bs-dismiss="offcanvas">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                            <h3 class="mb-3">Filter</h3>
                            <div class="filter-mobile-checkbox">
                                <div class="search-ukm">
                                    <input type="text" class="form-control search-ukm-mobile" placeholder="Search"
                                        type="search">
                                </div>
                                <div class="category-filter mb-3">
                                    <h5 class="mb-2">Kategori</h5>
                                    @foreach ($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $category->id }}" id="category" name="category[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $category->title }}
                                        </div>
                                    @endforeach
                                </div>

                                <div class="program-filter mb-3">
                                    <h5 class="mb-2">Asal Program</h5>
                                    @foreach ($programs as $program)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $program->id }}" id="program" name="program[]">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $program->title }}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="range-filter mb-4">
                                    <h5 class="mb-2">Rentang Harga</h5>
                                    <div class="row ">
                                        <div class="col-6">
                                            <label for="min_amount">Harga Min.</label>
                                            <input class="form-control min_amount" type="text" id="min_amount">
                                        </div>
                                        <div class="col-6">
                                            <label for="max_amount">Harga Max.</label>
                                            <input class="form-control max_amount" type="text" id="max_amount">
                                        </div>
                                        <div class="col-12 mt-3">

                                            <div id="slider-range-mobile"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="location-filter mb-3">
                                    <h5 class="mb-2">Lokasi</h5>
                                    @foreach ($states as $item)
                                        <div class="form-check">
                                            <input class="form-check-input state" type="checkbox"
                                                value="{{ $item->state_name }}" id="state" name="state[]">
                                            <label class="form-check-label text-capitalize" for="flexCheckDefault">
                                                @if ($item->state_name == 'DKI JAKARTA')
                                                    DKI Jakarta
                                                @elseif ($item->state_name == 'P A P U A')
                                                    Papua
                                                @else
                                                    {{ strtolower($item->state_name) }}
                                                @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="owner-gender-filter mb-3">
                                    <h5 class="mb-2">Gender Pemilik</h5>
                                    <div class="form-check">
                                        <input class="form-check-input owner" type="checkbox" value="pria"
                                            id="owner_gender" name="owner_gender[]">
                                        <label class="form-check-label" for="flexCheckDefault"> Pria
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input owner" type="checkbox" value="wanita"
                                            id="owner_gender" name="owner_gender[]">
                                        <label class="form-check-label" for="flexCheckDefault"> Wanita
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input owner" type="checkbox" value="pria-wanita"
                                            id="owner_gender" name="owner_gender[]">
                                        <label class="form-check-label" for="flexCheckDefault"> Pria & Wanita
                                    </div>
                                </div>

                                <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">
                                    Filter
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 katalog-ukm">
                            <div id="catalog">
                                @include('catalog-ukm')
                            </div>
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
        var category_filter = [];
        var state_filter = [];
        var owner_gender_filter = [];
        var program_filter = [];
        var price_range = {
            min_price: 0,
            max_price: {{ $max_price }},
        };

        var category_texts = [];
        var state_texts = [];
        var owner_gender_texts = [];
        var program_texts = [];

        var page;

        $('.reset-filter').click(function(e) {
            e.preventDefault();
            $('input[type=checkbox]').prop('checked', false);

            $(".min_amount").val(0);
            $(".max_amount").val({{ $max_price }});
            $("#slider-range").slider("values", 0, 0);
            $("#slider-range").slider("values", 1, {{ $max_price }});

            category_filter = [];
            state_filter = [];
            owner_gender_filter = [];
            program_filter = [];
            price_range = {
                min_price: 0,
                max_price: {{ $max_price }},
            }

            category_texts = [];
            state_texts = [];
            owner_gender_texts = [];
            program_texts = [];

            ajaxFilter();
        });

        $(document).ready(function() {

            $('#ukm_bests').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 567,
                    settings: {
                        slidesToShow: 2
                    }
                }, ]
            });
            $('.loading-spinner').hide();
            $('.filter-count').hide();

            desktop = $('.filter-desktop-checkbox');
            mobile = $('.filter-mobile-checkbox');

            function debounce(func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this,
                        args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            };


            $("#slider-range").slider({
                range: true,
                step: 10000,
                min: {{ $min_price }},
                max: {{ $max_price }},
                values: [{{ $min_price }}, {{ $max_price }}],
                slide: debounce(function(event, ui) {
                    $(".min_amount").val(ui.values[0]);
                    $(".max_amount").val(ui.values[1]);

                    price_range.min_price = ui.values[0];
                    price_range.max_price = ui.values[1];

                    ajaxFilter();
                }, 700)
            });

            $(".min_amount").change(function() {
                $("#slider-range-mobile").slider("values", 0, parseInt(this.value));
                $("#slider-range").slider("values", 0, parseInt(this.value));
                price_range.min_price = parseInt(this.value);

                ajaxFilter()
            });

            $(".max_amount").change(function() {
                if (parseInt(this.value) > price_range.min_price) {
                    $("#slider-range-mobile").slider("values", 1, parseInt(this.value));
                    $("#slider-range").slider("values", 1, parseInt(this.value));
                    price_range.max_price = parseInt(this.value);

                    ajaxFilter()
                }
                return
            });


            $('.whatsapp-click').click(function(e) {
                e.preventDefault();
                var ukm = $(this).attr('data-id');
                var link = $(this).attr('data-href');
                window.open(link, '_blank');

                $.ajax({
                    url: '/ukm-click/whatsapp-click',
                    type: 'GET',
                    data: {
                        ukm_id: parseInt(ukm)
                    }
                }).done(function(res) {
                    console.log('Click recorded');
                })
            });


            $("#slider-range-mobile").slider({
                range: true,
                step: 10000,
                min: {{ $min_price }},
                max: {{ $max_price }},
                values: [{{ $min_price }}, {{ $max_price }}],
                slide: debounce(function(event, ui) {
                    $(".min_amount").val(ui.values[0]);
                    $(".max_amount").val(ui.values[1]);

                    price_range.min_price = ui.values[0];
                    price_range.max_price = ui.values[1];

                    ajaxFilter();
                }, 700)
            });

            $(".min_amount").val($("#slider-range").slider("values", 0));
            $(".max_amount").val($("#slider-range").slider("values", 1));

            checkUrlParams();

            if ($(window).width() > 991) {
                mobile.detach();
            } else {
                desktop.detach();
            }
        });

        // $(window).on('hashchange',function(){
        //     if (window.location.hash) {
        //         var page = window.location.hash.replace('#', '');
        //         if (page == Number.NaN || page <= 0) {
        //             return false;
        //         } else{
        //             ajaxFilter(page);
        //         }
        //     }
        // });

        $(window).resize(function() {
            if ($(window).width() > 991) {
                mobile.detach();
                desktop.appendTo($('#filter_container'))
            } else {
                desktop.detach();
                mobile.appendTo($('.filter-offcanvas'))
            }
            $('#search_ukm').val('');
            $('.search-ukm-mobile').val('');
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            page = parseInt($(this).attr('href').split('page=')[1])
            ajaxFilter(page);
        });

        function checkUrlParams() {
            var params = (new URL(document.location)).searchParams;
            var states_params = params.get('states');
            var owner_genders_params = params.get('owner_genders');
            var categories_params = params.get('categories');
            var search_params = params.get('search');
            var programs_params = params.get('programs');
            var min_price_params = params.get('min_price');
            var max_price_params = params.get('max_price');

            if (states_params) {
                state_array = states_params.split(",");
                window[`state_filter`] = state_array;
                state_array.forEach(element => {
                    $(":checkbox[value='" + element + "']").prop("checked", "true");
                    window[`state_texts`].push($(`input[type="checkbox"][value='${element}']`).next().first().text()
                        .trim());
                });
                $('.state-selected').html(state_texts);
                $('.state-data').removeAttr('hidden')
            } else {
                state_texts = []
                $('.state-selected').html('');
                $('.state-data').attr('hidden')
            }

            if (owner_genders_params) {
                owner_genders_params = owner_genders_params.split(",");
                window[`owner_gender_filter`] = owner_genders_params;
                owner_genders_params.forEach(element => {
                    $(":checkbox[value='" + element + "']").prop("checked", "true");
                    window[`owner_gender_texts`].push($(`input[type="checkbox"][value='${element}']`).next().first()
                        .text().trim());
                });
                $('.owner_gender-selected').html(owner_gender_texts);
                $('.owner_gender-data').removeAttr('hidden')
            } else {
                owner_gender_texts = []
                $('.owner_gender-selected').html('');
                $('.owner_gender-data').attr('hidden')
            }

            if (categories_params) {
                categories_params = categories_params.split(",");
                categories_params.forEach(element => {
                    element = parseInt(element);
                    $(":checkbox[value=" + element + "]").prop("checked", "true");
                    window[`category_filter`].push(element);
                    window[`category_texts`].push($(`input[type="checkbox"][value='${element}']`).next().first()
                        .text().trim());
                });
                $('.category-selected').html(category_texts);
                $('.category-data').removeAttr('hidden')
            } else {
                category_texts = []
                $('.category-selected').html('');
                $('.category-data').attr('hidden')
            }

            if (programs_params) {
                programs_params = programs_params.split(",");
                programs_params.forEach(element => {
                    element = parseInt(element);
                    $(":checkbox[value=" + element + "]").prop("checked", "true");
                    window[`program_filter`].push(element);
                    window[`program_texts`].push($(`input[type="checkbox"][value='${element}']`).next().first()
                        .text().trim());
                });
                $('.program-selected').html(program_texts);
                $('.program-data').removeAttr('hidden')
            } else {
                program_texts = []
                $('.program-selected').html('');
                $('.program-data').attr('hidden')
            }

            if (search_params) {
                $('#search_ukm').val(search_params);
                $('.search-ukm-mobile').val(search_params);
            }

            if (min_price_params) {
                $('.min_amount').val(parseInt(min_price_params));
                $("#slider-range-mobile").slider("values", 0, parseInt(min_price_params));
                $("#slider-range").slider("values", 0, parseInt(min_price_params));
                price_range.min_price = parseInt(min_price_params);
            }

            if (max_price_params) {
                $('.max_amount').val(parseInt(max_price_params));
                $("#slider-range-mobile").slider("values", 1, parseInt(max_price_params));
                $("#slider-range").slider("values", 1, parseInt(max_price_params));
                price_range.max_price = parseInt(max_price_params);
                ajaxFilter();
            }
        }

        function get_filter(filter, data, text, add) {
            // NOTES: Harus Push nya sesuai di klik pertama. Kalau ga clicks nya bakal ga akurat
            if (add === 'add') {
                if (window[`${filter}_filter`].indexOf(data) === -1) {
                    filter === 'category' || filter === 'program' ? window[`${filter}_filter`].push(parseInt(data)) :
                        window[`${filter}_filter`]
                        .push(data);
                    window[`${filter}_texts`].push(text.trim());
                }
                ajaxFilter(page, 'record', filter);

            } else {
                window[`${filter}_filter`] = window[`${filter}_filter`].filter(function(item) {
                    if (filter === 'category' || filter === 'program') {
                        return item !== parseInt(data)
                    } else {
                        return item !== data
                    }
                })
                ajaxFilter(page)
            }


            if (window[`${filter}_texts`].length > 0) {
                var filter_text = window[`${filter}_texts`].join(', ');
                $('.' + filter + '-selected').html(filter_text);
                $('.' + filter + '-data').removeAttr('hidden')
            } else {
                $('.' + filter + '-data').attr('hidden', 'hidden')
            }

        }

        $('input[type="checkbox"], input[type="radio"]').click(function() {
            if ($(this).prop('checked') == true) {
                get_filter($(this).attr('id'), $(this).val(), $(this).next('label').text(), 'add');
            } else {
                get_filter($(this).attr('id'), $(this).val(), $(this).next('label').text(), 'remove');
            }
        });

        $('#search_ukm').on('keyup', function() {
            ajaxFilter()
        })

        $('.search-ukm-mobile').on('keyup', function() {
            ajaxFilter()
        })

        $('#floating_button').click(function(e) {
            e.preventDefault();
            var catalog = '{{ $catalog->id }}'
            window.open('https://wa.me/c/628118995115', '_blank');

            $.ajax({
                url: '/katalog-click/floating-click',
                type: 'GET',
                data: {
                    catalog: catalog
                }
            }).done(function(res) {
                console.log('Click recorded');
            })
        });

        function ajaxFilter(page, record, type) {
            var catalog = '{{ $catalog->id }}'
            states = state_filter;
            programs = program_filter;
            owner_genders = owner_gender_filter;
            categories = category_filter;
            min_price = price_range.min_price;
            max_price = price_range.max_price;

            var search = $('#search_ukm').val();
            if ($(window).width() < 991) {
                search = $('.search-ukm-mobile').val();
            }
            $('.loading-spinner').show();
            $('.ukm-content').hide();

            $.ajax({
                url: "/katalog/{{ $catalog->slug }}?page=" + page,
                type: "GET",
                datatype: 'html',
                data: {
                    states: states,
                    owner_genders: owner_genders,
                    categories: categories,
                    catalog: catalog,
                    search: search,
                    programs: programs,
                    page: page,
                    record: record,
                    type: type,
                    min_price: min_price,
                    max_price: max_price,
                }
            }).done(function(results) {
                $('#catalog').html(results);
                $('.ukm-content').show();
                $('.filter-count').show();
                $('.loading-spinner').hide();
                var url = new URL(window.location.href);
                var stateObj = {
                    states: states,
                    owner_genders: owner_genders,
                    categories: categories,
                    catalog: catalog,
                    search: search,
                    programs: programs,
                    page: page,
                    min_price: price_range.min_price,
                    max_price: price_range.max_price,
                }
                if (stateObj.states.length > 0) {
                    url.searchParams.set('states', states)
                    $('.state-selected').html(state_texts);
                    $('.state-data').removeAttr('hidden')
                } else {
                    url.searchParams.delete('states')
                    state_texts = []
                    $('.state-selected').html('');
                    $('.state-data').attr('hidden', 'hidden')
                }
                if (stateObj.owner_genders.length > 0) {
                    $('.owner_gender-selected').html(owner_gender_texts);
                    $('.owner_gender-data').removeAttr('hidden')
                    url.searchParams.set('owner_genders', owner_genders)
                } else {
                    url.searchParams.delete('owner_genders')
                    owner_gender_texts = []
                    $('.owner_gender-selected').html('');
                    $('.owner_gender-data').attr('hidden', 'hidden')
                }
                if (stateObj.categories.length > 0) {
                    url.searchParams.set('categories', categories)
                    $('.category-selected').html(category_texts);
                    $('.category-data').removeAttr('hidden')
                } else {
                    url.searchParams.delete('categories')
                    category_texts = []
                    $('.category-selected').html('');
                    $('.category-data').attr('hidden', 'hidden')
                }
                if (stateObj.search !== '')
                    url.searchParams.set('search', search)
                else
                    url.searchParams.delete('search')
                if (stateObj.programs.length > 0) {
                    $('.program-selected').html(category_texts);
                    $('.program-data').removeAttr('hidden')
                    url.searchParams.set('programs', programs)
                } else {
                    url.searchParams.delete('programs')
                    program_texts = []
                    $('.program-selected').html('');
                    $('.program-data').attr('hidden', 'hidden')
                }
                if (stateObj.page !== 1)
                    url.searchParams.set('page', page)
                else
                    url.searchParams.set('page', 1)
                if (stateObj.min_price !== "")
                    url.searchParams.set('min_price', min_price)
                else
                    url.searchParams.delete('min_price')
                if (stateObj.max_price !== "")
                    url.searchParams.set('max_price', max_price)
                else
                    url.searchParams.delete('max_price')

                history.pushState(stateObj, '', url)
            })
        };

        window.addEventListener('popstate', function(e) {
            if (!e.state) {
                return;
            }
            $('input:checkbox').prop('checked', false);
            e.state.categories.forEach(element => {
                var data = parseInt(element);
                $(":checkbox[value=" + data + "]").prop("checked", "true");
            });

            e.state.programs.forEach(element => {
                var data = parseInt(element);
                $(":checkbox[value=" + data + "]").prop("checked", "true");
            });

            e.state.owner_genders.forEach(element => {
                $(":checkbox[value='" + element + "']").prop("checked", "true");
            });

            e.state.states.forEach(element => {
                $(":checkbox[value='" + element + "']").prop("checked", "true");
            });

            $('#search_ukm').val(e.state.search);
            if ($(window).width() < 991) {
                $('.search-ukm-mobile').val(e.state.search);
            }
            var page = 1;

            if (e.state.page)
                page = e.state.page

            ajaxFilter(page);
        });
    </script>
</x-app-layout>
