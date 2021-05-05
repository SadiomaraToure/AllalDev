<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Zone;
use App\Models\AchatTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
 //id admin createur evevement(a corriger) 
 $id_ad =Auth::user()->id;

        $evenement = Evenement::latest()->paginate(5);

        $zone= Zone::all();
        
      // return view('arrondissements.index',['arrondissement'=>$arrondissement, 'departs'=>$departs])

        return view('evenements.index',compact('evenement', 'zone'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }


    ////////////////////////////------------liste evenement côté POINT DE VENTE---------------///////////////////////////////////
   
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function listeEvenements()
    {
      //id admin createur evevement(a corriger) 
      $id_ad = Auth::user()->id;

        $evenement = Evenement::latest()->paginate(5);

        $zone= Zone::all();
        
      // return view('arrondissements.index',['arrondissement'=>$arrondissement, 'departs'=>$departs])

        return view('evenements.evenementsListe',compact('evenement', 'zone'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }
   
   ////////////////////////////////------------Achat TICKET----------/////////////////////////////////
   

   public function AchatTicket($id)
   {

     $evenements = Evenement::findOrFail($id);

       return view('evenements.acheterTicket', compact('evenements'));
      
   }

   ///////////////////////////////----------Enregistrer ACHAT--------------////////////////////////////

   public function EnregistrerTicket(Request $request)
    {
        $request->validate([
            'montant' => 'required', 
            'qr_code' => 'required', 
            'email_acheteur' => 'required', 
             'evenement_id' => 'required', 
             'pointdevente_id' => 'required',
                ]);

         AchatTicket::create($request->all());
          
         $ticketAchetes = AchatTicket::all();

    //mise a jour nombre place
    $even = Evenement::where("id", $request->evenement_id)->first();

    DB::table('evenements')
    ->where('id', $even->id)
    ->update(['nombre_place' => $even->nombre_place - 1]);

          return redirect()->route('listTic', compact('ticketAchetes'))
               ->with('i', (request()->input('page', 1) -1) * 5);
    }


   ////////////////////////////---------------------------///////////////////////////////

   public function listeTicket()
    {

        $ticketAchetes = AchatTicket::latest()->paginate(5);

        
      // return view('arrondissements.index',['arrondissement'=>$arrondissement, 'departs'=>$departs])

        return view('evenements.listeTicket',compact('ticketAchetes'))
        ->with('i', (request()->input('page', 1) -1) * 5);
    }

   /////////////////////////-----------------------/////////////////////
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones= Zone::all();
 
        return view('evenements.create', compact('zones'));
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
            'nom_evenement' => 'required',
            'date_evenement' => 'required',
            'liste_asc' => 'required',
            'lieu_evenement'=> 'required',
            'prix_ticket1'=>'required',
            //'prix_ticket2'=>'required',
           // 'prix_ticket3'=>'required',
            //'prix_ticket4'=>'required',
            'zone_id'=>'required',
            'admin_id'=>'required',
            'nombre_place'=>'required',

        ]);
        Evenement::create($request->all());
          return redirect()->route('evenements.index')
               ->with('success','Evenement crée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       

        return view('evenements.profile', [
            'evenement' => Evenement::FindOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evenement $evenement)
    {
        $zone= Zone::all();
      
        return view('evenements.edit',compact('evenement', 'zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evenement $evenement)
    {
        $request->validate([
            'nom_evenement' => 'required',
            'date_evenement' => 'required',
            'liste_asc' => 'required',
            'lieu_evenement'=> 'required',
            'prix_ticket1'=>'required',
            //'prix_ticket2'=>'required',
            //'prix_ticket3'=>'required',
            //'prix_ticket4'=>'required',
            'zone_id'=>'required',
            'admin_id'=>'required',
            'nombre_place'=>'required',

        ]);
    
        $evenement->update($request->all());
    
        return redirect()->route('evenements.index')
                        ->with('success','Mise a jour effectuer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
    
        return redirect()->route('evenements.index')
                        ->with('success','asc supprimé');
    }
}
