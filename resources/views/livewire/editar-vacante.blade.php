<form class="w-1/2 space-y-5" wire:submit.prevent="editarVacante">

    <div>
       <x-input-label for="titulo" :value="__('Título Vacante')" />

       <x-text-input 
           id="titulo" 
           class="block mt-1 w-full" 
           type="text" 
           wire:model="titulo" 
           :value="old('titulo')" 
           placeholder="Título Vacante"
       />
       @error('titulo')
           <livewire:mostrar-alerta :message="$message"/>
       @enderror
   </div>

   <div>
       <x-input-label for="empresa" :value="__('Empresa')" />

       <x-text-input 
           id="empresa" 
           class="block mt-1 w-full" 
           type="text" 
           wire:model="empresa" 
           :value="old('empresa')" 
           placeholder="Nombre de la empresa"
       />
       @error('empresa')
           <livewire:mostrar-alerta :message="$message"/>
       @enderror
   </div>

   <div>
       <x-input-label for="ultimo_dia" :value="__('Ultimo dia para postularse')" />

       <x-text-input 
           id="ultimo_dia" 
           class="block mt-1 w-full" 
           type="date" 
           wire:model="ultimo_dia" 
           :value="old('ultimo_dia')" 
           
       />
       @error('ultimo_dia')
           <livewire:mostrar-alerta :message="$message"/>
        @enderror
   </div>
   <div>
       <x-input-label for="salario" :value="__('Salario Mensual')" />
       <select 
           wire:model="salario" 
           id="salario" 
           class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
       >
           <option value="">--Seleccione--</option>
           @foreach ($salarios as $salario)
           
            <option value="{{$salario->id}}">{{$salario->salario}}
           @endforeach
           </option>
       </select>
       @error('salario')
           <livewire:mostrar-alerta :message="$message"/>
       @enderror
   </div>

   <div>
       <x-input-label for="categoria" :value="__('Categoria')" />

       <select 
           wire:model="categoria" 
           id="categoria" 
           class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
       >
           <option value="">--Seleccione--</option>
               @foreach ($categorias as $categoria)
               
                   <option value="{{$categoria->id}}">{{$categoria->categoria}}
               @endforeach
           </option>
       </select>
       @error('categoria')
           <livewire:mostrar-alerta :message="$message"/>
       @enderror
   </div>
   <div>
       <x-input-label for="imagen" :value="__('Imagen')" />

       <x-text-input 
           id="imagen" 
           class="block mt-1 w-full" 
           type="file" 
           wire:model="imagen_nueva" 
           accept='image/*'
       />

       <div class="my-5 w-96">
            <x-input-label :value="__('Imagen Actual')" />
            <img src="{{asset('storage/vacantes/' . $imagen)}}" alt="{{'Imagen Vacante ' . $titulo}}">
       </div>

       <div class="my-5 w-96">
           @if ($imagen_nueva)
               Imagen Nueva:
               <img src="{{$imagen_nueva->temporaryUrl()}}" >
           @endif
       </div>
       @error('imagen_nueva')
           <livewire:mostrar-alerta :message="$message"/>
       @enderror
   </div>

   <div>
       <x-input-label for="descripcion" :value="__('Descripción Puesto')" />

       <textarea 
           wire:model="descripcion"     
           id="descripcion" 
           class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-72"
           placeholder="Descripción general del puesto"
       ></textarea>
       @error('descripcion')
           <livewire:mostrar-alerta :message="$message"/>
       @enderror
   </div>

  

   <x-primary-button class="w-full justify-center">
       {{ __('Guardar Cambios') }}
   </x-primary-button>

   
  
</form>

