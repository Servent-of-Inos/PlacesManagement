<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PlacesRepository;
use App\Place;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PlacesRepository $repository)
    {
        if (!$request->has('place')) {

            $places = Place::orderBy('address', 'asc')->paginate(20);
    
        } else {
 
            $places = collect($repository->addDistance(request('place')))->paginate(20);
       
        }

        return $places;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|string|max:191',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        Place::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::where('id',$id)->get();

        return $place;
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
        $this->validate($request, [
            'address' => 'required|string|max:191',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        Place::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id)->delete();
    }
}
