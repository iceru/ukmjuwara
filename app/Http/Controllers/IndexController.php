<?php

namespace App\Http\Controllers;

use App\Models\Cta;
use App\Models\Ukm;
use App\Models\Slider;
use App\Models\Article;
use App\Models\Catalog;
use App\Models\Program;
use App\Models\Sponsor;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use CyrildeWit\EloquentViewable\Support\Period;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogDigital = Catalog::with('ukm')->where('slug', 'ukmjuwara-go-digital')->firstOrFail();
        $catalogGlobal = Catalog::with('ukm')->where('slug', 'ukmjuwara-go-global')->firstOrFail();
        $sliderDesktop = Slider::where('type', 'desktop')->get();
        $sliderMobile = Slider::where('type', 'mobile')->get();
        $sponsors = Sponsor::where('type', 'dipersembahkan')->get();
        $sponsors_dukung = Sponsor::where('type', 'didukung')->get();
        $featured = Catalog::where('featured', 'yes')->take(2)->get();

        $categories_global = Category::whereHas('ukms', function($q) use($catalogGlobal) {
            $q->where('catalog_id', $catalogGlobal->id);
        })->get();
        $programs_global = Program::whereHas('ukm', function($q) use($catalogGlobal) {
            $q->where('catalog_id', $catalogGlobal->id);
        })->get();
        $states_global = Ukm::where('catalog_id', $catalogGlobal->id)->select('state_name')->distinct()->where('state_name', '!=', '')->get();

        $categories_digital = Category::whereHas('ukms', function($q) use($catalogDigital) {
            $q->where('catalog_id', $catalogDigital->id);
        })->get();
        $bests = Ukm::where('catalog_id', $catalogDigital->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
        $bests_global = Ukm::where('catalog_id', $catalogGlobal->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
        $articles = Article::get()->take(2);
        $cta = Cta::first();
        
        return view('index', compact('sliderDesktop', 'sliderMobile', 'featured', 'sponsors', 'sponsors_dukung', 'bests', 'categories_digital', 'categories_global', 'programs_global', 'states_global', 'bests_global', 'articles', 'cta'));
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
