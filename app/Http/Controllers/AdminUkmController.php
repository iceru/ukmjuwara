<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Catalog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukms = Ukm::all();
        $catalogs = Catalog::all();
        $categories = Category::pluck('title')->toArray();

        return view('admin.ukm.index', compact('ukms', 'catalogs', 'categories'));
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
        $ukm = new Ukm;

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'whatsapp' => 'required',
            'image' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'instagram' => 'required',
            'catalog' => 'required',
            'categories' => 'nullable|string|regex:/^([a-z0-9\s]+,)*([a-z0-9\s]+){1}$/i',
        ]);

        if ($request->hasFile('image')) {

            $images = $request->file('image');

            foreach($images as $image) {
                $name = $image->getClientOriginalName();
                $filename = $request->title.'_'.time().'.'.$name;
                $path = $image->storeAs('public/ukm-image', $filename);
                $data[] = $filename;
            }
        }
        $ukm->images=json_encode($data);

        $ukm->title = $request->title;
        $ukm->slug = Str::slug($request->title);
        $ukm->description = $request->description;
        $ukm->whatsapp = $request->whatsapp;
        $ukm->instagram = $request->instagram;
        $ukm->catalog_id = $request->catalog;

        $ukm->save();

        $categoryArray = explode(',', $request->categories);
        $categories = array();

        foreach($categoryArray as $ukmCategory) {
            $category = Category::firstOrCreate([
                'title' => $ukmCategory
            ]);

            $categories[$category->id] = ['ukm_id' => $ukm->id];
        }

        $ukm->categories()->attach($categories);

        return redirect()->route('admin.ukm')->with('success','Data berhasil di input');
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
        $ukm = Ukm::findOrFail($id);
        $catalogs = Catalog::all();
        $categories = Category::pluck('title')->toArray();
        $array = array();

        foreach($ukm->categories as $category) {
            array_push($array, $category->title);
        }

        $categories_array = implode(", ", $array);
        return view('admin.ukm.edit', compact('ukm', 'catalogs', 'categories', 'categories_array'));
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
        $ukm = Ukm::find($request->id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'slug' => 'nullable',
            'whatsapp' => 'required',
            'image' => 'nullable',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'instagram' => 'required',
            'catalog' => 'required',
            'categories' => 'nullable|string|regex:/^([a-z0-9\s]+,)*([a-z0-9\s]+){1}$/i',
        ]);

        if ($request->hasFile('image')) {

            $images = $request->file('image');

            foreach($images as $image) {
                $name = $image->getClientOriginalName();
                $filename = $request->inputTitle.'_'.time().'.'.$name;
                $path = $image->storeAs('public/ukm-image', $filename);
                $data[] = $filename;
            }

            $ukm->images=json_encode($data);
        }

        $ukm->title = $request->title;
        $ukm->slug = Str::slug($request->title);
        $ukm->description = $request->description;
        $ukm->whatsapp = $request->whatsapp;
        $ukm->instagram = $request->instagram;
        $ukm->catalog_id = $request->catalog;

        $ukm->save();

        $categoryArray = explode(',', $request->categories);
        $categories = array();

        foreach($categoryArray as $ukmCategory) {
            $category = Category::firstOrCreate([
                'title' => $ukmCategory
            ]);

            $categories[$category->id] = ['ukm_id' => $ukm->id];
        }

        $ukm->categories()->sync($categories);

        return redirect()->route('admin.ukm')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ukm = Ukm::findOrFail($id);
        Storage::disk('public')->delete('ukm-image/'.$ukm->image);

        Ukm::find($id)->delete();
        return redirect()->route('admin.ukm')->with('success', 'Data berhasil dihapus');
    }
}
