<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactionviamobiles;

class TransactionviamobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionviamobile = Transactionviamobiles::latest()->paginate(5);
        return view('transactionviamobiles.index',compact('transactionviamobile'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactionviamobiles.create');
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
            'montant' => 'required',
            'frais' => 'required',
            'type_transaction'=> 'required',
            'date_transaction'=>'required',
            'comptes_id'=>'required',
            'telephone'=>'required',

        ]);

        Transactionviamobiles::create($request->all());
          return redirect()->route('transactionviamobiles.index')
               ->with('success','transactionviamobile crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('transactionviamobiles.profile', [
            'transactionviamobile' => Transactionviamobiles::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactionviamobiles $transactionviamobile)
    {
        return view('transactionviamobiles.edit',compact('transactionviamobile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactionviamobiles $transactionviamobile)
    {
        $request->validate([
            'montant' => 'required',
            'frais' => 'required',
            'type_transaction'=> 'required',
            'date_transaction'=>'required',
            'comptes_id'=>'required',
            'telephone'=>'required',

        ]);
    
        $transactionviamobile->update($request->all());
    
        return redirect()->route('transactionviamobiles.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactionviamobiles $transactionviamobile)
    {
        $transactionviamobile->delete();
    
        return redirect()->route('transactionviamobiles.index')
                        ->with('success','transactionviamobile supprimé');
    }
}
