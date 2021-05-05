<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asc;
use App\Models\Zone;

class AscController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asc = Asc::latest()->paginate(5);
        $zonesASC= Zone::all();

        
        return view('ascs.index',['asc'=>$asc, 'zon'=>$zonesASC])
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones= Zone::all();

        return view('ascs.create', compact('zones'));
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
            'telephone' => 'required',
            'email'=> 'required',
            'adresse'=>'required',
            'zones_id'=>'required',

        ]);
          Asc::create($request->all());
          return redirect()->route('ascs.index')
               ->with('success','Asc crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zones= Zone::all();

        return view('ascs.profile', [
            'asc' => Asc::FindOrFail($id)
        ], compact('zones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asc $asc)
    {
        $zone= Zone::all();
      
        return view('ascs.edit',compact('asc', 'zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asc $asc)
    {
        $request->validate([
            'nom' => 'required',
            'telephone' => 'required',
            'email'=> 'required',
            'adresse'=>'required',
            'zones_id'=>'required',

        ]);
    
        $asc->update($request->all());
    
        return redirect()->route('ascs.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asc $asc)
    {
        $asc->delete();
    
        return redirect()->route('ascs.index')
                        ->with('success','asc supprimé');
    }
}
