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
                                            @foreach ((array)json_decode($ukm->images)[0] as $image)
                                            <div class="ratio ratio-1x1 ukm" style="background-image: url('{{ Storage::url('ukm-image/'.$image) }}')">
                                            @endforeach
                                                <div class="ukm-content">
                                                    <div class="ukm-title">
                                                        <h5>{{ $ukm->title }}</h5>
                                                    </div>
                                                    <div class="ukm-wa">
                                                        <a href="https://wa.me/{{ $ukm->whatsapp }}">
                                                            <img src="/images/whatsapp.png" alt="">
                                                        </a>
                                                    </div>
                                                </div>
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
                            <input type="text" class="form-control" placeholder="Search" name="search">
                            <div class="icon-search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="category-filter mb-4">
                            <h5 class="mb-2">Kategori</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kategori 1
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kategori 2
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kategori 3
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kategori 4
                            </div>
                        </div>
                        <div class="location-filter">
                            <h5 class="mb-2">Lokasi</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Lokasi 1
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Lokasi 2
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Lokasi 3
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Lokasi 4
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 katalog-ukm">
                        <div class="row">
                            @foreach ($ukms as $ukm)
                            <div class="col-6 col-md-4 col-xl-3 mb-4">
                                <a href="{{ route('ukm.show', $ukm->slug) }}">
                                @foreach ((array)json_decode($ukm->images)[0] as $image)
                                <div class="ratio ratio-1x1 ukm" style="background-image: url('{{ Storage::url('ukm-image/'.$image) }}')">
                                @endforeach
                                    <div class="ukm-content">
                                        <div class="ukm-title">
                                            <h5>{{ $ukm->title }}</h5>
                                        </div>
                                        <div class="ukm-wa">
                                            <a href="https://wa.me/{{ $ukm->whatsapp }}">
                                                <img src="/images/whatsapp.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </a>
                        </div>
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

        });
        // $('')
        function getContrastYIQ(hexcolor){
            hexcolor = hexcolor.replace("#", "");
            var r = parseInt(hexcolor.substr(0,2),16);
            var g = parseInt(hexcolor.substr(2,2),16);
            var b = parseInt(hexcolor.substr(4,2),16);
            var yiq = ((r*299)+(g*587)+(b*114))/1000;
            return (yiq >= 128) ? 'black' : 'white';
        }
    </script>
</x-app-layout>
