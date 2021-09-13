<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Slider;
use App\Models\Article;
use App\Models\Catalog;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderDesktop = Slider::where('type', 'desktop')->get();
        $sliderMobile = Slider::where('type', 'mobile')->get();
        $sponsors = Sponsor::where('type', 'dipersembahkan')->get();
        $sponsors_dukung = Sponsor::where('type', 'didukung')->get();
        $featured = Catalog::where('featured', 'yes')->take(2)->get();
        
        return view('index', compact('sliderDesktop', 'sliderMobile', 'featured', 'sponsors', 'sponsors_dukung'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search_query');
        $searchResults = (new Search())->registerModel(Ukm::class, 'title', 'images', 'whatsapp')
        ->registerModel(Article::class, 'title', 'image','description', 'author')
        ->perform($request->input('search_query'));

        return view('search', compact('searchResults', 'searchTerm'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
