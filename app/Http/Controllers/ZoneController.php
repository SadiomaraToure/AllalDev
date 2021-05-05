<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrondissement;
use App\Models\Zone;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::latest()->paginate(5);

        $arrondissements= Arrondissement::all();

        return view('zones.index',compact('zones', 'arrondissements'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arrondissements= Arrondissement::all();

        return view('zones.create', compact('arrondissements'));
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
            'nom' => 'required',
            'arrondissements_id' => 'required',
        ]);

          Zone::create($request->all());
          return redirect()->route('zones.index')
               ->with('success','zone crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('zones.profile', [
            'zones' => Zone::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $arrondissement= Arrondissement::all();

        return view('zones.edit',compact('zone', 'arrondissement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zones)
    {
        $request->validate([
            'nom' => 'required',
            'arrondissements_id' => 'required',
        ]);
    
        $zones->update($request->all());
    
        return redirect()->route('zones.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zones)
    {
        $zones->delete();
    
        return redirect()->route('zones.index')
                        ->with('success','zone supprimé');
    }
}
