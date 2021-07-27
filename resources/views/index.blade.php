<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection
    <div class="header-container">
        <div class="header">
            @foreach ($sliders as $slider)
            <div>
                <img src="{{ Storage::url('slider-image/'.$slider->image) }}" alt="{{ $slider->title }}">
            </div>
            @endforeach
        </div>
        <div class="cta">
            @foreach ($featured as $catalog)
            <div class="cta-item">
                <a href="{{ route('catalog.show', $catalog->slug) }}">#{{ $catalog->title }}</a>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.header').slick();
        });
    </script>
</x-app-layout>
