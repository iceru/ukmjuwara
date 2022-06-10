<?php

namespace App\Http\Controllers;

use App\Models\Cta;
use Illuminate\Http\Request;

class CtaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ctas = Cta::all();
        return view('admin.cta.index', compact('ctas'));
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
        $cta = new Cta;

        $request->validate([
            'image' => 'required|image',
            'image_mobile' => 'required|image',
            'title' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/cta-image', $filename);
        }
        $cta->image = $filename;

        if ($request->hasFile('image_mobile')) {
            $extension = $request->file('image_mobile')->getClientOriginalExtension();
            $filename_mobile = 'mobileCta__'.time().'.'.$extension;
            $path = $request->image_mobile->storeAs('public/cta-image', $filename_mobile);
        }

        $cta->image_mobile = $filename_mobile;

        $cta->title = $request->title;
        $cta->link = $request->link;
        $cta->description = $request->description;
        $cta->save();

        return redirect()->route('admin.cta')->with('success','Data berhasil di input'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cta  $cta
     * @return \Illuminate\Http\Response
     */
    public function show(Cta $cta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cta  $cta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cta = Cta::find($id);

        return view('admin.cta.edit', compact('cta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cta  $cta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cta $cta)
    {
        $cta = Cta::find($request->id);

        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'description' => 'required',
            'image_mobile' => 'nullable',
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $request->title.'_'.time().'.'.$extension;
            $path = $request->image->storeAs('public/cta-image', $filename);
            $cta->image = $filename;
        }

        if ($request->hasFile('image_mobile')) {
            $extension = $request->file('image_mobile')->getClientOriginalExtension();
            $filename_mobile = 'mobileCta_'.time().'.'.$extension;
            $path = $request->image_mobile->storeAs('public/cta-image', $filename_mobile);
            $cta->image_mobile = $filename_mobile;
        }

        $cta->title = $request->title;
        $cta->link = $request->link;
        $cta->description = $request->description;
        $cta->save();

        return redirect()->route('admin.cta')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cta  $cta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cta $cta)
    {
        //
    }
}
