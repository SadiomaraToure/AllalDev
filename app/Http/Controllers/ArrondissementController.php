<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrondissement;
use App\Models\Departement;

class ArrondissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrondissement = Arrondissement::latest()->paginate(5);

        $departs= Departement::all();
        
      // return view('arrondissements.index',['arrondissement'=>$arrondissement, 'departs'=>$departs])

        return view('arrondissements.index',compact('arrondissement', 'departs'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    

/**
 * liste arrondissement
 */





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return view('arrondissements.create');
        $departs= Departement::all();
        
    return view('arrondissements.create',compact('departs'));
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
            'departements_id' => 'required',
        ]);

          Arrondissement::create($request->all());
          return redirect()->route('arrondissements.index')
               ->with('success','arrondissement crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departs= Departement::all();

        return view('arrondissements.profile', [
            'arrondissement' => Arrondissement::FindOrFail($id)
        ], compact('departs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Arrondissement $arrondissement)
    {
        $departedite= Departement::all();
      
        return view('arrondissements.edit', compact('arrondissement', 'departedite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arrondissement $arrondissement)
    {
        $request->validate([
            'nom' => 'required',
            'departements_id' => 'required',
        ]);
    
        $arrondissement->update($request->all());
    
        return redirect()->route('arrondissements.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arrondissement $arrondissement)
    {
        $arrondissement->delete();
    
        return redirect()->route('arrondissements.index')
                        ->with('success','arrondissement supprimé');
    }
}
