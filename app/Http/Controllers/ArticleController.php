<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerArticle = [];
        $topArticles = [];

        $headerTag = Tag::where('tag_name', 'header')->pluck('id');
        if($headerTag->first()) {
            $headerArticle = Article::whereHas('tags', function($query) use($headerTag) {
                $query->where('tag_id', $headerTag);
            })->take(1)->get();
        }

        $topTag = Tag::where('tag_name', 'top')->pluck('id');
        if($topTag->first()) {
            $topArticles = Article::whereHas('tags', function($b) use($topTag) {
                $b->where('tag_id', $topTag);
            })->take(5)->get();
        }

        if($topTag->first() and $headerTag->first()) {
            $articles = Article::whereHas('tags', function($query) use($headerTag, $topTag) {
                $query->where('tag_id', '!=', $headerTag)->where('tag_id', '!=', $topTag);
            })->latest()->paginate(10);
        } else {
            $articles = Article::latest()->paginate(10);
        }

        return view('articles', compact('articles', 'headerArticle', 'topArticles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $relatedArticles = Article::orderBy('created_at', 'asc')->get()->take(4);

        return view('article-detail', compact('article', 'relatedArticles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
