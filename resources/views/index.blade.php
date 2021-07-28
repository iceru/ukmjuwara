<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection
    <div class="header-container">
        <div class="header">
            @foreach ($sliders as $slider)
            <div>
                <div class="image-container ratio2halfx1">
                    <img class="image" src="{{ Storage::url('slider-image/'.$slider->image) }}" alt="{{ $slider->title }}">
                </div>
            </div>
            @endforeach
        </div>
        <div class="cta ">
            @foreach ($featured as $catalog)
            <a href="{{ route('catalog.show', $catalog->slug) }}">
                <div class="cta-item align-items-center">
                    #{{ $catalog->title }}
                    <img src="/images/cursor.png" class="ms-2" height="20" width="20" alt="">
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="container supported-by">
        <div class="row">
            <div class="col-12">
                <div class="support-title">
                    <h3 class="text-center fw-bold">Didukung Oleh</h3>
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

    <script>
        $(document).ready(function(){
            $('#supported').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1
            });

            $('.header').slick();

        });
    </script>
</x-app-layout>
