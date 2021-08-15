<x-app-layout>
    @section('title')
        {{ $ukm->title }}
    @endsection
    <div class="ukm">
        <div class="container container-padding">
            <div class="row">
                <div class="col-12 col-md-5 ukm-image">
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
                <div class="col-12 col-md-7">
                    <div class="container-ukm">
                        <div class="detail-head">
                            <h1 class="mb-4">{{ $ukm->title }}</h1>
                            <div class="row description">
                                <div class="col-6 mb-3">
                                    <div class="desc-item">
                                        <h6>Description 1</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="desc-item">
                                        <h6>Description 2</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                </div>
                                <div class="col-6">
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
                                </div>
                            </div>
                        </div>
                        <div class="description mb-4">
                            <p>{!! $ukm->description !!}</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <a href="https://wa.me/{{ $ukm->whatsapp }}">
                                <div class="social whatsapp">
                                    <p class="me-2">Whatsapp</p>
                                    <i class="fab fa-whatsapp fa-fw "></i>
                               </div>
                            </a>
                            <a href="{{ $ukm->instagram }}">
                                <div class="social instagram">
                                    <p class="me-2">Instagram</p>
                                    <i class="fab fa-instagram fa-fw"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
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