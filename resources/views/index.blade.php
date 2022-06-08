<x-app-layout>
    @section('title')
        UKMJuWAra
    @endsection

    @section('meta-content')
        Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog
        c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala
        dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus
        pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan
        kebutuhan UKM untuk meroket.
    @endsection
    <div class="index">
        <div class="container">
            <div class="header-container">
                <div class="desktop header">
                    @foreach ($sliderDesktop as $slider)
                        <div>
                            <div class="image-container ratio2halfx1">
                                <a href="{{ $slider->link }}">
                                    <img class="image"
                                        src="{{ Storage::url('slider-image/' . $slider->image) }}"
                                        alt="{{ $slider->title }}">
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mobile header">
                    @foreach ($sliderMobile as $slider)
                        <div>
                            <div class="image-container ratio2halfx1">
                                <a href="{{ $slider->link }}">
                                    <img class="image"
                                        src="{{ Storage::url('slider-image/' . $slider->image) }}"
                                        alt="{{ $slider->title }}">
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="categories content mb-4">
                <div class="list-category">
                    <div class="title">
                        KATEGORI
                    </div>
                    <div class="items" id="categories">
                        @foreach ($categories_digital as $category)
                            <div class="item">
                                <div class="logo">
                                    <img src="{{ Storage::url('category-image/' . $category->image) }}">
                                </div>
                                <div class=" text">
                                    <small>GO DIGITAL</small>
                                    <p>{{ $category->title }}</p>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($categories_global as $category)
                            <div class="item">
                                <div class="logo">
                                    <img src="{{ Storage::url('category-image/' . $category->image) }}">
                                </div>
                                <div class=" text">
                                    <small>GO GLOBAL</small>
                                    <p>{{ $category->title }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="best">
                    <div class="best-header">
                        <div class="best-title">
                            Trending <span>Go Digital</span>
                        </div>
                        <div class="actions d-flex">
                            <div class="filter-btn me-3">
                                <a id="filter_global" data-bs-toggle="offcanvas" href="#offcanvas_digital" role="button"
                                    aria-controls="offcanvas_digital">Filter</a>
                            </div>
                            <a href="/katalog/ukmjuwara-go-digital" class="see-more">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div id="catalog-{{ $catalogDigital->id }}">
                        @include('index-digital')
                    </div>
                </div>
                <div class="best">
                    <div class="best-header">
                        <div class="best-title">
                            Trending <span>Go Global</span>
                        </div>
                        <div class="actions d-flex">
                            <div class="filter-btn me-3">
                                <a id="filter_global" data-bs-toggle="offcanvas" href="#offcanvas_global" role="button"
                                    aria-controls="offcanvas_global">Filter</a>
                            </div>
                            <a href="/katalog/ukmjuwara-go-global" class="see-more">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div id="catalog-{{ $catalogGlobal->id }}">
                        @include('index-global')
                    </div>
                </div>


            </div>
            <div class="row mb-4 ">
                <div class="col-12 col-lg-6  mb-4 mb-lg-0">
                    <div class="content primary article mb-0">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="title">
                                Berita Terbaru
                            </div>
                            <a href="/berita" class="see-all">
                                Lihat Semua
                                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="items">
                            @foreach ($articles as $article)
                                <a href="/berita/{{ $article->slug }}" class="row article-item">
                                    <div class="col-4 col-lg-3 ">
                                        <div class="article-image">
                                            <img src="{{ Storage::url('article-image/' . $article->image) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-8 col-lg-9">
                                        <div class="article-title">
                                            <p>{!! $article->title !!}</p>
                                        </div>
                                        <p class="mt-2 article-info">
                                            {{ date('d F Y', strtotime($article->created_at)) }}
                                            | {{ $article->time_read }} Mins Read</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 cta-section">
                    <div class="row">
                        <div class="col-12 col-lg-5 pe-lg-0">
                            <div class="cta-img">
                                <a href="{{ $cta->link }}">
                                    <img src="{{ Storage::url('cta-image/' . $cta->image) }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 ps-lg-0">
                            <div class="cta-text">
                                <div class="cta-title">
                                    <div>
                                        <h3>{{ $cta->title }}</h3>
                                    </div>
                                </div>
                                <p>{!! $cta->description !!}</p>
                                <a href="/tentang-kami">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    @if (count($sponsors) > 0)
                        <div class="content supported-by">
                            <div class="row">
                                <div class="col-12">
                                    <div class="support-title">
                                        <h5>Dipersembahkan Oleh</h5>
                                    </div>
                                    <div id="supported">
                                        @foreach ($sponsors as $sponsor)
                                            <div>
                                                <a href="{{ $sponsor->link }}">
                                                    <img src="{{ Storage::url('sponsor-image/' . $sponsor->image) }}"
                                                        alt="{{ $sponsor->title }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-12 col-lg-6">
                    @if (count($sponsors_dukung) > 0)
                        <div class="content supported-by">
                            <div class="row">
                                <div class="col-12">
                                    <div class="support-title">
                                        <h5>Didukung Oleh</h5>
                                    </div>
                                    <div id="supported_dukung">
                                        @foreach ($sponsors_dukung as $sponsor)
                                            <div>
                                                <a href="{{ $sponsor->link }}">
                                                    <img src="{{ Storage::url('sponsor-image/' . $sponsor->image) }}"
                                                        alt="{{ $sponsor->title }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="offcanvas filter-offcanvas offcanvas-start" tabindex="-1" id="offcanvas_digital"
                aria-labelledby="offcanvas_globalLabel">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn button-close" data-bs-dismiss="offcanvas">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <h3 class="mb-3">Filter Go Digital</h3>
                <div class="filter-mobile-checkbox">
                    <div class="search-ukm mb-3">
                        <input type="text" class="form-control search-ukm-mobile" id="search" placeholder="Search"
                            type="search">
                    </div>
                    <div class="category-filter mb-3">
                        <h5 class="mb-2">Kategori</h5>
                        @foreach ($categories_digital as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                    id="category" name="category[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $category->title }}
                            </div>
                        @endforeach
                    </div>

                    <div class="category-filter mb-3">
                        <h5 class="mb-2">Asal Program</h5>
                        @foreach ($programs_digital as $program)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $program->id }}"
                                    id="program" name="program[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $program->title }}
                            </div>
                        @endforeach
                    </div>
                    <div class="range-filter mb-3">
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

                                <div id="slider-range-digital"></div>
                            </div>
                        </div>

                    </div>
                    <div class="location-filter mb-3">
                        <h5 class="mb-2">Lokasi</h5>
                        @foreach ($states_digital as $item)
                            <div class="form-check">
                                <input class="form-check-input state" type="checkbox" value="{{ $item->state_name }}"
                                    id="state" name="state[]">
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
                            <input class="form-check-input owner" type="checkbox" value="pria" id="owner_gender"
                                name="owner_gender[]">
                            <label class="form-check-label" for="flexCheckDefault"> Pria
                        </div>
                        <div class="form-check">
                            <input class="form-check-input owner" type="checkbox" value="wanita" id="owner_gender"
                                name="owner_gender[]">
                            <label class="form-check-label" for="flexCheckDefault"> Wanita
                        </div>
                        <div class="form-check">
                            <input class="form-check-input owner" type="checkbox" value="pria-wanita" id="owner_gender"
                                name="owner_gender[]">
                            <label class="form-check-label" for="flexCheckDefault"> Pria & Wanita
                        </div>
                    </div>

                    <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">
                        Filter
                    </button>
                </div>
            </div>
            <div class="offcanvas filter-offcanvas offcanvas-start" tabindex="-1" id="offcanvas_global"
                aria-labelledby="offcanvas_globalLabel">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn button-close" data-bs-dismiss="offcanvas">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <h3 class="mb-3">Filter Go Global</h3>
                <div class="filter-mobile-checkbox">
                    <div class="search-ukm mb-3">
                        <input type="text" class="form-control search-ukm-mobile" name="search_global"
                            placeholder="Search" type="search">
                    </div>
                    <div class="category-filter mb-3">
                        <h5 class="mb-2">Kategori</h5>
                        @foreach ($categories_global as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                    id="category_global" name="category_global[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $category->title }}
                            </div>
                        @endforeach
                    </div>

                    <div class="category-filter mb-3">
                        <h5 class="mb-2">Asal Program</h5>
                        @foreach ($programs_global as $program)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $program->id }}"
                                    id="program_global" name="program_global[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $program->title }}
                            </div>
                        @endforeach
                    </div>
                    <div class="range-filter mb-3">
                        <h5 class="mb-2">Rentang Harga</h5>
                        <div class="row ">
                            <div class="col-6">
                                <label for="min_amount">Harga Min.</label>
                                <input class="form-control min_amount_global" type="text" id="min_amount">
                            </div>
                            <div class="col-6">
                                <label for="max_amount">Harga Max.</label>
                                <input class="form-control max_amount_global" type="text" id="max_amount">
                            </div>
                            <div class="col-12 mt-3">

                                <div id="slider-range-global"></div>
                            </div>
                        </div>

                    </div>
                    <div class="location-filter mb-3">
                        <h5 class="mb-2">Lokasi</h5>
                        @foreach ($states_global as $item)
                            <div class="form-check">
                                <input class="form-check-input state" type="checkbox"
                                    value="{{ $item->state_name }}" id="state" name="state_global[]">
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
                            <input class="form-check-input owner" type="checkbox" value="pria" id="owner_gender_global"
                                name="owner_gender_global[]">
                            <label class="form-check-label" for="flexCheckDefault"> Pria
                        </div>
                        <div class="form-check">
                            <input class="form-check-input owner" type="checkbox" value="wanita"
                                id="owner_gender_global" name="owner_gender_global[]">
                            <label class="form-check-label" for="flexCheckDefault"> Wanita
                        </div>
                        <div class="form-check">
                            <input class="form-check-input owner" type="checkbox" value="pria-wanita"
                                id="owner_gender_global" name="owner_gender_global[]">
                            <label class="form-check-label" for="flexCheckDefault"> Pria & Wanita
                        </div>
                    </div>

                    <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var category_filter = [];
        var state_filter = [];
        var owner_gender_filter = [];
        var program_filter = [];
        var min_price = null;
        var max_price = {{ $max_price_digital }};

        var category_global_filter = [];
        var state_global_filter = [];
        var owner_gender_global_filter = [];
        var program_global_filter = [];
        var min_price_global = null;
        var max_price_global = {{ $max_price_global }};

        var params = {
            record: '',
            type: '',
            catalog_id: '',
        }

        $(document).ready(function() {
            $('#supported').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [{
                    breakpoint: 567,
                    settings: {
                        slidesToShow: 2
                    }
                }, ]
            });
            $('#categories').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                variableWidth: true,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 567,
                    settings: {
                        slidesToShow: 2
                    }
                }, ]
            });
            $('#supported_dukung').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [{
                    breakpoint: 567,
                    settings: {
                        slidesToShow: 2
                    }
                }, ]
            });

            $('.header').slick({
                autoplay: true,
                autoplaySpeed: 4000,
                pauseOnHover: false,
                pauseOnFocus: false,
            });

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

            $("#slider-range-digital").slider({
                range: true,
                step: 10000,
                min: {{ $min_price_digital }},
                max: {{ $max_price_digital }},
                values: [{{ $min_price_digital }}, {{ $max_price_digital }}],
                slide: debounce(function(event, ui) {
                    $(".min_amount").val(ui.values[0]);
                    $(".max_amount").val(ui.values[1]);

                    min_price = ui.values[0];
                    max_price = ui.values[1];

                    params.catalog_id = 'catalogDigital'
                    ajaxFilter(params);
                }, 700)
            });

            $(".min_amount").val($("#slider-range-digital").slider("values", 0));
            $(".max_amount").val($("#slider-range-digital").slider("values", 1));


            $(".min_amount").change(function() {
                $("#slider-range-digital").slider("values", 0, parseInt(this.value));
                min_price = parseInt(this.value);

                params.catalog_id = 'catalogDigital'
                ajaxFilter(params)
            });

            $(".max_amount").change(function() {
                if (parseInt(this.value) > min_price) {
                    $("#slider-range-digital").slider("values", 1, parseInt(this.value));
                    max_price = parseInt(this.value);
                    min_price = min_price ? min_price : 0;

                    params.catalog_id = 'catalogDigital'
                    ajaxFilter(params)
                }
                return
            });

            $("#slider-range-global").slider({
                range: true,
                step: 10000,
                min: {{ $min_price_global }},
                max: {{ $max_price_global }},
                values: [{{ $min_price_global }}, {{ $max_price_global }}],
                slide: debounce(function(event, ui) {
                    $(".min_amount_global").val(ui.values[0]);
                    $(".max_amount_global").val(ui.values[1]);

                    min_price_global = ui.values[0];
                    max_price_global = ui.values[1];
                    params = {
                        record: '',
                        type: '',
                        catalog_id: 'catalogGlobal'
                    }

                    ajaxFilter(params);
                }, 700)
            });

            $(".min_amount_global").val($("#slider-range-global").slider("values", 0));
            $(".max_amount_global").val($("#slider-range-global").slider("values", 1));
        });

        $(".min_amount_global").change(function() {
            $("#slider-range-global").slider("values", 0, parseInt(this.value));
            min_price_global = parseInt(this.value);

            params.catalog_id = 'catalogGlobal'
            ajaxFilter(params)
        });

        $(".max_amount_global").change(function() {
            if (parseInt(this.value) > min_price_global) {
                $("#slider-range-global").slider("values", 1, parseInt(this.value));
                max_price_global = parseInt(this.value);
                min_price_global = min_price_global ? min_price_global : 0;

                params.catalog_id = 'catalogGlobal'
                ajaxFilter(params)
            }
            return
        });

        function get_filter(filter, data, text, add) {
            const catalog_id = filter.includes('global') ? 'catalogGlobal' : 'catalogDigital';
            // NOTES: Harus Push nya sesuai di klik pertama. Kalau ga clicks nya bakal ga akurat
            if (add === 'add') {
                if (window[`${filter}_filter`].indexOf(data) === -1) {
                    filter === 'category' || filter === 'program' ? window[`${filter}_filter`].push(parseInt(data)) :
                        window[`${filter}_filter`]
                        .push(data);
                }
                params = {
                    record: 'record',
                    type: filter,
                    catalog_id: catalog_id
                }
                ajaxFilter(params);

            } else {
                window[`${filter}_filter`] = window[`${filter}_filter`].filter(function(item) {
                    if (filter === 'category' || filter === 'program') {
                        return item !== parseInt(data)
                    } else {
                        return item !== data
                    }
                })
                params = {
                    record: '',
                    type: '',
                    catalog_id: catalog_id
                }
                ajaxFilter(params)
            }

        }

        $('input[type="checkbox"], input[type="radio"]').click(function() {
            if ($(this).prop('checked') == true) {
                get_filter($(this).attr('id'), $(this).val(), $(this).next('label').text(), 'add');
            } else {
                get_filter($(this).attr('id'), $(this).val(), $(this).next('label').text(), 'remove');
            }
        });

        function ajaxFilter(params) {
            var catalog = params.catalog_id === 'catalogGlobal' ? `{{ $catalogGlobal->id }}` :
                `{{ $catalogDigital->id }}`
            states = state_filter;
            programs = program_filter;
            owner_genders = owner_gender_filter;
            categories = category_filter;
            min_price = min_price;
            max_price = max_price;

            states_global = state_global_filter;
            programs_global = program_global_filter;
            owner_genders_global = owner_gender_global_filter;
            categories_global = category_global_filter;
            min_price_global = min_price_global;
            max_price_global = max_price_global;

            var search = $('#search').val();
            var search_global = $('#search_global').val();


            $('.loading-spinner').show();
            $('.ukm-content').hide();

            $.ajax({
                url: "/",
                type: "GET",
                datatype: 'html',
                data: {
                    states: states,
                    catalog: catalog,
                    owner_genders: owner_genders,
                    categories: categories,
                    search: search,
                    programs: programs,
                    record: params.record,
                    type: params.type,
                    min_price: min_price,
                    max_price: max_price,
                    states_global: states_global,
                    owner_genders_global: owner_genders_global,
                    categories_global: categories_global,
                    search_global: search_global,
                    programs_global: programs_global,
                    min_price_global: min_price_global,
                    max_price_global: max_price_global,
                }
            }).done(function(results) {
                $('#catalog-' + catalog).html(results);
            })
        };
    </script>
</x-app-layout>
