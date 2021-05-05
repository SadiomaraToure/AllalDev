<?php

namespace App\Http\Controllers;

use App\Models\Asc;
use Illuminate\Http\Request;
use App\Models\Pointdevente;



class PointdeventeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pointdeventes = Pointdevente::latest()->paginate(5);

        $ascs = Asc::all();

        return view('pointdeventes.index',compact('pointdeventes', 'ascs'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ascs = Asc::all();

        return view('pointdeventes.create', compact('ascs'));
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
            'adresse' => 'required',
            'ascs_id' => 'required',
            'admins_id'=> 'required',

        ]);

          Pointdevente::create($request->all());
          return redirect()->route('pointdeventes.index')
               ->with('success','pointdevente crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pointdeventes.profile', [
            'pointdevente' => Pointdevente::FindOrFails($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pointdevente $pointdevente)
    {
        $ascs = Asc::all();

        return view('pointdeventes.edit',compact('pointdevente', 'ascs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pointdevente $pointdevente)
    {
        $request->validate([
            'adresse' => 'required',
            'ascs_id' => 'required',
            'admins_id'=> 'required',
            
        ]);
    
        $pointdevente->update($request->all());
    
        return redirect()->route('pointdeventes.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pointdevente $pointdevente)
    {
        $pointdevente->delete();
    
        return redirect()->route('pointdeventes.index')
                        ->with('success','pointdevente supprimé');
    }
}
