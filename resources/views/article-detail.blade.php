<x-app-layout>
    @section('title')
        {{ $article->title }} - UKM Juwara
    @endsection

    <div class="article-detail">
        <header class="article header-article" style="background-image: url('{{ Storage::url('article-image/'.$article->image) }}')">
            <div class="article-content container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-3">{{ $article->title }}</h2> 
                        <div class="d-flex align-items-center mb-3">
                            <img src="/images/default-user.jpg" class="circular me-3" width="50" alt="">
                            <h5>{{ $article->author }}</h5>
                        </div> 
                        <p>{{ date('d F Y', strtotime($article->created_at )) }} | {{ $article->time_read }} Mins Read</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="article-detail-content">
                        <div class="share-button"></div>
                        <div class="article-detail-desc">
                            {!! $article->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>