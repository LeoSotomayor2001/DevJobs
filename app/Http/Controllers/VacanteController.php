<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny',Vacante::class);

        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create',Vacante::class);
        return view('vacantes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show',[
            'vacante' => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {
        // Verifica si el usuario tiene permiso para actualizar la vacante
        if (Gate::authorize('update', $vacante)) {
            // El usuario tiene permiso, procede con la actualización de la vacante
        } else {
            // El usuario no tiene permiso, muestra un mensaje de error o redirige
            abort(403, 'No tienes permiso para actualizar esta vacante.');
        }

        return view('vacantes.edit',[
            'vacante' => $vacante
        ]);
    }

}
