<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\UkmSlider;
use Illuminate\Http\Request;

class UkmSlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = UkmSlider::all();
        $ukms = Ukm::all();
        return view('admin.ukm-sliders.index', compact('sliders', 'ukms'));
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
        $slider = new UkmSlider;

        $request->validate([
            'image' => 'required|image',
            'link' => 'nullable',
            'ukm' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $request->image->storeAs('public/ukm-slider', $filename);
        }

        $slider->image = $filename;
        $slider->link = $request->link;
        $slider->ukm_id = $request->ukm;
        $slider->save();

        return redirect()->route('admin.ukm-sliders')->with('success','Data berhasil di input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sliders = UkmSlider::where('ukm_id', $id)->get();
        $ukm = Ukm::where('id', $id)->first();

        return view('admin.ukm-sliders.show', compact('sliders', 'ukm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = UkmSlider::find($id);
        $ukms = Ukm::all();

        return view('admin.ukm-sliders.edit', compact('slider', 'ukms'));
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
        $slider = Slider::find($request->id);

        $request->validate([
            'title' => 'required',
            'link' => 'nullable',
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $request->image->storeAs('public/ukm-slider', $filename);
            $slider->image = $filename;
        }

        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->save();

        return redirect()->route('admin.ukm-sliders')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UkmSlider::find($id)->delete();
        return redirect()->route('admin.ukm-sliders')->with('success','Data berhasil dihapus');
    }
}
