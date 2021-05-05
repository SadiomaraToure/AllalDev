<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactionserviceviatpes;

class TransactionserviceviatpesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionserviceviatpe = Transactionserviceviatpes::latest()->paginate(5);
        return view('transactionserviceviatpes.index',compact('transactionserviceviatpe'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactionserviceviatpes.create');
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
            'ref_facture'=> 'required',
            'type_transaction'=>'required',
            'date_transaction'=>'required',
            'entreprise_id'=>'required',
            'tpes_id'=>'required',

        ]);

        Transactionserviceviatpes::create($request->all());
          return redirect()->route('transactionserviceviatpes.index')
               ->with('success','transactionserviceviatpe crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('transactionserviceviatpes.profile', [
            'transactionserviceviatpe' => Transactionserviceviatpes::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactionserviceviatpes $transactionserviceviatpe)
    {
        return view('transactionserviceviatpes.edit',compact('transactionserviceviatpe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactionserviceviatpes $transactionserviceviatpe)
    {
        $request->validate([
            'montant' => 'required',
            'frais' => 'required',
            'ref_facture'=> 'required',
            'type_transaction'=>'required',
            'date_transaction'=>'required',
            'entreprise_id'=>'required',
            'tpes_id'=>'required',

        ]);
    
        $transactionserviceviatpe->update($request->all());
    
        return redirect()->route('transactionserviceviatpes.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactionserviceviatpes $transactionserviceviatpe)
    {
        $transactionserviceviatpe->delete();
    
        return redirect()->route('transactionserviceviatpes.index')
                        ->with('success','transactionserviceviatpe supprimé');
    }
}
