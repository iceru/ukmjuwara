<?php

namespace App\Http\Controllers;

use App\Models\Cta;
use App\Models\Ukm;
use App\Models\Click;
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
    public function index(Request $request)
    {
        $sliderDesktop = Slider::where('type', 'desktop')->get();
        $sliderMobile = Slider::where('type', 'mobile')->get();
        $sponsors = Sponsor::where('type', 'dipersembahkan')->get();
        $sponsors_dukung = Sponsor::where('type', 'didukung')->get();
        $featured = Catalog::where('featured', 'yes')->take(2)->get();
        $articles = Article::orderBy('created_at', 'desc')->get()->take(2);
        $cta = Cta::first();

        $catalogAll = Catalog::with('ukm')->where('slug', 'semua-brand')->firstOrFail();
        $bests_all = Ukm::all()->random(8);
        $categories_all = Category::all();
        $programs_all = Program::all();
        $states_all = Ukm::select('state_name')->distinct()->where('state_name', '!=', '')->get();
        $max_price_all = Ukm::max('max_price');
        $min_price_all = Ukm::min('min_price');

        $catalogDigital = Catalog::with('ukm')->where('slug', 'ukmjuwara-go-digital')->firstOrFail();
        $bests_digital = Ukm::where('catalog_id', $catalogDigital->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
        $categories_digital = Category::whereHas('ukms', function($q) use($catalogDigital) {
            $q->where('catalog_id', $catalogDigital->id);
        })->get();
        $programs_digital = Program::whereHas('ukm', function($q) use($catalogDigital) {
            $q->where('catalog_id', $catalogDigital->id);
        })->get();
        $states_digital = Ukm::where('catalog_id', $catalogDigital->id)->select('state_name')->distinct()->where('state_name', '!=', '')->get();
        $max_price_digital = Ukm::where('catalog_id', $catalogDigital->id)->max('max_price');
        $min_price_digital = Ukm::where('catalog_id', $catalogDigital->id)->min('min_price');

        $catalogGlobal = Catalog::with('ukm')->where('slug', 'ukmjuwara-go-global')->firstOrFail();
        $bests_global = Ukm::where('catalog_id', $catalogGlobal->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
        $categories_global = Category::whereHas('ukms', function($q) use($catalogGlobal) {
            $q->where('catalog_id', $catalogGlobal->id);
        })->get();
        $programs_global = Program::whereHas('ukm', function($q) use($catalogGlobal) {
            $q->where('catalog_id', $catalogGlobal->id);
        })->get();
        $states_global = Ukm::where('catalog_id', $catalogGlobal->id)->select('state_name')->distinct()->where('state_name', '!=', '')->get();
        $max_price_global = Ukm::where('catalog_id', $catalogGlobal->id)->max('max_price');
        $min_price_global = Ukm::where('catalog_id', $catalogGlobal->id)->min('min_price');

        if ($request->ajax() && (int)$request->catalog === $catalogDigital->id) {
            $bests_digital = Ukm::where('catalog_id', $catalogDigital->id);
            if(isset($request->min_price) || isset($request->max_price)) {
                $bests_digital = $bests_digital->where('min_price', '>=', $request->min_price)->where('max_price', '<=', $request->max_price); 
            }
            if (isset($request->categories)) {
                if(is_string($request->categories)) {
                    $categories_array = explode(',', $request->categories);
                } else {
                    $categories_array = $request->categories;
                }
                $categoryId = Category::whereIn('id', $categories_array)->pluck('id');
                $bests_digital = $bests_digital->whereHas('categories', function($q) use($categoryId) {
                    $q->whereIn('category_id', $categoryId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'category') {
                    Click::create(
                        ['catalog_id' => $catalogDigital->id, 'type_click' => 'categories', 'name_click' => 'category', 'category_id' => array_slice($categories_array, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->programs)) {
                if(is_string($request->programs)) {
                    $programs_array = explode(',', $request->programs);
                } else {
                    $programs_array = $request->programs;
                }
                $programId = Program::whereIn('id', $programs_array)->pluck('id');
                $bests_digital = $bests_digital->whereHas('program', function($q) use($programId) {
                    $q->whereIn('program_id', $programId);
                });

                if($request->ajax() && $request->record === 'record' && $request->type == 'program') {
                    Click::create(
                        ['catalog_id' => $catalogDigital->id, 'type_click' => 'program',  'name_click' => 'program', 'program_id' => array_slice($programs_array, -1)[0], 'clicks' => 1]
                    );
                }
            }

            if (isset($request->states)) {
                if(is_string($request->states)) {
                    $states_array = explode(',', $request->states);
                } else {
                    $states_array = $request->states;
                }
                $bests_digital = $bests_digital->whereIn('state_name', $states_array);
                if($request->ajax() && $request->record === 'record' && $request->type == 'state') {
                    Click::create(
                        ['catalog_id' => $catalogDigital->id, 'type_click' => 'state', 'name_click' => array_slice($states_array, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->owner_genders)) {
                if(is_string($request->owner_genders)) {
                    $owner_genders = explode(',', $request->owner_genders);
                } else {
                    $owner_genders = $request->owner_genders;
                }
                $bests_digital = $bests_digital->whereIn('owner_gender', $owner_genders);
                if($request->ajax() && $request->record === 'record' && $request->type == 'owner_gender') {
                    Click::create(
                        ['catalog_id' => $catalogDigital->id, 'type_click' => 'gender', 'name_click' => array_slice($owner_genders, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->search)) {
                $bests_digital = $bests_digital->where('title', 'LIKE','%'.$request->search.'%');
            }

            if(!isset($request->categories) && !isset($request->programs) && !isset($request->states) && !isset($request->owner_genders) 
            && !isset($request->search) && (!isset($request->min_price) || (int)$request->min_price === 0) 
            && (!isset($request->max_price) || (int)$request->max_price === $max_price_digital) ) {
                $bests_digital = Ukm::where('catalog_id', $catalogDigital->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
            } else {
                $bests_digital = $bests_digital->orderBy('title')->paginate(16);
            }
            return view('index-digital', compact('bests_digital'));
        }

        if ($request->ajax() && $request->catalog == $catalogGlobal->id) {
            $bests_global = Ukm::where('catalog_id', $catalogGlobal->id);
            if(isset($request->min_price_global) || isset($request->max_price_global)) {
                $bests_global = $bests_global->where('min_price', '>=', $request->min_price_global)->where('max_price', '<=', $request->max_price_global); 
            }
            if (isset($request->categories_global)) {
                if(is_string($request->categories_global)) {
                    $categories_array = explode(',', $request->categories_global);
                } else {
                    $categories_array = $request->categories_global;
                }
                $categoryId = Category::whereIn('id', $categories_array)->pluck('id');
                $bests_global = $bests_global->whereHas('categories', function($q) use($categoryId) {
                    $q->whereIn('category_id', $categoryId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'category') {
                    Click::create(
                        ['catalog_id' => $catalogGlobal->id, 'type_click' => 'categories', 'name_click' => 'category', 'category_id' => array_slice($categories_array, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->programs_global)) {
                if(is_string($request->programs_global)) {
                    $programs_array = explode(',', $request->programs_global);
                } else {
                    $programs_array = $request->programs_global;
                }
                $programId = Program::whereIn('id', $programs_array)->pluck('id');
                $bests_global = $bests_global->whereHas('program', function($q) use($programId) {
                    $q->whereIn('program_id', $programId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'program') {
                    Click::create(
                        ['catalog_id' => $catalogGlobal->id, 'type_click' => 'program',  'name_click' => 'program', 'program_id' => array_slice($programs_array, -1)[0], 'clicks' => 1]
                    );
                }
            }

            if (isset($request->states_global)) {
                if(is_string($request->states_global)) {
                    $states_array = explode(',', $request->states_global);
                } else {
                    $states_array = $request->states_global;
                }
                $bests_global = $bests_global->whereIn('state_name', $states_array);
                if($request->ajax() && $request->record === 'record' && $request->type == 'state') {
                    Click::create(
                        ['catalog_id' => $catalogGlobal>id, 'type_click' => 'state', 'name_click' => array_slice($states_array, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->owner_genders_global)) {
                if(is_string($request->owner_genders_global)) {
                    $owner_genders = explode(',', $request->owner_genders_global);
                } else {
                    $owner_genders = $request->owner_genders_global;
                }
                $bests_global = $bests_global->whereIn('owner_gender', $owner_genders);
                if($request->ajax() && $request->record === 'record' && $request->type == 'owner_gender') {
                    Click::create(
                        ['catalog_id' => $catalogGlobal->id, 'type_click' => 'gender', 'name_click' => array_slice($owner_genders, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->search_global)) {
                $bests_global = $bests_global->where('title', 'LIKE','%'.$request->search.'%');
            }

            if(!isset($request->categories_global) && !isset($request->programs_global) && !isset($request->states_global) 
            && !isset($request->owner_genders_global) && !isset($request->search_global) && (!isset($request->min_price_global) || 
            (int)$request->min_price_global === 0) && (!isset($request->max_price_global) || (int)$request->max_price_global === $max_price_global) ) {
                $bests_global = Ukm::where('catalog_id', $catalogGlobal->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
            } else {
                $bests_global = $bests_global->orderBy('title')->paginate(16);
            }
            return view('index-global', compact('bests_global'));
            
        }

        if ($request->ajax() && $request->catalog == $catalogAll->id) {
            $bests_all = Ukm::orderBy('title');
            if(isset($request->min_price_all) || isset($request->max_price_all)) {
                $bests_all = $bests_all->where('min_price', '>=', $request->min_price_all)->where('max_price', '<=', $request->max_price_all); 
            }
            if (isset($request->categories_all)) {
                if(is_string($request->categories_all)) {
                    $categories_array = explode(',', $request->categories_all);
                } else {
                    $categories_array = $request->categories_all;
                }
                $categoryId = Category::whereIn('id', $categories_array)->pluck('id');
                $bests_all = $bests_all->whereHas('categories', function($q) use($categoryId) {
                    $q->whereIn('category_id', $categoryId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'category') {
                    Click::create(
                        ['catalog_id' => $catalogAll->id, 'type_click' => 'categories', 'name_click' => 'category', 'category_id' => array_slice($categories_array, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->programs_all)) {
                if(is_string($request->programs_all)) {
                    $programs_array = explode(',', $request->programs_all);
                } else {
                    $programs_array = $request->programs_all;
                }
                $programId = Program::whereIn('id', $programs_array)->pluck('id');
                $bests_all = $bests_all->whereHas('program', function($q) use($programId) {
                    $q->whereIn('program_id', $programId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'program') {
                    Click::create(
                        ['catalog_id' => $catalogAll->id, 'type_click' => 'program',  'name_click' => 'program', 'program_id' => array_slice($programs_array, -1)[0], 'clicks' => 1]
                    );
                }
            }

            if (isset($request->states_alll)) {
                if(is_string($request->states_alll)) {
                    $states_array = explode(',', $request->states_alll);
                } else {
                    $states_array = $request->states_alll;
                }
                $bests_all = $bests_all->whereIn('state_name', $states_array);
                if($request->ajax() && $request->record === 'record' && $request->type == 'state') {
                    Click::create(
                        ['catalog_id' => $catalogAll>id, 'type_click' => 'state', 'name_click' => array_slice($states_array, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->owner_genders_all)) {
                if(is_string($request->owner_genders_all)) {
                    $owner_genders = explode(',', $request->owner_genders_all);
                } else {
                    $owner_genders = $request->owner_genders_all;
                }
                $bests_all = $bests_all->whereIn('owner_gender', $owner_genders);
                if($request->ajax() && $request->record === 'record' && $request->type == 'owner_gender') {
                    Click::create(
                        ['catalog_id' => $catalogAll->id, 'type_click' => 'gender', 'name_click' => array_slice($owner_genders, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->search_all)) {
                $bests_all = $bests_all->where('title', 'LIKE','%'.$request->search.'%');
            }

            if(!isset($request->categories_all) && !isset($request->programs_all) && !isset($request->states_all) 
            && !isset($request->owner_genders_all) && !isset($request->search_all) && (!isset($request->min_price_all) || 
            (int)$request->min_price_all === 0) && (!isset($request->max_price_all) || (int)$request->max_price_all === $max_price_all) ) {
                $bests_all = Ukm::orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
            } else {
                $bests_all = $bests_all->paginate(16);
            }
            return view('index-all', compact('bests_all'));
            
        }
        
        return view('index', compact('sliderDesktop', 'sliderMobile', 'featured', 'sponsors', 'sponsors_dukung',  'articles', 'cta',
        'bests_global', 'categories_digital', 'categories_global', 'programs_global', 'states_global', 'catalogGlobal', 'min_price_global', 'max_price_global',
        'bests_all', 'programs_all', 'states_all', 'catalogAll', 'min_price_all', 'max_price_all','categories_all', 
        'bests_digital',  'programs_digital', 'states_digital', 'catalogDigital', 'min_price_digital', 'max_price_digital'));
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

    public function sitemap()
    {
        $posts = Article::orderBy('updated_at', 'DESC')->get();
        $catalogs = Catalog::all();
        $ukms = Ukm::all();
        return response()->view('sitemap', compact('posts', 'catalogs', 'ukms'))->header('Content-Type', 'text/xml');
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