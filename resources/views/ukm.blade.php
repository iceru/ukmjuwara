<x-app-layout>
    @section('title')
        {{ $ukm->title }}
    @endsection
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
                                        <h6 class="mb-2">Lokasi</h6>
                                        @if($ukm->address)
                                            <p class="text-capitalize">{{ $ukm->address }}, {{ $sub_name }}, {{ $city_name }}, {{ $state_name }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="desc-item">
                                        <h6 class="mb-2">Kategori</h6>
                                        <p>@foreach ($ukm->categories as $item)
                                            <span>{{ $item->title }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="desc-item">
                                        <h6>Description 3</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="desc-item">
                                        <h6>Description 4</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                </div> --}}
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