<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads ;

class EditarVacante extends Component
{   

    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria; 
    public $empresa; 
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    use withFileUploads;

    protected function rules()
    {
        return [
            'titulo' => 'required|string',
            'salario' => 'required',
            'categoria' => 'required',
            'empresa' => 'required',
            'ultimo_dia' => ['required', 'date', 'after_or_equal:' . Carbon::now()->format('d-m-Y')],
            'descripcion' => 'required',
            'imagen_nueva' => 'nullable|image|max:1024'
        ];
    }

    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id;
        $this->titulo=$vacante->titulo;
        $this->salario=$vacante->salario_id;
        $this->categoria=$vacante->categoria_id;
        $this->ultimo_dia=Carbon::parse( $vacante->ultimo_dia)->format('Y-m-d');
        $this->empresa=$vacante->empresa;
        $this->descripcion=$vacante->descripcion;
        $this->imagen=$vacante->imagen;
    }

    public function editarVacante()
    {
        
        $datos=$this->validate();

        //si hay una nueva imagen
        if($this->imagen_nueva){
            $imagen=$this->imagen_nueva->store('public/vacantes');
            $datos['imagen']=str_replace('public/vacantes/','',$imagen);
        }
        //encontrar la vacante a editar
        $vacante=Vacante::find($this->vacante_id);
        //asignar los valores
        $vacante->titulo=$datos['titulo'];
        $vacante->salario_id=$datos['salario'];
        $vacante->categoria_id=$datos['categoria'];
        $vacante->empresa=$datos['empresa'];
        $vacante->ultimo_dia=$datos['ultimo_dia'];
        $vacante->descripcion=$datos['descripcion'];
        $vacante->imagen=$datos['imagen'] ?? $vacante->imagen;
        
        //Guardar la vacante
        $vacante->save();
        //redireccionar
        session()->flash('mensaje','La vacante se actualizo correctamente');

        return redirect()->route('vacantes.index');
    }

    public function render()
    {

        //Consultar BD
        $salarios=Salario::all();
        $categorias=Categoria::all();
        return view('livewire.editar-vacante',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);

    }
}
