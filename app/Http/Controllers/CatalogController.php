<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
            'slug' => 'nullable',
            'link' => 'nullable',
            'image' => 'required|image'
        ]);

        $catalog->title = $request->title;        
        $catalog->slug = Str::slug($request->title);
        $catalog->link = $request->link;
        $catalog->featured = $request->featured;
        
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
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
        $ukms = Ukm::where('catalog_id', $catalog->id)->orderBy('title')->paginate(4);
        $bests = Ukm::where('catalog_id', $catalog->id)->orderByViews('desc', Period::since('2021-11-18'))->get()->take(8);
        $states = Ukm::where('catalog_id', $catalog->id)->select('state_name')->distinct()->where('state_name', '!=', '')->get();
        $categories = Category::take(6)->get();

        if ($request->ajax()) {
            $ukms = Ukm::where('catalog_id', $request->catalog);

            if (isset($request->categories)) {
                $categoryId = Category::whereIn('id', request('categories'))->pluck('id');
                $ukms = $ukms->whereHas('categories', function($q) use($categoryId) {
                    $q->whereIn('category_id', $categoryId);
                });
            }

            if (isset($request->states)) {
                $ukms = $ukms->whereIn('state_name', $request->states);
            }

            if (isset($request->owner_genders)) {
                $ukms = $ukms->whereIn('owner_gender', $request->owner_genders);
            }

            if (isset($request->search)) {
                $ukms = $ukms->where('title', 'LIKE','%'.$request->search.'%');
            }

            $ukms = $ukms->orderBy('title')->paginate(4);
            return view('catalog-ukm', compact('ukms'));
        }
        
        return view('catalog', compact('catalog','ukms', 'bests', 'categories', 'states'));
    }

    public function filter(Request $request)
    {
        
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
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/catalog-image', $filename);
            $catalog->image = $filename;
        }
        
        $catalog->title = $request->title;
        $catalog->slug = Str::slug($request->title);
        $catalog->link = $request->link;
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
