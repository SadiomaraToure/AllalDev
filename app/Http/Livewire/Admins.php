<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin;

class Admins extends Component
{


    public $admins,	$nom, $prenom, $telephone, $email, $sexe, $matricule, $profil;
    public $isOpen = 0;
  
    public function render()
    {
        $this->admins = Admin::all();
        return view('livewire.admins');
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
        $this->id = '';
        $this->nom = '';
        $this->prenom = '';
        $this->telephone = '';
        $this->email ='';
        $this->sexe ='';
        $this->matricule ='';
        $this->profil ='';
    }

    public function store()
    {
        $this->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'sexe' => 'required',
            'matricule' => 'required',
            'profil' => 'required',
        ]);
   
        Admin::updateOrCreate(['id' => $this->id], [
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone'=>$this->telephone,
            'email'=>$this->email,
            'sexe'=>$this->sexe,
            'matricule'=>$this->matricule,
            'profil'=>$this->profil
        ]);
  
        session()->flash('message', 
            $this->id ? 'Mise à jour effectué avec succés.' : 'Administrateur enregistré avec succés.');
  
        $this->closeModal();
        $this->resetInputFields();
    }
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $this->id = $id;
        $this->nom = $admin->nom;
        $this->prenom = $admin->prenom;
        $this->telephone = $admin->telephone;
        $this->email = $admin->email;
        $this->sexe = $admin->sexe;
        $this->matricule = $admin->matricule;
        $this->profil = $admin->profil;

    
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
       Admin::find($id)->delete();
        session()->flash('message', 'Administrateur supprimé.');
    }
}
