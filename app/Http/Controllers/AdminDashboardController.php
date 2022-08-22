<?php

namespace App\Http\Controllers;

use DateTime;
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
    public function index(Request $request)
    {
        $ukms = Ukm::count();
        $articles = Article::count();
        $catalogs = Catalog::count();
        $categories = Category::count();
        $totalVisitors = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $mostVisited = Analytics::fetchMostVisitedPages(Period::days(7), 10);
        $fetchUser = Analytics::fetchUserTypes(Period::days(7));
        $userDevice = Analytics::performQuery(
            Period::days(7),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions,ga:pageviews,ga:sessionDuration',
                'dimensions' => 'ga:deviceCategory',
            ]
        );
        $userCountry = Analytics::performQuery(
            Period::days(7),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions',
                'dimensions' => 'ga:country',
            ]
        );

        $catalogs_title = Catalog::skip(1)->take(3)->get();

        $count_total = 'count(*) as total';

        foreach ($catalogs_title as $key => $value) {
            ${'category_'.$key} = Click::with('category')->where('type_click', 'categories')->where('catalog_id', $value->id)
            ->groupBy('category_id')->select('category_id', DB::raw($count_total))->orderBy('category_id')->get()->toArray();

            ${'clicks_'.$key} = Click::where('type_click', 'categories')->where('catalog_id', $value->id)
            ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('category_id')->get()->toArray();

            ${'category_clicks_'.$key} = collect();

            if($key < 2) {
                for ($index = 0 ; $index < count(${'category_'.$key}); $index ++) {
                    ${'total_counts_'.$index} = array('category_id' => ${'category_'.$key}[$index]['category_id'], 
                    'category' => ${'category_'.$key}[$index]['category'],
                    'total' => ${'clicks_'.$key}[$index]['clicks']+${'category_'.$key}[$index]['total']);
                    
                    ${'category_clicks_'.$key}->push(${'total_counts_'.$index});
                }
            }

            $key++;
        }

        $category_clicks_2 = Click::where('type_click', 'categories')->where('catalog_id', 4)
        ->select(DB::raw('*'), DB::raw('clicks as total'))->orderBy('category_id')->get();
        
        foreach ($catalogs_title as $key => $value) {
            ${'state_'.$key} = Click::where('type_click', 'state')->where('catalog_id', $value->id)
            ->groupBy('name_click')->select('name_click', DB::raw($count_total))->orderBy('name_click')->get()->toArray();

            ${'state_count_'.$key} = Click::where('type_click', 'state')->where('catalog_id', $value->id)
            ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('name_click')->get()->toArray();

            ${'state_clicks_'.$key} = collect();

            for ($index = 0 ; $index < count(${'state_'.$key}); $index ++) {
                ${'total_counts_'.$index} = array('title' => ${'state_'.$key}[$index]['name_click'],
                'total' => ${'state_count_'.$key}[$index]['clicks']+${'state_'.$key}[$index]['total']);
                
                ${'state_clicks_'.$key}->push(${'total_counts_'.$index});
            }

            $key++;
        }

        foreach ($catalogs_title as $key => $value) {
            ${'gender_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
            ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();

            ${'gender_count_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
            ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('name_click')->get()->toArray();

            ${'gender_clicks_'.$key} = collect();

            for ($index = 0 ; $index < count(${'gender_'.$key}); $index ++) {
                ${'total_counts_'.$index} = array('title' => ${'gender_'.$key}[$index]['name_click'],
                'total' => ${'gender_count_'.$key}[$index]['clicks']+${'gender_'.$key}[$index]['total']);
                
                ${'gender_clicks_'.$key}->push(${'total_counts_'.$index});
            }

            $key++;
        }

        foreach ($catalogs_title as $key => $value) {
            ${'floating_'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
            ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();

            
            ${'floating_count'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
            ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('name_click')->get()->toArray();

            ${'floating_clicks_'.$key} = collect();

            for ($index = 0 ; $index < count(${'floating_'.$key}); $index ++) {
                ${'total_counts_'.$index} = array('title' => ${'floating_'.$key}[$index]['name_click'],
                'total' => ${'floating_count'.$key}[$index]['clicks']+${'floating_'.$key}[$index]['total']);
                
                ${'floating_clicks_'.$key}->push(${'total_counts_'.$index});
            }

            $key++;
        }

        foreach ($catalogs_title as $key => $value) {
            ${'ukm_clicks_'.$key++} = Ukm::where('catalog_id', $value->id)->where('whatsapp_clicks', '>', 0)->where('instagram_clicks', '>', 0)->get();
        }

        foreach ($catalogs_title as $key => $value) {
            ${'program_clicks_'.$key++} = Click::where('type_click', 'program')->where('catalog_id', $value->id)->groupBy('program_id')->select('program_id', DB::raw($count_total))->get();
        }

        if($request->ajax() && $request->start_date != '' && $request->end_date != '') {
            $startdate = \DateTime::createFromFormat('Y-m-d H:i:s', $request->start_date)->format('Y-m-d');
            $enddate = \DateTime::createFromFormat('Y-m-d H:i:s', $request->end_date)->format('Y-m-d');
            
            if(new DateTime($startdate) >= new DateTime('2022-08-18')) {
                foreach ($catalogs_title as $key => $value) {
                    ${'category_clicks_'.$key++} = Click::with('category')->where('type_click', 'categories')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])->groupBy('category_id')
                    ->select('category_id', DB::raw($count_total))->get();
                }
                
                foreach ($catalogs_title as $key => $value) {
                    ${'state_clicks_'.$key++} = Click::where('type_click', 'state')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->groupBy('name_click')->select('name_click as title', DB::raw($count_total))->get();
                }
        
                foreach ($catalogs_title as $key => $value) {
                    ${'gender_clicks_'.$key++} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->groupBy('name_click')->select('name_click as title', DB::raw($count_total))->get();
                }
        
                foreach ($catalogs_title as $key => $value) {
                    ${'floating_clicks_'.$key++} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->groupBy('name_click')->select('name_click as title', DB::raw($count_total))->get();
                }
            } else {
                foreach ($catalogs_title as $key => $value) {
                    ${'category_'.$key} = Click::with('category')->where('type_click', 'categories')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->groupBy('category_id')->select('category_id', DB::raw($count_total))->orderBy('category_id')->get()->toArray();
        
                    ${'clicks_'.$key} = Click::where('type_click', 'categories')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('category_id')->get()->toArray();
        
                    ${'category_clicks_'.$key} = collect();
        
                    if($key < 2) {
                        for ($index = 0 ; $index < count(${'category_'.$key}); $index ++) {
                            ${'total_counts_'.$index} = array('category_id' => ${'category_'.$key}[$index]['category_id'], 
                            'category' => ${'category_'.$key}[$index]['category'],
                            'total' => ${'clicks_'.$key}[$index]['clicks']+${'category_'.$key}[$index]['total']);
                            
                            ${'category_clicks_'.$key}->push(${'total_counts_'.$index});
                        }
                    }
                    
                    $key++;
                }
                
                $category_clicks_2 = Click::where('type_click', 'categories')->where('catalog_id', 4)->select(DB::raw('*'), DB::raw('clicks as total'))
                ->whereBetween('created_at', [$request->start_date, $request->end_date])->orderBy('category_id')->get();
                
                foreach ($catalogs_title as $key => $value) {
                    ${'state_'.$key} = Click::where('type_click', 'state')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->groupBy('name_click')->select('name_click', DB::raw($count_total))->orderBy('name_click')->get()->toArray();
        
                    ${'state_count_'.$key} = Click::where('type_click', 'state')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('name_click')->get()->toArray();
        
                    ${'state_clicks_'.$key} = collect();
        
                    for ($index = 0 ; $index < count(${'state_'.$key}); $index ++) {
                        ${'total_counts_'.$index} = array('title' => ${'state_'.$key}[$index]['name_click'],
                        'total' => ${'state_count_'.$key}[$index]['clicks']+${'state_'.$key}[$index]['total']);
                        
                        ${'state_clicks_'.$key}->push(${'total_counts_'.$index});
                    }
        
                    $key++;
                }
        
                foreach ($catalogs_title as $key => $value) {
                    ${'gender_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();
        
                    ${'gender_count_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('name_click')->get()->toArray();
        
                    ${'gender_clicks_'.$key} = collect();
        
                    for ($index = 0 ; $index < count(${'gender_'.$key}); $index ++) {
                        ${'total_counts_'.$index} = array('title' => ${'gender_'.$key}[$index]['name_click'],
                        'total' => ${'gender_count_'.$key}[$index]['clicks']+${'gender_'.$key}[$index]['total']);
                        
                        ${'gender_clicks_'.$key}->push(${'total_counts_'.$index});
                    }
        
                    $key++;
                }
        
                foreach ($catalogs_title as $key => $value) {
                    ${'floating_'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', [$request->start_date, $request->end_date])
                    ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();
        
                    
                    ${'floating_count'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-15 00:00:00')->orderBy('name_click')->get()->toArray();
        
                    ${'floating_clicks_'.$key} = collect();
        
                    for ($index = 0 ; $index < count(${'floating_'.$key}); $index ++) {
                        ${'total_counts_'.$index} = array('title' => ${'floating_'.$key}[$index]['name_click'],
                        'total' => ${'floating_count'.$key}[$index]['clicks']+${'floating_'.$key}[$index]['total']);
                        
                        ${'floating_clicks_'.$key}->push(${'total_counts_'.$index});
                    }
        
                    $key++;
                }
            }
            
            foreach ($catalogs_title as $key => $value) {
                ${'ukm_clicks_'.$key++} = Ukm::where('catalog_id', $value->id)->where('whatsapp_clicks', '>', 0)->where('instagram_clicks', '>', 0)->get();
            }
    
            foreach ($catalogs_title as $key => $value) {
                ${'program_clicks_'.$key++} = Click::where('type_click', 'program')->where('catalog_id', $value->id)
                ->whereBetween('created_at', [$request->start_date, $request->end_date])
                ->groupBy('program_id')->select('program_id', DB::raw($count_total))->get();
            }

            $totalVisitors = Analytics::fetchTotalVisitorsAndPageViews(Period::create(new DateTime($startdate), new DateTime($enddate)));
            $mostVisited = Analytics::fetchMostVisitedPages(Period::create(new DateTime($startdate), new DateTime($enddate)), 10);
            $fetchUser = Analytics::fetchUserTypes(Period::create(new DateTime($startdate), new DateTime($enddate)));
            $userDevice = Analytics::performQuery(
                Period::create(new DateTime($startdate), new DateTime($enddate)),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions,ga:pageviews,ga:sessionDuration',
                    'dimensions' => 'ga:deviceCategory',
                ]
            );
            $userCountry = Analytics::performQuery(
                Period::create(new DateTime($startdate), new DateTime($enddate)),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions',
                    'dimensions' => 'ga:country',
                ]
            );

            return response()->json([
                'body' => view('admin.dashboard-click', compact('catalogs_title', 'category_clicks_0', 'category_clicks_1', 'category_clicks_2',
                'mostVisited', 'fetchUser', 'totalVisitors', 'userDevice', 'userCountry', 'state_clicks_0', 'state_clicks_1', 'state_clicks_2',
                'gender_clicks_0', 'gender_clicks_1', 'gender_clicks_2', 'floating_clicks_0', 'floating_clicks_1', 'floating_clicks_2', 'ukm_clicks_0', 
                'ukm_clicks_1', 'ukm_clicks_2', 'program_clicks_0', 'program_clicks_1', 'program_clicks_2'))->render(),
                'userDevices' => $userDevice,
                'userCountry' => $userCountry,
                'totalVisitors' => $totalVisitors,
            ]);
        };

        return view('admin.dashboard', compact('ukms', 'articles', 'catalogs', 'categories', 'catalogs_title', 'category_clicks_0', 'category_clicks_1', 
        'category_clicks_2','mostVisited', 'fetchUser', 'totalVisitors', 'userDevice', 'userCountry', 'state_clicks_0', 'state_clicks_1', 'state_clicks_2',
        'gender_clicks_0', 'gender_clicks_1', 'gender_clicks_2', 'floating_clicks_0', 'floating_clicks_1', 'floating_clicks_2', 'ukm_clicks_0', 
        'ukm_clicks_1', 'ukm_clicks_2', 'program_clicks_0', 'program_clicks_1', 'program_clicks_2'));
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
