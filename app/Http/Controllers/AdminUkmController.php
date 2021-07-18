<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
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

        return view('admin.ukm.index', compact('ukms'));
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
            'inputTitle' => 'required',
            'inputDescription' => 'required',
            'inputWhatsapp' => 'required',
            'inputImage' => 'required',
            'inputImage.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'inputInstagram' => 'required',
        ]);

        if ($request->hasFile('inputImage')) {

            $images = $request->file('inputImage');

            foreach($images as $image) {
                $name = $image->getClientOriginalName();
                $filename = $request->inputTitle.'_'.time().'.'.$name;
                $path = $image->storeAs('public/ukm-image', $filename);
                $data[] = $filename;
            }
        }
        $ukm->images=json_encode($data);

        $ukm->title = $request->inputTitle;
        $ukm->slug = Str::slug($request->inputTitle);
        $ukm->description = $request->inputDescription;
        $ukm->whatsapp = $request->inputWhatsapp;
        $ukm->instagram = $request->inputInstagram;

        $ukm->save();

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

        return view('admin.ukm.edit', compact('ukm'));
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
            'slug' => 'required',
            'whatsapp' => 'required',
            'image' => 'nullable',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'instagram' => 'required',
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

        $ukm->save();

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
