<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carte;

class CarteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carte = Carte::latest()->paginate(5);
        return view('cartes.index',compact('carte'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cartes.create');
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
            'num_carte' => 'required',
            'date_creation' => 'required',
            'date_expiration'=> 'required',
            'type_carte'=>'required',
            'clients_id'=>'required',

        ]);
          Carte::create($request->all());
          return redirect()->route('cartes.index')
               ->with('success','Carte crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('cartes.profile', [
            'carte' =>  Carte::FindOrFail($id)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Carte $carte)
    {
        return view('cartes.edit',compact('carte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carte $carte)
    {
        $request->validate([
            'num_carte' => 'required',
            'date_creation' => 'required',
            'date_expiration'=> 'required',
            'type_carte'=>'required',
            'clients_id'=>'required',

        ]);
    
        $carte->update($request->all());
    
        return redirect()->route('cartes.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carte $carte)
    {
        $carte->delete();
    
        return redirect()->route('cartes.index')
                        ->with('success','carte supprimé');
    }
}
