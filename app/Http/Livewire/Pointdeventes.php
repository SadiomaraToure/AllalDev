<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pointdevente;
use App\Models\Zone;
use App\Models\Admin;
use App\Models\Evenement;
use App\Models\Asc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pointdeventes extends Component
{
    
    public $pointdeventes, $adresse, $ascs_id, $admins_id, $pointdevente_id;
    public $isOpen = 0;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->pointdeventes = Pointdevente::all(); 

        $ascs = Asc::all();

        //on recupere le id du admin qui insert
         $admins_id=   Auth::user()->id; 
        

        return view('livewire.pointdeventes', compact('ascs', 'admins_id'));
    }


    //////////////---------------------------///////////////////

 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function achatTicket($id)
    {
        $evenements = Evenement::findOrFail($id);
       
        //liste des zones 
        $zones = Zone::all(); 
        
        return view('livewire.listeEvenementPointdevente', compact('evenements', 'zones')); 

        
    }

    ///////////////////////////////////-------------//////////////////

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function lisEven()
    {
        $evenements = DB::table('evenements')->get();
        return view('livewire.listeEvenementPointdevente', compact('evenements'));
    }
    ////////////----------------////////////////////
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->adresse = '';
        $this->ascs_id = '';
        $this->admins_id = Auth::user()->id;
        $this->pointdevente_id = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'adresse' => 'required',
            'ascs_id' => 'required',
            'admins_id' => 'required',
        ]);
   
        Pointdevente::updateOrCreate(['id' => $this->pointdevente_id], [
            'adresse' => $this->adresse,
            'ascs_id' => $this->ascs_id,
            'admins_id' => $this->admins_id
        ]);
  
        session()->flash('message', 
            $this->pointdevente_id ? 'Point de vente Updated Successfully.' : 'Point de vente Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $pointdeventes = Pointdevente::findOrFail($id);
        $this->pointdevente_id = $id;
        $this->adresse = $pointdeventes->adresse;
        $this->ascs_id = $pointdeventes->ascs_id;
        $this->admins_id = $pointdeventes->admins_id;
    
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Pointdevente::find($id)->delete();
        session()->flash('message', 'Point de vente Deleted Successfully.');
    }
}
