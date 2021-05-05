<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\AchatTicket;
use App\Models\Pointdevente;
use App\Models\Tpe;

class AuthController extends Controller
{
    //authentification côté user (application mobile)
    public function token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where("email", $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json(['user' => $user, 'token' => $user->createToken($user->name)->plainTextToken]);

    }

//////////////////////////////////-------------Authentification côté TPE-------------------////////////////////////////////////////////


//authentification côté tpe
public function authentificationTPE(Request $request)
{
    $request->validate([
        'login' => 'required',
        'pwd' => 'required',
    ]);

    $tpe = Tpe::where("login", $request->login)->first();

    if(!$tpe || !Hash::check($request->pwd, $tpe->pwd)) {
        throw ValidationException::withMessages([
            'login' => ['TPE non authentifier.'],
        ]);
    }

    return response()->json(['tpe' => $tpe, 'tokenTPE' => $tpe->createToken($tpe->sn)->plainTextToken]);

}
    
/////////////////////////////////////------------ACHAT DE TICKET CÖTE TPE--------------------/////////////////////////////////////////

public function getTicketparTPE(Request $request)
{
    $request->validate([
        'num_carte' => 'required',
        'prix_ticket' => 'required',
        'email' => 'required',
        'evenement_id' => 'required',
        'id_tpe' => 'required',
        
    ]);

   //creation objet AchatTicket et recherche id poinde de vente
   $ticket = new AchatTicket();
//recherche id point de vente
$tpe = Tpe::where("id", $request->id_tpe)->first();

        $ticket->montant = $request->prix_ticket;
        $ticket->qr_code = $request->num_carte;
        $ticket->email_acheteur = $request->email;
        $ticket->evenement_id = $request->evenement_id;
        $ticket->pointdevente_id = $tpe->ptvente->id;
        $ticket->save();



    if(!$ticket) {
        throw ValidationException::withMessages([
            'num_carte' => ['Données non valide pour acheterticket.'],
        ]);
    }

    return response()->json(['ticketEnregistrer' => $ticket]);
}


/////////////////////////////////////---------------Verification Ticket-----------------------//////////////////////////////////////////

public function autTicket(Request $request)
{
    $request->validate([
        'qr_code' => 'required',
        
    ]);

   

    $AchatTicket = AchatTicket::where("qr_code", $request->qr_code)->first();

    if(!$AchatTicket || $AchatTicket->etat==0) {
        throw ValidationException::withMessages([
            'qr_code' => ['Le ticket n est pas valide.'],
        ]);
    }

    return response()->json(['ticket' => $AchatTicket]);
}


///////////////////////////////---------------Mise a jour Ticket----------------////////////////////////////////////////////////////////


public function miseajourTicket(Request $request)
{
    $request->validate([
        'qr_code' => 'required',
        
    ]);

   

    $AchatTicket = AchatTicket::where("qr_code", $request->qr_code)->first();

    if(!$AchatTicket) {
        throw ValidationException::withMessages([
            'qr_code' => ['Echec Mise a jour Ticket.'],
        ]);
    }


    AchatTicket::updateOrCreate(['id'=> $AchatTicket->id], 
    [  
        'montant' => $AchatTicket->montant, 
        'qr_code' => $AchatTicket->qr_code, 
        'email_acheteur' => $AchatTicket->email_acheteur, 
        'evenement_id' => $AchatTicket->evenement_id, 
        'pointdevente_id' => $AchatTicket->pointdevente_id,
        'etat' => '0',
        'created_at' => $AchatTicket->created_at,
        'updated_at' => $AchatTicket->date

    ]);

   
}

//////////////////////////////////-----------Liste Ticket----------////////////////////////////////////////////////////////////////


//authentification
public function listeticket()
{

    $even = AchatTicket::all();

    if(!$even) {
        throw ValidationException::withMessages([
            'liste' => ['pas evenement en cours.'],
        ]);
    }

    return response()->json(['TICKETS' => $even]);
}


/////////////////////////////////////////------------------------//////////////////////////////////////////////////


    //enregistrement
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'telephone' => 'required',
            'sexe' => 'required',
            'adresse' => 'required',
            'num_carte_identite' => 'required',
        ]);

        

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->password = Hash::make($request->password);

        $user->telephone = $request->telephone;
        $user->sexe = $request->sexe;
        $user->adresse = $request->adresse;
        $user->num_carte_identite = $request->num_carte_identite;

        // $user->pointdeventes_id = Auth::user()->id;

        $user->save();

        return response()->json(['user' => $user, 'token' => $user->createToken($user->name)->plainTextToken]);
    }

    //affichage profil user
    public function profile(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }


    //rafraichir token
    public function refresh(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json(['token' => $user->createToken($user->name)->plainTextToken]);
    }
}