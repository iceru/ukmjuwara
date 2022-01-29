<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class UkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('katalog');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ukm = Ukm::with('catalog')->where('slug', $slug)->firstOrFail();
        $state_name = '';
        $city_name = '';
        $sub_name = '';
        if($ukm->state) {
            $state_res = Http::get('https://ibnux.github.io/data-indonesia/propinsi.json');
            $states = json_decode($state_res->body());
            foreach ($states as $item){
                if($item->id == $ukm->state) {
                    $state_name = strtolower($item->nama);
                    if($state_name == "dki jakarta") {
                        $state_name = "DKI Jakarta";
                    }
                }
            }
            $city_res = Http::get('https://ibnux.github.io/data-indonesia/kabupaten/'.$ukm->state.'.json');
            $cities = json_decode($city_res->body());
            foreach ($cities as $item){
                if($item->id == $ukm->city) {
                    $city_name = strtolower($item->nama);
                }
            }

            $subDiscrict_res = Http::get('https://ibnux.github.io/data-indonesia/kecamatan/'.$ukm->city.'.json');
            $subDistricts = json_decode($subDiscrict_res->body());
            foreach ($subDistricts as $item){
                if($item->id == $ukm->subDistrict) {
                    $sub_name = strtolower($item->nama);
                }
            }
        }

        $categoryId = array();
        foreach($ukm->categories as $category) {
            array_push($categoryId, $category->id);
        }

        $relatedUkms = Ukm::where('id', '!=', $ukm->id)->whereHas('categories', function($query) use($categoryId, $ukm) {
            $query->whereIn('category_id', $categoryId);
        })->get()->take(4);

        views($ukm)
        ->cooldown(10)
        ->record();
        
        $view = views($ukm)->count();
    
        return view('ukm', compact('ukm', 'view', 'city_name', 'sub_name', 'state_name', 'relatedUkms'));
    }

    public function whatsapp(Request $request)
    {
        if($request->ajax()) {
            $ukmIncrement = Ukm::where('id',$request->ukm)->increment('whatsapp_clicks', 1);

            dd(Ukm::where('id', $request->ukm)->first());
        }
    }

    public function instagram(Request $request)
    {
        if($request->ajax()) {
            Ukm::where('id',$request->ukm)->increment('instagram_clicks', 1);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukm $ukm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ukm $ukm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ukm  $ukm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukm $ukm)
    {
        //
    }
}
