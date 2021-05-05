<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Arrondissement;
use App\Models\Departement;

class Arrondissements extends Component
{
    public $arrondissements, $nom, $departements_id, $arrondissement_id;
    public $isOpen = 0;

  
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->arrondissements = Arrondissement::all();

        $departs = Departement::all();

        return view('livewire.arrondissements',compact('departs'));
    }
  
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
        $this->nom = '';
        $this->departements_id = '';
        $this->arrondissement_id = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'nom' => 'required',
            'departements_id' => 'required',
        ]);
   
        Arrondissement::updateOrCreate(['id' => $this->arrondissement_id], [
            'nom' => $this->nom,
            'departements_id' => $this->departements_id
        ]);
       
  
        session()->flash('message', 
            $this->arrondissement_id ? 'arrondissement Updated Successfully.' : 'arrondissement Created Successfully.');
  
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
        $arrondissements = Arrondissement::findOrFail($id);
        $this->arrondissement_id = $id;
        $this->nom = $arrondissements->nom;
        $this->departements_id = $arrondissements->departements_id;
    
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Arrondissement::find($id)->delete();
        session()->flash('message', 'Arrondissement Deleted Successfully.');
    }
}
