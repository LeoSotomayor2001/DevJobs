<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class HomeVacantes extends Component
{
    protected $listeners=['terminosBusqueda' => 'buscar'];

    public $termino;
    public $categoria;
    public $salario;

    public function buscar($termino,$categoria,$salario){
       $this->termino=$termino;
       $this->categoria=$categoria;
       $this->salario=$salario;
      
    }

    public function render()
    {
        //$vacantes = Vacante::all();
 
        $vacantes = Vacante::when($this->termino, function($query) {
            $query->where( 'titulo','LIKE', "%" . $this->termino . "%" );
        })
        ->when($this->termino,function($query){
            $query->orWhere( 'empresa','LIKE', "%" . $this->termino . "%" );
        })
        ->when($this->categoria, function($query) {
            if($this->categoria !== '--Seleccione--')
            $query->where('categoria_id',$this->categoria);
        })
        ->when($this->salario, function($query) {
            if($this->salario !== '--Seleccione--')
            $query->where('salario_id',$this->salario);
        })
        
        ->get();
        
        return view('livewire.home-vacantes',[
            'vacantes' => $vacantes
        ]);
    }
}
