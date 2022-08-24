<div id="ukm_bests_all" class="ukm-sliders">
    @if (count($bests_all) > 0)
        @foreach ($bests_all as $ukm)
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
        $('#ukm_bests_all').slick({
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [{
                breakpoint: 567,
                settings: {
                    slidesToShow: 2
                }
            }, ]
        });
    });
</script>
