<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('admin.article.index', compact('articles'));
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
        $article = new Article;

        $request->validate([
            'image' => 'required|image',
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'time_read' => 'required|integer',
            'tags' => 'string|regex:/^[a-zA-Z0-9\s]+$/'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/article-image', $filename);
        }

        $article->image = $filename;

        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->description = $request->description;
        $article->author = $request->author;
        $article->time_read = $request->time_read;
        $article->save();

        $tagsArray = explode(' ', strtolower($request->tags));
        $tags = array();

        foreach($tagsArray as $articleTag) {
            if($articleTag != ' ') {
                $tag = Tag::firstOrCreate([
                    'tag_name' => $articleTag
                ]);

                $tags[$tag->id] = ['article_id' => $article->id];
            }
        }

        $article->tags()->attach($tags);

        return redirect()->route('admin.article')->with('success','Data berhasil di input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        return view('admin.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $article = Article::find($request->id);

        $request->validate([
            'title' => 'required',
            'slug' => 'nullable',
            'description' => 'required',
            'author' => 'required',
            'time_read' => 'required|integer',
            'tags' => 'string|regex:/^[a-zA-Z0-9\s]+$/',
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/article-image', $filename);
            $article->image = $filename;
        }

        $article->title = $request->title;
        $article->description = $request->description;
        $article->author = $request->author;
        $article->time_read = $request->time_read;
        $article->slug = Str::slug($request->title);
        $article->save();

        $tagsArray = explode(' ', strtolower($request->tags));
        $tags = array();

        foreach($tagsArray as $articleTag) {
            if($articleTag != ' ') {
                $tag = Tag::firstOrCreate([
                    'tag_name' => $articleTag
                ]);

                $tags[$tag->id] = ['article_id' => $article->id];
            }
        }

        $article->tags()->sync($tags);

        return redirect()->route('admin.article')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect()->route('admin.article')->with('success','Data berhasil dihapus');
    }
}
