<x-app-layout>
    @section('title')
        {{ $article->title }} - UKMJAGOWAN.ID
    @endsection
    @section('meta-content')
        {!! substr(strip_tags($article->description), 0, 120) !!}
    @endsection

    <div class="article-detail">
        <header class="article header-article"
            style="background-image: url('{{ Storage::url('article-image/' . $article->image) }}')">
            <div class="article-content container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-3">{{ $article->title }}</h2>
                        <div class="d-flex align-items-center mb-3">
                            <img src="/images/default-user.jpg" class="circular me-3" width="50" alt="">
                            <h5>{{ $article->author }}</h5>
                        </div>
                        <p>{{ date('d F Y', strtotime($article->created_at)) }} | {{ $article->time_read }} Mins
                            Read</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="article-detail-content">
                        <div class="article-image mb-3 text-center">
                            <img src="{{ Storage::url('article-image/' . $article->image) }}" class="w-50"
                                alt="">
                        </div>
                        <div class="share-button mb-3">
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                        <div class="article-detail-desc">
                            {!! $article->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h3>Berita Lainnya</h3>
                        </div>
                        @foreach ($relatedArticles as $article)
                            <div class="article medium col-md-3">
                                <a href="{{ route('article.show', $article->slug) }}">
                                    <div class="article-image">
                                        <img src="{{ Storage::url('article-image/' . $article->image) }}" alt="">
                                    </div>
                                    <h4 class="mb-3 article-title primary-color">{{ $article->title }}</h4>
                                </a>
                                <div class="d-flex mb-3 author align-items-center">
                                    <img src="/images/default-user.jpg" class="me-3" width="37" alt="">
                                    <p>{{ $article->author }}</p>
                                </div>
                                <div class="article-description">
                                    <p>{!! $article->description !!}</p>
                                </div>
                                <p class="mt-3 primary-color">{{ date('d F Y', strtotime($article->created_at)) }}
                                    | {{ $article->time_read }} Mins Read</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-612243045afba155"></script>
    <script>
        var maxHeight = 0;

        $(".medium .article-title").each(function() {
            if ($(this).height() > maxHeight) {
                maxHeight = $(this).height();
            }
        });

        $(".medium .article-title").height(maxHeight);
    </script>
</x-app-layout>
