<div id="ukm_bests_global" class="ukm-sliders">
    @if (count($bests_global) > 0)
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
    @else
        Data Tidak Ditemukan
    @endif
</div>


<script>
    $(document).ready(function() {
        $('#ukm_bests_global').slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            mobileFirst: true,
            autoplaySpeed: 3000,
            responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 6
                }
            },
        ]
        });
    });
</script>
