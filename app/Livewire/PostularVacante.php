<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    public $cv;
    public $vacante;
    use WithFileUploads;

    protected $rules=[
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante){
        $this->vacante=$vacante;
    }

    public function postularme(){
        $datos=$this->validate();

        if($this->vacante->candidatos()->where('user_id',auth()->user()->id)->count()>0){
            session()->flash('mensaje','Ya postulaste a esta vacante anteriormente');
        }
        else{
            //Guardar el CV
            $cv=$this->cv->store('public/cv');
            $datos['cv']=str_replace('public/cv/','',$cv);

            //Crear la el candidato a la vacante
            $this->vacante->candidatos()->create([
                'user_id' => auth()->user()->id,
                'cv' => $datos['cv']
            ]);
            //Crear notificacion y enviar email
            $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id,$this->vacante->titulo,auth()->user()->id));
            
            //Mostrar al usuario un mensaje de ok
            session()->flash('mensaje','Se envio correctamente tu información');

            return redirect()->back();
        }
       
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
