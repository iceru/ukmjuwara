<div class="loading-spinner justify-content-center mb-3">
    <div class="spinner-border" role="status">
    </div>
</div>

<div class="row ukm-content">
    @forelse ($ukms as $ukm)
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
                    <a href="{{ $ukm->whatsapp }}">
                        <img src="/images/whatsapp.png" alt="">
                    </a>
                </div>
            </div>
        </a>
        <a href="{{ route('ukm.show', $ukm->slug) }}">
            <div class="ukm-title mt-3">
                <h5>{{ $ukm->title }}</h5>
            </div>
            <div class="ukm-desc">
                <small>{{ $ukm->product }}</small>
            </div>
        </a>
        
    </div>

    @empty

    <h3>Data tidak ditemukan</h3>

    @endforelse
    <div class="d-flex justify-content-center">{{$ukms->links()}}</div>
</div>