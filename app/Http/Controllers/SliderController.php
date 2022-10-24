<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('admin.slider.index', compact('sliders'));
    }

    public function clicks(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        $slider->clicks = DB::raw('clicks+1');
        $slider->save();

        return \Response::json('success', 200);
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
        $slider = new Slider;

        $request->validate([
            'image' => 'required|image',
            'title' => 'required',
            'link' => 'nullable',
            'type' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/slider-image', $filename);
        }

        $slider->image = $filename;
        $slider->link = $request->link;
        $slider->title = $request->title;
        $slider->type = $request->type;
        $slider->clicks = 0;
        $slider->save();

        return redirect()->route('admin.slider')->with('success','Data berhasil di input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slider = Slider::find($request->id);

        $request->validate([
            'title' => 'required',
            'link' => 'nullable',
            'type' => 'required',
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/slider-image', $filename);
            $slider->image = $filename;
        }

        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->type = $request->type;
        $slider->save();

        return redirect()->route('admin.slider')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slider::find($id)->delete();
        return redirect()->route('admin.slider')->with('success','Data berhasil dihapus');
    }
}
