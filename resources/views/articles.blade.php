<x-app-layout>
    @section('title')
        Berita - UKM Juwara
    @endsection

    <div class="articles">
        <div class="top-article" style="background-image: ">
            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>
            <div class="d-flex">
                <img src="" alt="">
                <p>Author</p>
            </div>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas natus accusamus repellendus magnam minima voluptatibus culpa quisquam! Aliquam necessitatibus porro quibusdam quam unde. Tempore nihil saepe, in eius cumque eum?</p>
            <p>12 Juni 2021 | 5 Mins Read</p>
        </div>

       <div class="container">
        <h3 class="mb-3">Top Stories</h3>
        <div class="row top-stories mb-4">
            <div class="col-12 col-md-6">
               <div class="article">
                    <h4>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h4>
                    <div class="d-flex">
                        <img src="" alt="">
                        <p>Author</p>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas natus accusamus repellendus magnam minima voluptatibus culpa quisquam! Aliquam necessitatibus porro quibusdam quam unde. Tempore nihil saepe, in eius cumque eum?</p>
                    <p>12 Juni 2021 | 5 Mins Read</p>
               </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="article-small">
                    <img src="" alt="">
                    <div class="article-text">
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5>
                        <div class="d-flex">
                            <img src="" alt="">
                            <p>Author</p>
                        </div>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas natus accusamus repellendus magnam minima voluptatibus culpa quisquam! Aliquam necessitatibus porro quibusdam quam unde. Tempore nihil saepe, in eius cumque eum?</p>
                        <p>12 Juni 2021 | 5 Mins Read</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($articles as $article)
                    <div class="article-medium col-md-4">
                        <a href="{{ route('article.show', $article->slug) }}">
                            <div class="article-image">
                                <img src="{{ Storage::url('article-image/'.$article->image) }}" alt="">
                            </div>
                            <h4 class="mb-3">{{ $article->title }}</h4>
                        </a>
                        <div class="d-flex mb-3 author align-items-center">
                            <img src="/images/default-user.jpg" class="me-3" width="37" alt="">
                            <p>{{ $article->author }}</p>
                        </div>
                        <p>{!! \Illuminate\Support\Str::limit($article->description, 150, $end='...') !!}</p>
                        <p class="mt-3">{{  date('d F Y', strtotime($article->created_at )) }} | {{ $article->time_read }} Mins Read</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
