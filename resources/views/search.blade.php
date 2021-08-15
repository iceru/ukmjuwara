<x-app-layout>
    @section('title')
        {{ 'Search Results' }}
    @endsection
    <div class="search-results">
        <div class="container container-padding">
          <div class="row">
            @if (isset($searchResults))
            @if ($searchResults->isEmpty())
                    <div class="col-12">
                        <h3>Pencarian <b>{{ $searchTerm }}</b> tidak ditemukan</h3>
                    </div>
                @else
                    <div class="col-12 mb-3">
                        <h3>Terdapat {{ $searchResults->count() }} hasil pencarian untuk <span class="secondary-color">{{ $searchTerm }}</span> </h3>
                    </div>

                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                    <div class="col-6">
                    <h4 class="mb-2">{{ ucwords($type) }}</h2>
                        @foreach($modelSearchResults as $searchResult)
                            <ul>
                                <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                            </ul>
                        </div>
                        @endforeach
                    @endforeach
                        
                @endif
                
            @endif
          </div>
        </div>
    </div>
</x-app-layout>