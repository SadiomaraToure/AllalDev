<?php

namespace App\Http\Controllers;

use App\Models\Pointdevente;
use Illuminate\Http\Request;
use App\Models\Tpe;
use Illuminate\Support\Facades\Hash;

class TpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tpe = Tpe::latest()->paginate(5);

        $ptdevent = Pointdevente::all();

        return view('tpes.index', compact('tpe', 'ptdevent'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ptdevent = Pointdevente::all();

        return view('tpes.create', compact('ptdevent'));
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
            'sn' => 'required',
            'login' => 'required',
            'pwd'=> 'required',
            'pointdeventes_id'=>'required',

        ]);

        //contruction objet TPE
        $tpe = new Tpe();
        $tpe->sn = $request->sn;
        $tpe->login = $request->login;
        $tpe->pwd = Hash::make($request->pwd);
        $tpe->pointdeventes_id = $request->pointdeventes_id;

        $tpe->save();

          //Tpe::create($request->all());

          return redirect()->route('tpes.index')
               ->with('success','tpe crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tpes.profile', [
            'tpe' => Tpe::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tpe $tpe)
    {
        $ptdevent = Pointdevente::all();

        return view('tpes.edit',compact('tpe', 'ptdevent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tpe $tpe)
    {
        $request->validate([
            'sn' => 'required',
            'login' => 'required',
            'pwd'=> 'required',
            'pointdeventes_id'=>'required',

        ]);
    
        $tpe->update($request->all());
    
        return redirect()->route('tpes.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tpe $tpe)
    {
        $tpe->delete();
    
        return redirect()->route('tpes.index')
                        ->with('success','tpe supprimé');
    }
}
