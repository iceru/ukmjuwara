<x-app-layout>
    @section('title')
        Berita - UKM Juwara
    @endsection

    <div class="articles">
        @foreach ($headerArticle as $article)
        <div class="article header-article" style="background-image: url('{{ Storage::url('article-image/'.$article->image) }}')">
            <div class="article-content container">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('article.show', $article->slug) }}">
                            <h2 class="article-title mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
                        </a>
                        <div class="d-flex mb-3 author align-items-center">
                            <img src="/images/default-user.jpg" class="me-3" width="37" alt="">
                            <p>{{ $article->author }}</p>
                        </div>
                        <div class="article-title">
                            <p >{!! $article->description!!}</p>
                        </div>
                        <p class="mt-3">{{  date('d F Y', strtotime($article->created_at )) }} | {{ $article->time_read }} Mins Read</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

       <div class="container container-padding">
        @if (!$topArticles->isEmpty())
        <h3 class="mb-3">Top Stories</h3>
            <div class="row top-stories">
                <div class="col-12 col-md-6 mb-3">
                    @foreach ($topArticles->slice(0,1) as $article)
                        <div class="article big" style="background-image: url('{{ Storage::url('article-image/'.$article->image) }}')">
                            <div class="article-content">
                                <a href="{{ route('article.show', $article->slug) }}">
                                    <h3 class="mb-3 article-title">{{ $article->title }}</h4>
                                </a>
                                <div class="d-flex mb-3 author align-items-center">
                                    <img src="/images/default-user.jpg" class="me-3" width="37" alt="">
                                    <p>{{ $article->author }}</p>
                                </div>
                                <div class="article-description">
                                    <p >{!! $article->description!!}</p>
                                </div>
                                <p class="mt-3">{{  date('d F Y', strtotime($article->created_at )) }} | {{ $article->time_read }} Mins Read</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12 col-md-6">
                    @foreach ($topArticles->slice(1,4) as $article)
                    <div class="article small row">
                        <div class="col-4">
                            <a href="{{ route('article.show', $article->slug) }}">
                                <div class="article-image">
                                    <img src="{{ Storage::url('article-image/'.$article->image) }}" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="col-8">
                            <a href="{{ route('article.show', $article->slug) }}">
                                <h5 class="mb-2 article-title">{{ $article->title }}</h4>
                            </a>
                            <div class="d-flex mb-2 author align-items-center">
                                <img src="/images/default-user.jpg" class="me-3" width="25" alt="">
                                <p>{{ $article->author }}</p>
                            </div>
                            <div class="article-description">
                                <p >{!! $article->description!!}</p>
                            </div>
                            <p class="mt-3">{{  date('d F Y', strtotime($article->created_at )) }} | {{ $article->time_read }} Mins Read</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="row">
            @foreach ($articles as $article)
                <div class="article medium col-md-4 mb-3 mb-lg-4 col-xxl-3">
                    <a href="{{ route('article.show', $article->slug) }}">
                        <div class="article-image">
                            <img src="{{ Storage::url('article-image/'.$article->image) }}" alt="">
                        </div>
                        <h4 class="mb-3 article-title">{{ $article->title }}</h4>
                    </a>
                    <div class="d-flex mb-3 author align-items-center">
                        <img src="/images/default-user.jpg" class="me-3" width="37" alt="">
                        <p>{{ $article->author }}</p>
                    </div>
                    <div class="article-description">
                        <p >{!! $article->description!!}</p>
                    </div>
                    <p class="mt-3">{{  date('d F Y', strtotime($article->created_at )) }} | {{ $article->time_read }} Mins Read</p>
                </div>
            @endforeach
            <div class="col-12 mt-3 justify-content-center d-flex">
                {{ $articles->links() }}
            </div>
        </div>
    </div>

    <script>
        var maxHeight = 0;

        $(".medium .article-title").each(function(){
            if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
        });

        $(".medium .article-title").height(maxHeight);
    </script>
</x-app-layout>

