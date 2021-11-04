<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection

    @section('meta-content')Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan kebutuhan UKM untuk meroket.@endsection
    <div class="header-container">
        <div class="desktop header">
            @foreach ($sliderDesktop as $slider)
            <div>
                <div class="image-container ratio2halfx1">
                    <img class="image" src="{{ Storage::url('slider-image/'.$slider->image) }}" alt="{{ $slider->title }}">
                </div>
            </div>
            @endforeach
        </div>
        <div class="mobile header">
            @foreach ($sliderMobile as $slider)
            <div>
                <div class="image-container ratio2halfx1">
                    <img class="image" src="{{ Storage::url('slider-image/'.$slider->image) }}" alt="{{ $slider->title }}">
                </div>
            </div>
            @endforeach
        </div>
        <div class="cta">
            @foreach ($featured as $catalog)
            <a href="{{ route('catalog.show', $catalog->slug) }}">
                <div class="cta-item align-items-center">
                    {{ $catalog->title }}
                    <img src="/images/cursor.png" class="ms-2" height="20" width="20" alt="">
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @if (count($sponsors) > 0)
    <div class="container supported-by mb-5">
        <div class="row">
            <div class="col-12">
                <div class="support-title">
                    <h4 class="text-center fw-light">Dipersembahkan Oleh</h4>
                </div>
                <div id="supported">
                    @foreach ($sponsors as $sponsor)
                        <div>
                            <img src="{{ Storage::url('sponsor-image/'.$sponsor->image) }}" alt="{{ $sponsor->title }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (count($sponsors_dukung) > 0)
    <div class="container supported-by">
        <div class="row">
            <div class="col-12">
                <div class="support-title">
                    <h4 class="text-center fw-light">Didukung Oleh</h4>
                </div>
                <div id="supported_dukung">
                    @foreach ($sponsors_dukung as $sponsor)
                        <div>
                            <img src="{{ Storage::url('sponsor-image/'.$sponsor->image) }}" alt="{{ $sponsor->title }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        $(document).ready(function(){
            $('#supported').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [
                    {
                        breakpoint: 567,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });
            $('#supported_dukung').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [
                    {
                        breakpoint: 567,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });

            $('.header').slick();

        });
    </script>
</x-app-layout>
