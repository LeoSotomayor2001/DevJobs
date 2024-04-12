<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Categoria;
use Livewire\Component;
use App\Models\Vacante;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;


class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected function rules()
    {
        return [
            'titulo' => 'required|string',
            'salario' => 'required',
            'categoria' => 'required',
            'empresa' => 'required',
            'ultimo_dia' => ['required', 'date', 'after_or_equal:' . Carbon::now()->format('d-m-Y')],
            'descripcion' => 'required',
            'imagen' => 'required|image|max:1024'
        ];
    }
    public function crearVacante(){

        $datos=$this->validate();

        //Guardar la imagen
        $imagen=$this->imagen->store('public/vacantes');
        $datos['imagen']=str_replace('public/vacantes/','',$imagen);
        //crear la vacante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id'=> $datos['salario'],
            'categoria_id'=> $datos['categoria'],
            'empresa'=> $datos['empresa'],
            'descripcion'=> $datos['descripcion'],
            'ultimo_dia'=> $datos['ultimo_dia'],
            'imagen'=> $datos['imagen'],
            'user_id'=> auth()->user()->id
        ]);
        //Crear un mensaje
        session()->flash('mensaje','La vacante fue creada correctamente');
        //redireccionar al usuario hacia las vacantes
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        //Consultar BD
        $salarios=Salario::all();
        $categorias=Categoria::all();
        return view('livewire.crear-vacante',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
