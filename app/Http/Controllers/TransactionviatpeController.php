<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactionviatpes;

class TransactionviatpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionviatpe = Transactionviatpes::latest()->paginate(5);
        return view('transactionviatpes.index',compact('transactionviatpe'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactionviatpes.create');
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
            'cartes_id'=>'required',
            'tpes_id'=>'required',

        ]);

        Transactionviatpes::create($request->all());
          return redirect()->route('transactionviatpes.index')
               ->with('success','transactionviatpe crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('transactionviatpes.profile', [
            'transactionviatpe' => Transactionviatpes::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactionviatpes $transactionviatpe)
    {
        return view('transactionviatpes.edit',compact('transactionviatpe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactionviatpes $transactionviatpe)
    {
        $request->validate([
            'montant' => 'required',
            'frais' => 'required',
            'type_transaction'=> 'required',
            'date_transaction'=>'required',
            'cartes_id'=>'required',
            'tpes_id'=>'required',

        ]);
    
        $transactionviatpe->update($request->all());
    
        return redirect()->route('transactionviatpes.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactionviatpes $transactionviatpe)
    {
        $transactionviatpe->delete();
    
        return redirect()->route('transactionviatpes.index')
                        ->with('success','transactionviatpe supprimé');
    }
}
