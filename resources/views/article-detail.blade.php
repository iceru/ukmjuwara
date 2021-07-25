<x-app-layout>
    @section('title')
        {{ $article->title }} - UKM Juwara
    @endsection

    <div class="article-detail">
        <header>
            <h2>{{ $article->title }}</h2> 
            <div class="d-flex">
                <img src="/images/default-user.jpg" alt="">
                <h5>{{ $article->author }}</h5>
                <p>{{ date('d-m-Y', strtotime($article->created_at )) }} | {{ $article->time_read }}</p>
            </div> 
        </header>
    </div>
</x-app-layout>