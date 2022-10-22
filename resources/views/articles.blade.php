<x-app-layout>
    @section('title')
        Berita - UKMJAGOWAN.ID
    @endsection
    @section('meta-content')
        Sebagai komunitas pertama di dunia yang menghadirkan katalog member dalam format Whatsapp. Business Catalog
        c-commerce s.id/UKMJUWARA dan katalog pada situs www.UKMJAGOWAN.id, kanal ini akan terus memproduksi katalog berkala
        dan melakukan pengembangan konten dengan menghadirkan variasi tema katalog seperti UKMJAGOWAN.ID GLOBAL yang
        berfokus
        pada peningkatan penetrasi pasar global oleh pelaku UKM Iokal berikut dengan berita-berita sangat relevan dengan
        kebutuhan UKM untuk meroket.
    @endsection
    <div class="articles">
        @foreach ($headerArticle as $article)
            <div class="article header-article"
                style="background-image: url('{{ Storage::url('article-image/' . $article->image) }}')">
                <div class="article-content container">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('article.show', $article->slug) }}">
                                <h2 class="article-title mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </h2>
                            </a>
                            <div class="d-flex mb-3 author align-items-center">
                                <img src="/images/default-user.jpg" class="me-3" width="37" alt="">
                                <p>UKMJagoWAn</p>
                            </div>
                            <div class="article-title">
                                <p>{!! $article->description !!}</p>
                            </div>
                            <p class="mt-3">{{ date('d F Y', strtotime($article->created_at)) }} |
                                {{ $article->time_read }} Mins Read</p>
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
                        @foreach ($topArticles->slice(0, 1) as $article)
                            <div class="article big"
                                style="background-image: url('{{ Storage::url('article-image/' . $article->image) }}')">
                                <div class="article-content">
                                    <a href="{{ route('article.show', $article->slug) }}">
                                        <h3 class="mb-3 article-title">{{ $article->title }}</h4>
                                    </a>
                                    <div class="d-flex mb-3 author align-items-center">
                                        <img src="/images/default-user.jpg" class="me-3" width="37"
                                            alt="">
                                        <p>UKMJagoWAn</p>
                                    </div>
                                    <article class="article-description">
                                        <p>{!! $article->description !!}</p>
                                    </article>
                                    <p class="mt-3">{{ date('d F Y', strtotime($article->created_at)) }} |
                                        {{ $article->time_read }} Mins Read</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 col-md-6">
                        @foreach ($topArticles->slice(1, 4) as $article)
                            <div class="article small row">
                                <div class="col-4">
                                    <a href="{{ route('article.show', $article->slug) }}">
                                        <div class="article-image">
                                            <img src="{{ Storage::url('article-image/' . $article->image) }}"
                                                alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-8">
                                    <a href="{{ route('article.show', $article->slug) }}">
                                        <h5 class="mb-2 article-title">{{ $article->title }}</h4>
                                    </a>
                                    <div class="d-flex mb-2 author align-items-center">
                                        <img src="/images/default-user.jpg" class="me-3" width="25"
                                            alt="">
                                        <p>UKMJagoWAn</p>
                                    </div>
                                    <div class="article-description"
                                        style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 3;">
                                        <p>{!! $article->description !!}</p>
                                    </div>
                                    <p class="mt-3">{{ date('d F Y', strtotime($article->created_at)) }}
                                        | {{ $article->time_read }} Mins Read</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="row">
                <!-- @if ($topArticles->isEmpty())
<div class="col-12 mb-5 text-center article-header">
                <h2>Berita</h2>
            </div>
@endif -->
                @foreach ($articles as $article)
                    <div class="article medium col-md-4 mb-4 mb-lg-5 col-xxl-3">
                        <a href="{{ route('article.show', $article->slug) }}">
                            <div class="article-image">
                                <img src="{{ Storage::url('article-image/' . $article->image) }}" alt="">
                            </div>
                            <h4 class="mb-3 article-title primary-color">{{ $article->title }}</h4>
                        </a>
                        <div class="d-flex mb-3 author align-items-center">
                            <img src="/images/default-user.jpg" class="me-3" width="37" alt="">
                            <p>UKMJagoWAn</p>
                        </div>
                        <div class="article-description" style="height:73px">
                            <p>{!! $article->description !!}</p>
                        </div>
                        <p class="mt-2 primary-color">{{ date('d F Y', strtotime($article->created_at)) }} |
                            {{ $article->time_read }} Mins Read</p>
                    </div>
                @endforeach
                <div class="col-12 mt-3 justify-content-center d-flex">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>

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
