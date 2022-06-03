<x-app-layout>
    @section('title')
        #UKMJuWAra
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
                                <img class="image" src="{{ Storage::url('slider-image/' . $slider->image) }}"
                                    alt="{{ $slider->title }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mobile header">
                    @foreach ($sliderMobile as $slider)
                        <div>
                            <div class="image-container ratio2halfx1">
                                <img class="image" src="{{ Storage::url('slider-image/' . $slider->image) }}"
                                    alt="{{ $slider->title }}">
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
                        @foreach ($categories as $category)
                            <div class="item">
                                <div class="logo">
                                    <img src="{{ Storage::url('category-image/' . $category->image) }}">
                                </div>
                                <div class=" text">
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
                        <div>
                            <a href="/katalog/ukmjuwara-go-digital" class="see-more">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div id="ukm_bests" class="ukm-sliders">
                        @foreach ($bests as $ukm)
                            <div>
                                <a href="{{ route('ukm.show', $ukm->slug) }}">
                                    <div class="ukm">
                                        <div class="ukm-image">
                                            <div class="ratio ratio-1x1">
                                                @foreach ((array) json_decode($ukm->images)[0] as $image)
                                                    <img src="{{ Storage::url('ukm-image/' . $image) }}" alt="">
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
                <div class="best">
                    <div class="best-header">
                        <div class="best-title">
                            Trending <span>Go Global</span>
                        </div>
                        <div>
                            <a href="/katalog/ukmjuwara-go-global" class="see-more">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div id="ukm_bests_global" class="ukm-sliders">
                        @foreach ($bests_global as $ukm)
                            <div>
                                <a href="{{ route('ukm.show', $ukm->slug) }}">
                                    <div class="ukm">
                                        <div class="ukm-image">
                                            <div class="ratio ratio-1x1">
                                                @foreach ((array) json_decode($ukm->images)[0] as $image)
                                                    <img src="{{ Storage::url('ukm-image/' . $image) }}" alt="">
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
            <div class="row mb-4 ">
                <div class="col-12 col-lg-6  mb-3 mb-lg-0">
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
                                <div class="row article-item">
                                    <div class="col-3 ">
                                        <div class="article-image">
                                            <img src="{{ Storage::url('article-image/' . $article->image) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="article-title">
                                            <p>{!! $article->title !!}</p>
                                        </div>
                                        <p class="mt-2">
                                            {{ date('d F Y', strtotime($article->created_at)) }}
                                            | {{ $article->time_read }} Mins Read</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 cta-section">
                    <div class="row">
                        <div class="col-12 col-lg-5 pe-lg-0">
                            <div class="cta-img">
                                <img src="{{ Storage::url('cta-image/' . $cta->image) }}" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 ps-lg-0">
                            <div class="cta-text">
                                <div class="cta-title">
                                    <img src="" alt="">
                                    <div>
                                        <h3>{{ $cta->title }}</h3>
                                    </div>
                                </div>
                                <p>{!! $cta->description !!}</p>
                                <a href="">Baca Selengkapnya</a>
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
        </div>
    </div>

    <script>
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

            $('#ukm_bests').slick({
                infinite: true,
                slidesToShow: 6,
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

            $('#ukm_bests_global').slick({
                infinite: true,
                slidesToShow: 6,
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

            $('#categories').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 567,
                    settings: {
                        slidesToShow: 1
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

        });
    </script>
</x-app-layout>
