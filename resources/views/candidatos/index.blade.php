<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidatos para esta Vacante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-center mb-10">Listado de Candidatos para : {{$vacante->titulo}}</h1>
                    <div class="md:flex md:justify-center p-5">
                        
                        <ul class="divide-y divide-gray-200 w-full">
                            @forelse ($vacante->candidatos as $candidato)
                                <li class="p-3 flex items-center">
                                    <div class="flex-1">
                                        <p class="text-xl font-medium text-gray-800">
                                            {{$candidato->user->name}}
                                        </p>

                                        <p class="text-sm text-gray-600">
                                            {{$candidato->user->email}}
                                        </p>

                                        <p class="text-sm font-medium text-gray-600">
                                          Dia que se postuló: 
                                          <span class="font-normal">{{$candidato->created_at->diffForHumans()}}</span> 
                                        </p>
                                    </div>

                                    <div>
                                        <a 
                                            href="{{asset('storage/cv/' .$candidato->cv)}}"
                                            target="_blank"
                                            rel="noreferrer noopener"
                                            class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300
                                            text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Ver CV
                                        </a>
                                    </div>
                                </li>
                            @empty
                                <p class="text-sm text-center p-3 ">Todavia no hay candidatos para esta vacante</p>
                            @endforelse 
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>