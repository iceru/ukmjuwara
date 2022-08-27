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
use Excel;
use Spatie\Analytics\Period;
use App\Exports\ClicksExport;
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
        $mostVisited = Analytics::performQuery(
            Period::days(7), 
            'ga:uniquePageviews', [
            'metrics' => 'ga:uniquePageviews, ga:pageviews',
            'dimensions' => 'ga:pagePath', 
            'sort' => '-ga:pageviews',
            'max-results' => '12'
        ]);
        $topReferrers = Analytics::fetchTopReferrers(Period::days(7), 7);
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
            ->where('created_at', '<=', '2022-08-25 00:00:00')->orderBy('category_id')->get()->toArray();

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
            ->where('created_at', '<=', '2022-08-25 00:00:00')->orderBy('name_click')->get()->toArray();

            ${'state_clicks_'.$key} = collect();
            if($key < 2) {
                for ($index = 0 ; $index < count(${'state_'.$key}); $index ++) {
                    ${'total_counts_'.$index} = array('title' => ${'state_'.$key}[$index]['name_click'],
                    'total' => ${'state_count_'.$key}[$index]['clicks']+${'state_'.$key}[$index]['total']);
                    
                    ${'state_clicks_'.$key}->push(${'total_counts_'.$index});
                }
            }


            $key++;
        }

        $state_clicks_2 = Click::where('type_click', 'state')->where('catalog_id', 4)->groupBy('name_click')
        ->select('name_click as title', DB::raw($count_total))->orderBy('name_click')->get();

        foreach ($catalogs_title as $key => $value) {
            ${'gender_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
            ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();

            ${'gender_count_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
            ->where('created_at', '<=', '2022-08-25 00:00:00')->orderBy('name_click')->get()->toArray();

            ${'gender_clicks_'.$key} = collect();
            if($key < 2) {
            for ($index = 0 ; $index < count(${'gender_'.$key}); $index ++) {
                ${'total_counts_'.$index} = array('title' => ${'gender_'.$key}[$index]['name_click'],
                'total' => ${'gender_count_'.$key}[$index]['clicks']+${'gender_'.$key}[$index]['total']);
                
                ${'gender_clicks_'.$key}->push(${'total_counts_'.$index});
            }
        }

            $key++;
        }
        $gender_clicks_2 = Click::where('type_click', 'gender')->where('catalog_id', 4)->groupBy('name_click')
        ->select('name_click as title', DB::raw($count_total))->orderBy('name_click')->get();

        foreach ($catalogs_title as $key => $value) {
            ${'floating_'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
            ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();

            
            ${'floating_count'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
            ->where('created_at', '<=', '2022-08-28 00:00:00')->orderBy('name_click')->get()->toArray();

            ${'floating_clicks_'.$key} = collect();

            for ($index = 0 ; $index < count(${'floating_'.$key}); $index ++) {
                ${'total_counts_'.$index} = array('title' => ${'floating_'.$key}[$index]['name_click'],
                'total' => ${'floating_count'.$key}[$index]['clicks']+${'floating_'.$key}[$index]['total']);
                
                ${'floating_clicks_'.$key}->push(${'total_counts_'.$index});
            }

            $key++;
        }

        $floating_clicks_2 = Click::where('type_click', 'floating')->where('catalog_id', 4)->groupBy('name_click')
        ->select('name_click as title', DB::raw($count_total))->orderBy('name_click')->get();

        foreach ($catalogs_title as $key => $value) {
            ${'ukm_clicks_'.$key} = Ukm::where('catalog_id' , $value->id)->get();

            ${'ukm_clicks_'.$key} =  ${'ukm_clicks_'.$key}->map(function ($countItem) use($key, $value, $count_total) {
                ${'ukm_'.$key} = Click::where(function($query) {
                    return $query
                        ->where('type_click', 'whatsapp')
                        ->orWhere('type_click', 'instagram');
                    })
                ->where('catalog_id', $value->id)->groupBy('name_click', 'type_click')->select('name_click', 'type_click', DB::raw($count_total))->get();

                $countItem['instagram_clicks'] = $countItem['instagram_clicks'];
                $countItem['whatsapp_clicks'] = $countItem['whatsapp_clicks'];

                foreach(${'ukm_'.$key} as $ukmItem) {
                    if($ukmItem->name_click === $countItem->title ) {
                        if ($ukmItem->type_click == 'instagram') {
                            $countItem['instagram_clicks'] =  $ukmItem->total + $countItem['instagram_clicks'];
                        }
                        if ($ukmItem->type_click == 'whatsapp') {
                            $countItem['whatsapp_clicks'] =  $ukmItem->total + $countItem['whatsapp_clicks'];
                        }
                    }
                };
                return $countItem;
            });

            $key++;
        }

        foreach ($catalogs_title as $key => $value) {
            ${'program_clicks_'.$key++} = Click::where('type_click', 'program')->where('catalog_id', $value->id)->groupBy('program_id')->select('program_id', DB::raw($count_total))->get();
        }

        $start_formatted = new DateTime('2022-01-01');
        $end_formatted = new DateTime();

        if($request->ajax() && $request->start_date != '' && $request->end_date != '') {

            $startdate = \DateTime::createFromFormat('Y-m-d H:i:s', $request->start_date)->format('Y-m-d');
            $enddate = \DateTime::createFromFormat('Y-m-d H:i:s', $request->end_date)->format('Y-m-d');
    
    
            if($startdate) {
                $start_formatted = new DateTime($startdate);
            }
            if($enddate) {
                $end_formatted = new DateTime($enddate);
            }
            if($start_formatted >= new DateTime('2022-08-24')) {
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

                foreach ($catalogs_title as $key => $value) {
                    ${'ukm_clicks_'.$key} = Ukm::where('catalog_id' , $value->id)->get();

                    ${'ukm_clicks_'.$key} =  ${'ukm_clicks_'.$key}->map(function ($countItem) use($key, $value, $count_total, $request) {
                        ${'ukm_'.$key} = Click::where(function($query) {
                            return $query
                                ->where('type_click', 'whatsapp')
                                ->orWhere('type_click', 'instagram');
                            })
                        ->whereBetween('created_at', [$request->start_date, $request->end_date])
                        ->where('catalog_id', $value->id)->groupBy('name_click', 'type_click')->select('name_click', 'type_click', DB::raw($count_total))->get();
                        $countItem['instagram_clicks'] = 0;
                        $countItem['whatsapp_clicks'] = 0;

                        foreach(${'ukm_'.$key} as $ukmItem) {
                            if($ukmItem->name_click === $countItem->title ) {
                                if ($ukmItem->type_click == 'instagram') {
                                    $countItem['instagram_clicks'] =  $ukmItem->total;
                                }
                                if ($ukmItem->type_click == 'whatsapp') {
                                    $countItem['whatsapp_clicks'] =  $ukmItem->total;
                                }
                            }
                        };

                        return $countItem;
                    });

                    $key++;
                }
            } else {
                foreach ($catalogs_title as $key => $value) {
                    ${'category_'.$key} = Click::with('category')->where('type_click', 'categories')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', ['2022-01-01', $request->end_date])
                    ->groupBy('category_id')->select('category_id', DB::raw($count_total))->orderBy('category_id')->get()->toArray();
        
                    ${'clicks_'.$key} = Click::where('type_click', 'categories')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-25 00:00:00')->orderBy('category_id')->get()->toArray();
        
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
                    ->whereBetween('created_at', ['2022-01-01', $request->end_date])
                    ->groupBy('name_click')->select('name_click', DB::raw($count_total))->orderBy('name_click')->get()->toArray();
        
                    ${'state_count_'.$key} = Click::where('type_click', 'state')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-25 00:00:00')->orderBy('name_click')->get()->toArray();
        
                    ${'state_clicks_'.$key} = collect();
                    if($key < 2) {
                        for ($index = 0 ; $index < count(${'state_'.$key}); $index ++) {
                            ${'total_counts_'.$index} = array('title' => ${'state_'.$key}[$index]['name_click'],
                            'total' => ${'state_count_'.$key}[$index]['clicks']+${'state_'.$key}[$index]['total']);
                            
                            ${'state_clicks_'.$key}->push(${'total_counts_'.$index});
                        }
                    }
        
                    $key++;
                }
        
                $state_clicks_2 = Click::where('type_click', 'state')->where('catalog_id', 4)->groupBy('name_click')
                ->select('name_click as title', DB::raw($count_total))->orderBy('name_click')->get();

                foreach ($catalogs_title as $key => $value) {
                    ${'gender_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', ['2022-01-01', $request->end_date])
                    ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();
        
                    ${'gender_count_'.$key} = Click::where('type_click', 'gender')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-25 00:00:00')->orderBy('name_click')->get()->toArray();
        
                    ${'gender_clicks_'.$key} = collect();
                    if($key < 2) {
                        for ($index = 0 ; $index < count(${'gender_'.$key}); $index ++) {
                            ${'total_counts_'.$index} = array('title' => ${'gender_'.$key}[$index]['name_click'],
                            'total' => ${'gender_count_'.$key}[$index]['clicks']+${'gender_'.$key}[$index]['total']);
                            
                            ${'gender_clicks_'.$key}->push(${'total_counts_'.$index});
                        }
                    }
        
                    $key++;
                }

                $gender_clicks_2 = Click::where('type_click', 'gender')->where('catalog_id', 4)->groupBy('name_click')
                ->select('name_click as title', DB::raw($count_total))->orderBy('name_click')->get();

                foreach ($catalogs_title as $key => $value) {
                    ${'floating_'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
                    ->whereBetween('created_at', ['2022-01-01', $request->end_date])
                    ->groupBy('name_click')->select('name_click', DB::raw($count_total))->get()->toArray();
        
                    
                    ${'floating_count'.$key} = Click::where('type_click', 'floating')->where('catalog_id', $value->id)
                    ->where('created_at', '<=', '2022-08-25 00:00:00')->orderBy('name_click')->get()->toArray();
        
                    ${'floating_clicks_'.$key} = collect();
                    if($key < 2) {
                        for ($index = 0 ; $index < count(${'floating_'.$key}); $index ++) {
                            ${'total_counts_'.$index} = array('title' => ${'floating_'.$key}[$index]['name_click'],
                            'total' => ${'floating_count'.$key}[$index]['clicks']+${'floating_'.$key}[$index]['total']);
                            
                            ${'floating_clicks_'.$key}->push(${'total_counts_'.$index});
                        }
                    }
        
                    $key++;
                }

                $floating_clicks_2 = Click::where('type_click', 'floating')->where('catalog_id', 4)->groupBy('name_click')
                ->select('name_click as title', DB::raw($count_total))->orderBy('name_click')->get();
        
                foreach ($catalogs_title as $key => $value) {
                    ${'ukm_clicks_'.$key} = Ukm::where('catalog_id' , $value->id)->get();
        
                    ${'ukm_clicks_'.$key} =  ${'ukm_clicks_'.$key}->map(function ($countItem) use($key, $value, $count_total, $request) {
                        ${'ukm_'.$key} = Click::where(function($query) {
                            return $query
                                ->where('type_click', 'whatsapp')
                                ->orWhere('type_click', 'instagram');
                            })
                        ->whereBetween('created_at', ['2022-01-01', $request->end_date])
                        ->where('catalog_id', $value->id)->groupBy('name_click', 'type_click')->select('name_click', 'type_click', DB::raw($count_total))->get();
                        
                        $countItem['instagram_clicks'] = $countItem['instagram_clicks'];
                        $countItem['whatsapp_clicks'] = $countItem['whatsapp_clicks'];

                        foreach(${'ukm_'.$key} as $ukmItem) {
                            if($ukmItem->name_click === $countItem->title ) {
                                if ($ukmItem->type_click == 'instagram') {
                                    $countItem['instagram_clicks'] =  $ukmItem->total + $countItem['instagram_clicks'];
                                }
                                if ($ukmItem->type_click == 'whatsapp') {
                                    $countItem['whatsapp_clicks'] =  $ukmItem->total + $countItem['whatsapp_clicks'];
                                }
                            }
                        };
                        return $countItem;
                    });
        
                    $key++;
                }
            }
    
            foreach ($catalogs_title as $key => $value) {
                ${'program_clicks_'.$key++} = Click::where('type_click', 'program')->where('catalog_id', $value->id)
                ->whereBetween('created_at', [$request->start_date, $request->end_date])
                ->groupBy('program_id')->select('program_id', DB::raw($count_total))->get();
            }

            $totalVisitors = Analytics::fetchTotalVisitorsAndPageViews(Period::create($start_formatted, $end_formatted));
            $mostVisited = Analytics::performQuery(Period::create(
                $start_formatted, $end_formatted), 
                'ga:uniquePageviews', 
                [
                    'metrics' => 'ga:uniquePageviews, ga:pageviews',
                    'dimensions' => 'ga:pagePath', 
                    'sort' => '-ga:pageviews',
                    'max-results' => '12'
                ]);
            $topReferrers = Analytics::fetchTopReferrers(Period::create($start_formatted, $end_formatted), 7);

            $userDevice = Analytics::performQuery(
                Period::create($start_formatted, $end_formatted),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions,ga:pageviews,ga:sessionDuration',
                    'dimensions' => 'ga:deviceCategory',
                ]
            );
            $userCountry = Analytics::performQuery(
                Period::create($start_formatted, $end_formatted),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions',
                    'dimensions' => 'ga:country',
                ]
            );

            return response()->json([
                'body' => view('admin.dashboard-click', compact('catalogs_title', 'category_clicks_0', 'category_clicks_1', 'category_clicks_2',
                'mostVisited', 'totalVisitors', 'userDevice', 'userCountry', 'state_clicks_0', 'state_clicks_1', 'state_clicks_2',
                'gender_clicks_0', 'gender_clicks_1', 'gender_clicks_2', 'floating_clicks_0', 'floating_clicks_1', 'floating_clicks_2', 'ukm_clicks_0', 
                'ukm_clicks_1', 'ukm_clicks_2', 'program_clicks_0', 'program_clicks_1', 'program_clicks_2', 'start_formatted', 'end_formatted'))->render(),
                'userDevices' => $userDevice,
                'userCountry' => $userCountry,
                'topReferrers'=> $topReferrers,
                'totalVisitors' => $totalVisitors,
            ]);
        };

        return view('admin.dashboard', compact('ukms', 'articles', 'catalogs', 'categories', 'catalogs_title', 'category_clicks_0', 'category_clicks_1', 
        'category_clicks_2','mostVisited', 'totalVisitors', 'topReferrers', 'userDevice', 'userCountry', 'state_clicks_0', 'state_clicks_1', 'state_clicks_2',
        'gender_clicks_0', 'gender_clicks_1', 'gender_clicks_2', 'floating_clicks_0', 'floating_clicks_1', 'floating_clicks_2', 'ukm_clicks_0', 
        'ukm_clicks_1', 'ukm_clicks_2', 'program_clicks_0', 'program_clicks_1', 'program_clicks_2', 'start_formatted', 'end_formatted'));
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

    public function export() 
    {
        return Excel::download(new ClicksExport, 'Dashboard.xlsx');
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
