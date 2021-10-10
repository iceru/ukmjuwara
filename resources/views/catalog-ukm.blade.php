<div class="row">
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
            <div class="ukm-title mt-2">
                <p>{{ $ukm->title }}</p>
            </div>
        </a>
        
    </div>

    @empty

    <h3>Data tidak ditemukan</h3>

    @endforelse
    <div class="d-flex justify-content-center">{{$ukms->links()}}</div>
</div>