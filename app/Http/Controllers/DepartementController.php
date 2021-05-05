<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departement = Departement::latest()->paginate(5);
        return view('departements.index',compact('departement'))
        ->with('i', (request()->input('page', 1) -1) * 5);
        
    }


    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departements.create');
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
            'Nomdepartement' => 'required',
            'IDregion' => 'required',
        ]);
        
        Departement::create($request->all());
          return redirect()->route('departements.index')
               ->with('success','departements crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('departements.profile', [
            'departement' => Departement::FindOrFail($id)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        return view('departements.edit',compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'Nomdepartement' => 'required',
            'IDregion' => 'required',
        ]);
    
        $departement->update($request->all());
    
        return redirect()->route('departements.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
    
        return redirect()->route('departements.index')
                        ->with('success','departement supprimé');
    }
}
