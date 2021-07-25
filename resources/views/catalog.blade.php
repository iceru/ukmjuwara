<x-app-layout>
    @section('title')
        UKM Juwara
    @endsection

    <div class="catalog">
        <div class="header" style="background-image: url('{{ Storage::url('catalog-image/'.$catalog->image) }}')">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <h2>{{ $catalog->title }}</h2>
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
                            <div class="ukm">
                                <div class="ukm-title">
                                    <h5>Nama UKM</h5>
                                </div>
                                <div class="ukm-wa">
                                    <a href="https://wa.me/">
                                        <img src="/images/whatsapp.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 filter">
                        <h3>Filter</h3>
                    </div>
                    <div class="col-md-9 katalog-ukm d-flex">
                        @foreach ($ukms as $ukm)
                            <a href="{{ route('ukm.show', $ukm->slug) }}">
                                @foreach ((array)json_decode($ukm->images)[0] as $image)
                                <div class="ukm" style="background-image: url('{{ Storage::url('ukm-image/'.$image) }}')">
                                @endforeach
                                    <div class="ukm-title">
                                        <h5>{{ $ukm->title }}</h5>
                                    </div>
                                    <div class="ukm-wa">
                                        <a href="https://wa.me/{{ $ukm->whatsapp }}">
                                            <img src="/images/whatsapp.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
