<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactionserviceviamobile;


class TransactionserviceviamobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactionserviceviamobile = Transactionserviceviamobile::latest()->paginate(5);
        return view('transactionserviceviamobiles.index',compact('transactionserviceviamobile'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactionserviceviamobiles.create');
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
            'entreprise_id'=>'required',

        ]);

        Transactionserviceviamobile::create($request->all());
          return redirect()->route('transactionserviceviamobiles.index')
               ->with('success','transactionserviceviamobile crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('transactionserviceviamobiles.profile', [
            'transactionserviceviamobile' => Transactionserviceviamobile::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactionserviceviamobile $transactionserviceviamobile)
    {
        return view('transactionserviceviamobiles.edit',compact('transactionserviceviamobile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactionserviceviamobile $transactionserviceviamobile)
    {
        $request->validate([
            'montant' => 'required',
            'frais' => 'required',
            'type_transaction'=> 'required',
            'date_transaction'=>'required',
            'comptes_id'=>'required',
            'entreprise_id'=>'required',

        ]);
    
        $transactionserviceviamobile->update($request->all());
    
        return redirect()->route('transactionserviceviamobiles.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactionserviceviamobile $transactionserviceviamobile)
    {
        $transactionserviceviamobile->delete();
    
        return redirect()->route('transactionserviceviamobiles.index')
                        ->with('success','transactionserviceviamobile supprimé');
    }
}
