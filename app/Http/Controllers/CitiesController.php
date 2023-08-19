<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $cities = City::select('id','name_en','name_ar')->first();
       $cities = City::all();
        return view('dashboard.views-dash.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('dashboard.views-dash.city.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en'=> 'required',
            'name_ar'=> 'required'
        ]);

        City::create([
            'name_en' =>$request->name_en,
            'name_ar' =>$request->name_ar,
        ]);

        return redirect()->route('city.index')->with('msg', 'City added successfully')->with('type', 'success');
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
       $cities = City::findOrFail($id);
       return view('dashboard.views-dash.city.edit', compact('cities'));


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
        $request->validate([
            'name_en'=> 'required',
            'name_ar'=> 'required'
        ]);

        $cities = City::findOrFail($id);

        $cities->update([
            'name_en' =>$request->name_en,
            'name_ar' =>$request->name_ar,
        ]);

        return redirect()->route('city.index')->with('msg', 'City updated successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cities = City::findOrFail($id);
        $cities->delete();
        return redirect()->route('city.index')->with('msg', 'City deleted successfully')->with('type', 'danger');
    }
}
