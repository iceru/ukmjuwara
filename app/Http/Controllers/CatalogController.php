<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
    public function show($slug)
    {
        $catalog = Catalog::where('slug', $slug)->firstOrFail();
        $ukms = Ukm::where('catalog_id', $catalog->id)->get();
        $bests = Ukm::where('catalog_id', $catalog->id)->orderByViews()->get()->take(4);
        $cities = Ukm::where('catalog_id', $catalog->id)->select('city_name')->distinct()->where('city_name', '!=', '')->get();
        $categories = Category::take(6)->get();
        
        return view('catalog', compact('catalog','ukms', 'bests', 'categories', 'cities'));
    }

    public function filter(Request $request)
    {
        if($request->categories) {
            $categories = $request->categories;
            $categoryId = Category::whereIn('id', $categories)->pluck('id');

            $ukms = Ukm::where('catalog_id', $request->catalog)->whereHas('categories', function($query) use($categoryId) {
                $query->whereIn('category_id', $categoryId);
            })->get();
        }
        elseif ($request->cities) {
            $cities = $request->cities;
            $ukms = Ukm::where('catalog_id', $request->catalog)->whereIn('city_name', $cities)->get();
        }
        else {
            $ukms = Ukm::where('catalog_id', $request->catalog)->get();
        }
        response()->json($ukms);

        return view('catalog-ukm', compact('ukms'));
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
