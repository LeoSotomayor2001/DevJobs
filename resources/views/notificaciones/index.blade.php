<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notificaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-center my-10">Mis Notificaciones</h1>
                    <div class="divide-y divide-gray-200">
                        @forelse ($notificaciones as $notificacion)
                            <div class="p-5 lg:flex lg:justify-between lg:items-center">
                                <div>
                                    <p>Tienes un candidato en:
                                        <span class="font-bold">{{ $notificacion->data['nombre_vacante'] }} - {{ $notificacion->created_at->diffForHumans() }}</span> 
                                    </p>
                                </div>
                                <div class="mt-5 lg:mt-0">
                                    <a 
                                        href="{{route('candidatos.index',$notificacion->data['id_vacante'])}}" 
                                        class="bg-indigo-500 p-3 text-sm uppercase font-bold text-white rounded-lg"
                                    >
                                        Ver Candidatos
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-600">No Hay Notificaciones Nuevas</p>
                        @endforelse
                    </div>

                    
                    <h1 class="text-2xl font-bold text-center my-10">Historial Notificaciones</h1>
                    <div class="divide-y divide-gray-200">
                        @forelse ($historialNotificaciones as $historialNotificacion)
                            <div class="p-5 lg:flex lg:justify-between lg:items-center">
                                <div>
                                    <p>Tienes un candidato en:
                                        <span class="font-bold">{{ $historialNotificacion->data['nombre_vacante'] }} - {{ $historialNotificacion->created_at->diffForHumans() }}</span> 
                                    </p>
                                </div>
                                <div class="mt-5 lg:mt-0">
                                    <a class="bg-indigo-500 p-3 text-sm uppercase font-bold text-white rounded-lg"
                                        href="{{ route('candidatos.index', $historialNotificacion->data['id_vacante']) }}">
                                        Ver candidatos
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-600">No Hay Notificaciones Nuevas</p>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $historialNotificaciones->links() }}
                    </div>
                 
                </div>                
            </div> 
        </div>
    </div>
</x-app-layout>