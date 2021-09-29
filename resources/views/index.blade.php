<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection
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
                    <h3 class="text-center fw-light">Dipersembahkan oleh</h3>
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
                    <h3 class="text-center fw-light">Didukung oleh</h3>
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
