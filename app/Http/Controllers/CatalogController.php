<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Click;
use App\Models\Catalog;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GoogleTagManager;
use CyrildeWit\EloquentViewable\Support\Period;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::all();
        return view ('admin.catalog.index', compact('catalogs'));
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
        $catalog = new Catalog;

        $request->validate([
            'title' => 'required',
            'featured' => 'required',
            'description' => 'required',
            'slug' => 'nullable',
            'link' => 'nullable',
            'image' => 'required|image'
        ]);

        $catalog->title = $request->title;        
        $catalog->slug = Str::slug($request->title);
        $catalog->link = $request->link;
        $catalog->description = $request->description;
        $catalog->featured = $request->featured;
        
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = 'UKMJuWAra_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/catalog-image', $filename);
        }

        $catalog->image = $filename;


        $catalog->save();

        return redirect()->route('admin.catalog')->with('success','Data berhasil di input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $catalog = Catalog::with('ukm')->where('slug', $slug)->firstOrFail();
        $ukms = Ukm::where('catalog_id', $catalog->id)->orderBy('title')->paginate(16);
        $bests = Ukm::where('catalog_id', $catalog->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
        $states = Ukm::where('catalog_id', $catalog->id)->select('state_name')->distinct()->where('state_name', '!=', '')->get();
        $categories = Category::whereHas('ukms', function($q) use($catalog) {
            $q->where('catalog_id', $catalog->id);
        })->get();
        $programs = Program::whereHas('ukm', function($q) use($catalog) {
            $q->where('catalog_id', $catalog->id);
        })->get();

        $max_price = Ukm::where('catalog_id', $catalog->id)->max('max_price');
        $min_price = Ukm::where('catalog_id', $catalog->id)->min('min_price');

        $totalUkms = count(Ukm::where('catalog_id', $catalog->id)->get());
        $oriTotalUkms = count(Ukm::where('catalog_id', $catalog->id)->get());

        if ($request->categories || $request->states || $request->owner_genders || $request->search || $request->page || $request->programs || $request->min_price || $request->max_price) {
            $ukms = Ukm::where('catalog_id', $catalog->id);
            if(isset($request->min_price) || isset($request->max_price)) {
                $ukms = $ukms->where('min_price', '>=', $request->min_price)->where('max_price', '<=', $request->max_price); 
            }
            if (isset($request->categories)) {
                if(is_string($request->categories)) {
                    $categories_array = explode(',', $request->categories);
                } else {
                    $categories_array = $request->categories;
                }
                $categoryId = Category::whereIn('id', $categories_array)->pluck('id');
                $ukms = $ukms->whereHas('categories', function($q) use($categoryId) {
                    $q->whereIn('category_id', $categoryId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'category') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'categories', 'name_click' => 'category', 'category_id' => array_slice($categories_array, -1)[0], 'clicks' => 1],
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
                $ukms = $ukms->whereHas('program', function($q) use($programId) {
                    $q->whereIn('program_id', $programId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'program') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'program',  'name_click' => 'program', 'program_id' => array_slice($programs_array, -1)[0], 'clicks' => 1]
                    );
                }
            }

            if (isset($request->states)) {
                if(is_string($request->states)) {
                    $states_array = explode(',', $request->states);
                } else {
                    $states_array = $request->states;
                }
                $ukms = $ukms->whereIn('state_name', $states_array);
                if($request->ajax() && $request->record === 'record' && $request->type == 'state') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'state', 'name_click' => array_slice($states_array, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->owner_genders)) {
                if(is_string($request->owner_genders)) {
                    $owner_genders = explode(',', $request->owner_genders);
                } else {
                    $owner_genders = $request->owner_genders;
                }
                $ukms = $ukms->whereIn('owner_gender', $owner_genders);
                if($request->ajax() && $request->record === 'record' && $request->type == 'owner_gender') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'gender', 'name_click' => array_slice($owner_genders, -1)[0], 'clicks' => 1],
                    );
                }
            }

            if (isset($request->search)) {
                $ukms = $ukms->where('title', 'LIKE','%'.$request->search.'%');
            }

            $totalUkms = count($ukms->get());
            $ukms = $ukms->orderBy('title')->paginate(16);
            if($request->ajax()) {
                return view('catalog-ukm', compact('ukms', 'totalUkms', 'oriTotalUkms'));
            } else {
                return view('catalog', compact('catalog','ukms', 'bests', 'categories', 'states', 'programs', 'max_price', 'min_price', 'totalUkms', 'oriTotalUkms'));
            }
        }
        
        return view('catalog', compact('catalog','ukms', 'bests', 'categories', 'states', 'programs', 'max_price', 'min_price', 'totalUkms', 'oriTotalUkms'));
    }

    public function showAll(Request $request)
    {
        $ukms = Ukm::orderBy('title')->paginate(16);
        $catalog = Catalog::where('slug', 'semua-brand')->firstOrFail();
        $catalogs = Catalog::all();
        $bests = Ukm::orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
        $categories_digital = Category::whereHas('ukms', function($q) {
            $q->where('catalog_id', 2);
        })->get();
        $categories_global = Category::whereHas('ukms', function($q) {
            $q->where('catalog_id', 3);
        })->get();
        $categories = Category::all();
        $programs = Program::all();
        $states = Ukm::select('state_name')->distinct()->where('state_name', '!=', '')->get();

        $max_price = Ukm::max('max_price');
        $min_price = Ukm::min('min_price');

        $totalUkms = count(Ukm::all());
        $oriTotalUkms = count(Ukm::all());
            
        if ($request->categories || $request->states || $request->owner_genders || $request->search || $request->page || $request->programs || $request->min_price || $request->max_price) {
            $ukms = Ukm::orderBy('title');
            if(isset($request->min_price) || isset($request->max_price)) {
                $ukms = $ukms->where('min_price', '>=', $request->min_price)->where('max_price', '<=', $request->max_price); 
            }
            if (isset($request->categories)) {
                if(is_string($request->categories)) {
                    $categories_array = explode(',', $request->categories);
                } else {
                    $categories_array = $request->categories;
                }
                $categoryId = Category::whereIn('id', $categories_array)->pluck('id');
                $ukms = $ukms->whereHas('categories', function($q) use($categoryId) {
                    $q->whereIn('category_id', $categoryId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'category') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'categories', 'name_click' => 'category', 'category_id' => array_slice($categories_array, -1)[0], 'clicks' => 1],
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
                $ukms = $ukms->whereHas('program', function($q) use($programId) {
                    $q->whereIn('program_id', $programId);
                });
                if($request->ajax() && $request->record === 'record' && $request->type == 'program') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'program',  'name_click' => 'program', 'program_id' => array_slice($programs_array, -1)[0], 'clicks' => 1],

                    );
                }
            }

            if (isset($request->states)) {
                if(is_string($request->states)) {
                    $states_array = explode(',', $request->states);
                } else {
                    $states_array = $request->states;
                }
                $ukms = $ukms->whereIn('state_name', $states_array);
                if($request->ajax() && $request->record === 'record' && $request->type == 'state') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'state', 'name_click' => array_slice($states_array, -1)[0], 'clicks' => 1],

                    );
                }
            }

            if (isset($request->owner_genders)) {
                if(is_string($request->owner_genders)) {
                    $owner_genders = explode(',', $request->owner_genders);
                } else {
                    $owner_genders = $request->owner_genders;
                }
                $ukms = $ukms->whereIn('owner_gender', $owner_genders);
                if($request->ajax() && $request->record === 'record' && $request->type == 'owner_gender') {
                    Click::create(
                        ['catalog_id' => $catalog->id, 'type_click' => 'gender', 'name_click' => array_slice($owner_genders, -1)[0], 'clicks' => 1],

                    );
                }
            }

            if (isset($request->search)) {
                $ukms = $ukms->where('title', 'LIKE','%'.$request->search.'%');
            }

            $totalUkms = count($ukms->get());

            $ukms = $ukms->paginate(16);

            if($request->ajax()) {
                return view('catalog-ukm', compact('ukms', 'totalUkms', 'oriTotalUkms'));
            } else {
                return view('catalog-all', compact('catalog', 'totalUkms', 'oriTotalUkms', 'ukms', 'bests', 'categories', 'states', 'categories_global', 'categories_digital', 'programs', 'max_price', 'min_price'));
            }
        } 

        return view('catalog-all', compact('catalogs','catalog', 'totalUkms', 'oriTotalUkms', 'categories_global', 'categories_digital', 'ukms', 'bests', 'categories', 'states', 'programs', 'max_price', 'min_price'));
    }


    public function floating(Request $request)
    {
        Click::create(
            ['catalog_id' => $request->catalog, 'type_click' => 'floating', 'name_click' => 'Katalog Whatsapp UKM Indonesia'],
            ['clicks' => \DB::raw('clicks + 1')]
        );

        return 'Success';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog = Catalog::findOrFail($id);

        return view('admin.catalog.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $catalog = Catalog::find($request->id);
        
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'link' => 'nullable',
            'featured' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = 'UKMJuWAra_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/catalog-image', $filename);
            $catalog->image = $filename;
        }
        
        $catalog->title = $request->title;
        $catalog->slug = Str::slug($request->title);
        $catalog->link = $request->link;
        $catalog->description = $request->description;
        $catalog->featured = $request->featured;

        $catalog->save();

        return redirect()->route('admin.catalog')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Catalog::find($id)->delete();

        return redirect()->route('admin.catalog')->with('success', 'Data berhasil dihapus');
    }
}
