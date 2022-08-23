<x-app-layout>
    @section('title')
        {{ $ukm->title }}
    @endsection
    @section('meta-content')
        Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog
        c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala
        dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus
        pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan
        kebutuhan UKM untuk meroket.
    @endsection

    <div class="ukm-page">
        <div class="container container-padding">
            <div class="row main-product">
                <div class="col-12 col-md-5 ukm-image mb-5">
                    <div id="sliders" class="mb-3">
                        @foreach ((array) json_decode($ukm->images) as $image)
                            <div>
                                <div class="image-container ratio1x1">
                                    <img src="{{ Storage::url('ukm-image/' . $image) }}" alt="{{ $ukm->title }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="carousel">
                        @foreach ((array) json_decode($ukm->images) as $image)
                            <div>
                                <div class="image-container ratio1x1">
                                    <img src="{{ Storage::url('ukm-image/' . $image) }}" alt="{{ $ukm->title }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-7 ">
                    <div class="container-ukm">
                        <div class="detail-head">
                            <h1 class="mb-4 primary-color">{{ $ukm->title }}</h1>
                            <div class="row description">

                                <div class="col-12 col-lg-6">
                                    <div class="desc-item">
                                        <h6 class="mb-2">Produk</h6>
                                        <p>{{ $ukm->product }}</p>
                                    </div>

                                    @if (!str_contains(strtolower($ukm->catalog->title), 'global'))
                                        <div class="desc-item">
                                            <h6 class="mb-2">Kategori</h6>
                                            <p class="categories-text">
                                                @foreach ($ukm->categories as $item)
                                                    <span>{{ $item->title }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    @endif


                                    @if ($ukm->program_id)
                                        <div class="desc-item">
                                            <h6 class="mb-2">Asal Program</h6>
                                            <p>{{ $ukm->program->title }}</p>
                                        </div>
                                    @endif

                                    @if ($ukm->permission)
                                        <div class="desc-item">
                                            <h6 class="mb-2">Perizinan dan Sertifikasi</h6>
                                            <p>{!! $ukm->permission !!}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="desc-item">
                                        <h6 class="mb-2">Lokasi</h6>
                                        @if ($ukm->address)
                                            <p class="text-capitalize">{{ $ukm->address }}, {{ $state_name }} </p>
                                        @endif
                                    </div>

                                    @if ($ukm->operational_hours && $ukm->operational_hours_end)
                                        <div class="desc-item">
                                            <h6 class="mb-2">Jam Operasional</h6>
                                            <p>{{ $ukm->operational_hours }} - {{ $ukm->operational_hours_end }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($ukm->capacity)
                                        <div class="desc-item">
                                            <h6 class="mb-2">Kapasitas Produksi per Bulan</h6>
                                            <p>{!! $ukm->capacity !!}</p>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                        <div class="my-4 mb-2 socials">
                            <div>
                                <a class="mb-3 whatsapp-click" href="">
                                    <div class="social whatsapp">
                                        <i class="fab fa-whatsapp fa-fw me-2"></i>
                                        <p>Kontak langsung untuk belanja</p>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <a href="" class="instagram-click">
                                    <div class="social secondary">
                                        <i class="fas fa-globe   fa-fw me-2"></i>
                                        <p>Cari tahu lebih lanjut</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="description-profile">
                            <h4 class="title-desc primary-color mb-2">Profil</h4>
                            <p>{!! $ukm->description !!}</p>
                        </div>
                        <div id="read_more" class="primary-color mb-4">
                            ... Selengkapnya
                        </div>
                        <div class="detail-head no-border">
                            <div class="description row">
                                <div class="col-12">
                                    @if ($ukm->minimum_order)
                                        <div class="desc-item">
                                            <h6 class="mb-2"><i>Minimum Order Quantity</i> untuk ekspor
                                            </h6>
                                            <p>{!! $ukm->minimum_order !!}</p>
                                        </div>
                                    @endif
                                    @if ($ukm->fulfillment_duration)
                                        <div class="desc-item">
                                            <h6 class="mb-2">Durasi masa tunggu pemenuhan pesanan</h6>
                                            <p>{!! $ukm->fulfillment_duration !!}</p>
                                        </div>
                                    @endif
                                    @if ($ukm->preferred_incoterm)
                                        <div class="desc-item">
                                            <h6 class="mb-2">INCOTERM yang diminati</h6>
                                            <p>{!! $ukm->preferred_incoterm !!}</p>
                                        </div>
                                    @endif
                                    @if ($ukm->achievement)
                                        <div class="desc-item">
                                            <h6 class="mb-2">Capaian</h6>
                                            <p>{!! $ukm->achievement !!}</p>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        @if ($sliders)
                            <div class="ukm-sliders" id="ukm_sliders">
                                @foreach ($sliders as $slider)
                                    <a href='{{ $slider->link }}' class="d-block slider-click"
                                        data-id={{ $slider->id }}>
                                        <div class="image-container ratio16x9">
                                            <img src="{{ Storage::url('ukm-slider/' . $slider->image) }}"
                                                alt="{{ $ukm->title }}">
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <div class="social-share">
                            <h5 class="primary-color">Share:</h5>
                            {!! $shareComponent !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12 mb-4">
                    <h3 class="text-center text-uppercase">UKM Lainnya</h3>
                </div>
                @foreach ($relatedUkms as $ukmRelated)
                    <div class="col-6 col-md-4 col-lg-3 mb-5">
                        <a href="{{ route('ukm.show', $ukmRelated->slug) }}">
                            <div class="ukm">
                                <div class="ukm-image">
                                    <div class="ratio ratio-1x1">
                                        @foreach ((array) json_decode($ukmRelated->images)[0] as $image)
                                            <img src="{{ Storage::url('ukm-image/' . $image) }}" alt="">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="ukm-wa">
                                    <a href="{{ $ukmRelated->whatsapp }}">
                                        <img src="/images/whatsapp.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('ukm.show', $ukmRelated->slug) }}">
                            <div class="ukm-title mt-2">
                                <p>{{ $ukmRelated->title }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    @include('components.disqus')
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sliders').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: '#carousel'
            });
            $('#carousel').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '#sliders',
                focusOnSelect: true
            });

            $('#ukm_sliders').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
            });

        });

        $('.whatsapp-click').click(function(e) {
            e.preventDefault();
            var ukm = '{{ $ukm->id }}'
            window.open('{{ $ukm->whatsapp }}', '_blank');

            $.ajax({
                url: '/ukm-click/whatsapp-click',
                type: 'GET',
                data: {
                    ukm: ukm
                }
            }).done(function(res) {
                console.log('Click recorded');
            })
        });

        $('#read_more').click(function(e) {
            e.preventDefault();
            $('.description-profile').toggleClass('active');
            var text = $(this).text();
            $(this).text(
                text == "Lebih Sedikit" ? "... Selengkapnya" : "Lebih Sedikit");
        });

        $('.slider-click').click(function(e) {
            e.preventDefault();
            var slider = $(this).attr('data-id');
            var link = $(this).attr('href');
            $.ajax({
                url: '/ukm-click/slider-click',
                type: 'GET',
                data: {
                    slider: slider
                }
            }).done(function(res) {
                console.log('Click recorded')
                window.open(link, '_blank');
            })
        });

        $('.instagram-click').click(function(e) {
            e.preventDefault();
            var ukm = '{{ $ukm->id }}'
            window.open('{{ $ukm->instagram }}', '_blank');

            $.ajax({
                url: '/ukm-click/instagram-click',
                type: 'GET',
                data: {
                    ukm: ukm
                }
            }).done(function(res) {
                console.log('Click recorded');
            })
        });
    </script>
</x-app-layout>
