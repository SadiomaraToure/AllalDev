<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AchatTicket;
use App\Models\Pointdevente;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\generateRandomStringController;


class Achattickets extends Component
{
  
    public $achattickets, $montant, $qr_code, $email_acheteur, $evenement_id, $pointdevente_id, $achatticket_id;
    public $isOpen = 0;
   
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->achattickets = AchatTicket::all(); 
        //liste des zones 
        $achattickets = AchatTicket::all(); 
        //id admin createur evevement(a corriger) 
        $id_ad =Auth::user()->id; 
        
        return view('livewire.achattickets', compact('achattickets')); 
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
       
        $this->montant = ''; 
        $this->qr_code = ''; 
        $this->email_acheteur = '';
         $this->evenement_id = ''; 
         $this->admin_id =Auth::user()->id; 
         $this->achatticket_id = ''; 
        } 


         /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
         
         public function store() 
         { $this->validate([ 
            
             'montant' => 'required', 
            // 'qr_code' => 'required', 
             'email_acheteur' => 'required', 
            //  'evenement_id' => 'required', 
            //  'admin_id' => 'required',
              ]);

               $qr_code = new QRCodeController();
              // $qr_code->simpleQr();

              // $qr_code = new generateRandomStringController();
              // $qr_code->generateRandomString();
              
              AchatTicket::updateOrCreate(['id' => $this->achatticket_id], 
              [ 
                
           
              'montant' => $this->montant, 
              'qr_code' => $qr_code->simpleQr(), 
              'email_acheteur' => $this->email_acheteur, 
              'evenement_id' => '3', 
              'pointdevente_id' => Auth::user()->id 
              // 'admin_id' => Auth::user()->id 
            
               
              ]); 
              
              session()->flash('message', 
              $this->achatticket_id ? 'Achat Ticket Updated Successfully.' : 'Achat Ticket Created Successfully.'); 
              
              $this->closeModal(); 
              $this->resetInputFields(); } 
              
              
              /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
              
              public function edit($id) 
              { 
                  $achattickets = AchatTicket::findOrFail($id); 
                  $this->achatticket_id = $id; 
                
                  $this->montant = $achattickets->montant; 
                  $this->qr_code = $achattickets->qr_code; 
                  $this->email_acheteur = $achattickets->email_acheteur; 
                  $this->evenement_id = $achattickets->evenement_id; 
                  $this->admin_id = $achattickets->admin_id; 

                  $this->openModal(); 
                } 
                
///////////////////////////-------------------------///////////////////////

 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
              
    public function acheter($id) 
    { 
        $achattickets = AchatTicket::findOrFail($id); 
        $this->achatticket_id = $id; 
      
        $this->montant = $achattickets->montant; 
        $this->qr_code = $achattickets->qr_code; 
        $this->email_acheteur = $achattickets->email_acheteur; 
        $this->evenement_id = $achattickets->evenement_id; 
        $this->admin_id = $achattickets->admin_id; 

        $this->openModal(); 
      } 

////////////////////////////-----------------------////////////////////////////




               /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
                
                public function delete($id)
                 { 
                     AchatTicket::find($id)->delete(); 
                     session()->flash('message', 'Achat de ticket Deleted Successfully.'); 
                    }
}
