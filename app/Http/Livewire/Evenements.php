<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evenement;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;

class Evenements extends Component
{
    public $evenements, $nom_evenement, $date_evenement, $liste_asc, $lieu_evenement, $prix_ticket1, $prix_ticket2, $prix_ticket3, $prix_ticket4, $zone_id, $admin_id, $evenement_id;
    public $isOpen = 0;

  
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->evenements = Evenement::all(); 
        //liste des zones 
        $zones = Zone::all(); 
        //id admin createur evevement(a corriger) 
        $id_ad =Auth::user()->id; 
        
        return view('livewire.evenements', compact('zones')); 
    }

    

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
   public function create()
    { $this->resetInputFields();
         $this->openModal();
         } 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    
    public function openModal() 
    { $this->isOpen = true; }
    
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public function closeModal() 
    { $this->isOpen = false; } 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    private function resetInputFields()
    { 
        $this->nom_evenement = ''; 
        $this->date_evenement = ''; 
        $this->liste_asc = ''; 
        $this->lieu_evenement = '';
         $this->prix_ticket1 = ''; 
         $this->prix_ticket2 = 0.0; 
         $this->prix_ticket3 = 0.0; 
         $this->prix_ticket4 = 0.0; 
         $this->zone_id = ''; 
         $this->admin_id =Auth::user()->id; 
         $this->evenement_id = ''; 
        } 


         /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
         
         public function store() 
         { $this->validate([ 
            'nom_evenement' => 'required',
             'date_evenement' => 'required', 
             'liste_asc' => 'required', 
             'lieu_evenement' => 'required', 
             'prix_ticket1' => 'required', 
             'zone_id' => 'required', 
             'admin_id' => 'required',
              ]);
              
              Evenement::updateOrCreate(['id' => $this->evenement_id], 
              [ 
                'nom_evenement' => $this->nom_evenement,
              'date_evenement' => $this->date_evenement, 
              'liste_asc' => $this->liste_asc, 
              'lieu_evenement' => $this->lieu_evenement, 
              'prix_ticket1' => $this->prix_ticket1, 
              'prix_ticket2' => $this->prix_ticket2, 
              'prix_ticket3' => $this->prix_ticket3, 
              'prix_ticket4' => $this->prix_ticket4, 
              'zone_id' => $this->zone_id, 
              'admin_id' => Auth::user()->id 
              ]); 
              
              session()->flash('message', 
              $this->evenement_id ? 'Evenement Updated Successfully.' : 'Evenement Created Successfully.'); 
              
              $this->closeModal(); 
              $this->resetInputFields(); } 
              
              /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
              
              public function edit($id) 
              { 
                  $evenements = Evenement::findOrFail($id); 
                  $this->evenement_id = $id; 
                  $this->nom_evenement = $evenements->nom_evenement;
                  $this->date_evenement = $evenements->date_evenement; 
                  $this->liste_asc = $evenements->liste_asc; 
                  $this->lieu_evenement = $evenements->lieu_evenement; 
                  $this->prix_ticket1 = $evenements->prix_ticket1; 
                  $this->prix_ticket2 = $evenements->prix_ticket2; 
                  $this->prix_ticket3 = $evenements->prix_ticket3; 
                  $this->prix_ticket4 = $evenements->prix_ticket4; 
                  $this->zone_id = $evenements->zone_id; 
                  $this->admin_id = $evenements->admin_id; 

                  $this->openModal(); 
                } 
                
               /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
                
 public function delete($id)
      { 
        Evenement::find($id)->delete(); 
       session()->flash('message', 'Evenement Deleted Successfully.'); 
}


////////////////////////---------------------------////////////////////////////

    public function taketicket($id)
    {
                  $evenements = Evenement::findOrFail($id); 
                  $this->evenement_id = $id; 
                  $this->nom_evenement = $evenements->nom_evenement;
                  $this->date_evenement = $evenements->date_evenement; 
                  $this->liste_asc = $evenements->liste_asc; 
                  $this->lieu_evenement = $evenements->lieu_evenement; 
                  $this->prix_ticket1 = $evenements->prix_ticket1; 
                  $this->prix_ticket2 = $evenements->prix_ticket2; 
                  $this->prix_ticket3 = $evenements->prix_ticket3; 
                  $this->prix_ticket4 = $evenements->prix_ticket4; 
                  $this->zone_id = $evenements->zone_id; 
                  $this->admin_id = $evenements->admin_id; 

                  $this->openModal(); 
    }
 }

