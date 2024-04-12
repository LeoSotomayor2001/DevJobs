<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;

class MostrarVacante extends Component
{   
    public $vacante;
    
    public function render()
    {
        $ultimoDia = Carbon::parse($this->vacante->ultimo_dia)->format('d/m/Y');
        
        return view('livewire.mostrar-vacante',[
            'ultimo_dia' => $ultimoDia
        ]);
    }
}
