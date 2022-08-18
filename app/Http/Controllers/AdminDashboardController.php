<?php

namespace App\Http\Controllers;

use Analytics;
use App\Models\Ukm;
use App\Models\Click;
use App\Models\Article;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukms = Ukm::count();
        $articles = Article::count();
        $catalogs = Catalog::count();
        $categories = Category::count();
        $totalVisitors1 = Analytics::fetchTotalVisitorsAndPageViews(Period::months(1), 5);
        $totalVisitors3 = Analytics::fetchTotalVisitorsAndPageViews(Period::months(3));
        $totalVisitors7 = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $mostVisited1 = Analytics::fetchMostVisitedPages(Period::days(30), 5);
        $mostVisited3 = Analytics::fetchMostVisitedPages(Period::months(3), 5);
        $mostVisited7 = Analytics::fetchMostVisitedPages(Period::days(7), 5);
        $fetchUser3 = Analytics::fetchUserTypes(Period::months(3));
        $fetchUser1 = Analytics::fetchUserTypes(Period::months(1));
        $fetchUser7 = Analytics::fetchUserTypes(Period::days(7));
        $topReferrers3 = Analytics::fetchTopReferrers(Period::months(3), 5);
        $topReferrers1 = Analytics::fetchTopReferrers(Period::months(1), 5);
        $topReferrers7 = Analytics::fetchTopReferrers(Period::days(7), 5);

        $catalogs_data = Catalog::pluck('id')->all();
        $catalogs_title = Catalog::skip(1)->take(2)->get();

        foreach ($catalogs_title as $key => $value) {
            ${'category_clicks_'.$key++} = Click::where('type_click', 'categories')->where('catalog_id', $value->id)->get();
        }
        
        foreach ($catalogs_title as $key => $value) {
            ${'state_clicks_'.$key++} = Click::where('type_click', 'state')->where('catalog_id', $value->id)->get();
        }

        foreach ($catalogs_title as $key => $value) {
            ${'gender_clicks_'.$key++} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)->get();
        }

        foreach ($catalogs_title as $key => $value) {
            ${'floating_clicks_'.$key++} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)->get();
        }

        foreach ($catalogs_title as $key => $value) {
            ${'ukm_clicks_'.$key++} = Ukm::where('catalog_id', $value->id)->where('whatsapp_clicks', '>', 0)->where('instagram_clicks', '>', 0)->get();
        }

        foreach ($catalogs_title as $key => $value) {
            ${'program_clicks_'.$key++} = DB::table('clicks')
                 ->select('program_id', DB::raw('count(*) as total'))
                 ->where('catalog_id', $value->id)
                 ->where('type_click', 'program')
                 ->groupBy('program_id')
                 ->get();
        }

        dd($program_clicks_0);

        return view('admin.dashboard', compact('ukms', 'articles', 'catalogs', 'categories', 'mostVisited1', 'mostVisited3', 'mostVisited7', 'fetchUser3', 'fetchUser1', 'fetchUser7', 'totalVisitors3',
        'totalVisitors1', 'totalVisitors7', 'topReferrers3', 'topReferrers1', 'topReferrers7', 'catalogs_title', 'category_clicks_0', 'category_clicks_1', 
        'state_clicks_0', 'state_clicks_1', 'gender_clicks_0', 'gender_clicks_1', 'floating_clicks_0', 'floating_clicks_1', 'ukm_clicks_0', 'ukm_clicks_1', 
        'program_clicks_0', 'program_clicks_1'));
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
