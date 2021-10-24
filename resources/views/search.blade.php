<x-app-layout>
    @section('title')
        {{ 'Search Results' }}
    @endsection
    @section('meta-content')Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog c-commerce s.id/UKMJUWARA dan katalog pada situs www.ukmjuwara.id, kanal ini akan terus memproduksi katalog berkala dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKM JUWARA GLOBAL yang berfokus pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan kebutuhan UKM untuk meroket.@endsection
    <div class="search-results">
        <div class="container container-padding">
          <div class="row search-body">
            @if (isset($searchResults))
                @if ($searchResults->isEmpty())
                    <div class="col-12">
                        <h3>Pencarian <b class="primary-color">{{ $searchTerm }}</b> tidak ditemukan</h3>
                    </div>
                @else
                    <div class="col-12 mb-4">
                        <h3>Terdapat {{ $searchResults->count() }} hasil pencarian untuk <span class="secondary-color">{{ $searchTerm }}</span> </h3>
                    </div>

                    <div class="row">
                        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                        <div class="col-12 col-md-6 result-category">
                            <h4 class="mb-3 primary-color">{{ ucwords($type) == "Ukms" ? "UKM" : ucwords($type) }}</h4>
                            <div class="row">
                                @foreach($modelSearchResults as $searchResult)
                                    @if (ucwords($type) == "Ukms")
                                        <div class="col-12 col-lg-6 col-xl-4 mb-4">
                                            <a href="{{ route('ukm.show', $searchResult->searchable->slug) }}">
                                                <div class="ukm">
                                                    <div class="ukm-image">
                                                        <div class="ratio ratio-1x1">
                                                            @foreach ((array)json_decode($searchResult->searchable->images)[0] as $image)
                                                            <img src="{{ Storage::url('ukm-image/'.$image) }}" alt="">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="ukm-wa">
                                                        <a href="https://wa.me/{{ $searchResult->searchable->whatsapp }}">
                                                            <img src="/images/whatsapp.png" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="{{ route('ukm.show', $searchResult->searchable->slug) }}">
                                                <div class="ukm-title mt-2">
                                                    <p>{{ $searchResult->searchable->title }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <div class="article medium mb-3 col-lg-4">
                                            <a href="{{ route('article.show', $searchResult->searchable->slug) }}">
                                                <div class="article-image">
                                                    <img src="{{ Storage::url('article-image/'.$searchResult->searchable->image) }}" alt="">
                                                </div>
                                                <h4 class="mb-3 article-title">{{ $searchResult->searchable->title }}</h4>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                        
                @endif
                
            @endif
          </div>
        </div>
    </div>

    <script>
        console.log('{!! $searchResults !!}')
    </script>
</x-app-layout>