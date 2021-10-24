<x-app-layout>
    @section('title')
        {{ $ukm->title }}
    @endsection
    @section('meta-content')Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan kebutuhan UKM untuk meroket.@endsection

    <div class="ukm-page">
        <div class="container container-padding">
            <div class="row">
                <div class="col-12 col-md-5 ukm-image mb-5">
                    <div id="sliders">
                        @foreach ((array)json_decode($ukm->images) as $image)
                            <div>
                                <div class="image-container ratio1x1">
                                    <img src="{{ Storage::url('ukm-image/'.$image) }}" alt="{{ $ukm->title }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-7 ">
                    <div class="container-ukm">
                        <div class="detail-head">
                            <h1 class="mb-4">{{ $ukm->title }}</h1>
                            <div class="row description">
                                <div class="col-6 mb-3">
                                    <div class="desc-item">
                                        <h6 class="mb-2">Kategori</h6>
                                        <p>@foreach ($ukm->categories as $item)
                                            <span>{{ $item->title }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                @if ($ukm->achievement)
                                    <div class="col-6 mb-3">
                                        <div class="desc-item">
                                            <h6 class="mb-2">Capaian</h6>
                                            <p>{!! $ukm->achievement !!}</p>
                                        </div>
                                    </div>
                                @endif
                                @if ($ukm->permission)
                                    <div class="col-6 mb-3">
                                        <div class="desc-item">
                                            <h6 class="mb-2">Perizinan</h6>
                                            <p>{!! $ukm->permission !!}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-6 mb-3">
                                    <div class="desc-item">
                                        <h6 class="mb-2">Lokasi</h6>
                                        @if($ukm->address)
                                            <p class="text-capitalize">{{ $ukm->address }}, {{ $sub_name }}, {{ $city_name }}, {{ $state_name }} </p>
                                        @endif
                                    </div>
                                </div>
                                @if ($ukm->operational_hours && $ukm->operational_hours_end)
                                    <div class="col-6 mb-3">
                                        <div class="desc-item">
                                            <h6 class="mb-2">Jam Operasional</h6>
                                            <p>{{ $ukm->operational_hours }} - {{ $ukm->operational_hours_end }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if ($ukm->capacity)
                                    <div class="col-6 mb-3">
                                        <div class="desc-item">
                                            <h6 class="mb-2">Kapasitas</h6>
                                            <p>{{ $ukm->capacity }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="description mb-4">
                            <p>{!! $ukm->description !!}</p>
                        </div>
                        <div class="mb-4">
                            <div>
                                <a class="mb-3" href="https://wa.me/{{ $ukm->whatsapp }}">
                                    <div class="social whatsapp">
                                        <i class="fab fa-whatsapp fa-fw me-2"></i>
                                        <p>Klik untuk kontak langsung & belanja</p>
                                   </div>
                                </a>
                            </div>
                            <div>
                                <a href="{{ $ukm->instagram }}">
                                    <div class="social instagram">
                                        <i class="fab fa-instagram fa-fw me-2"></i>
                                        <p>Klik untuk tahu lebih banyak</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <h3 class="text-center text-uppercase">UKM Lainnya</h3>
                </div>
                @foreach ($relatedUkms as $ukm)
                    <div class="col-6 col-md-4 col-xl-3 mb-5">
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
                                <p>{{ $ukm->title }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#sliders').slick({
                infinite: true,
                slidesToShow: 1,
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
        });
    </script>
</x-app-layout>