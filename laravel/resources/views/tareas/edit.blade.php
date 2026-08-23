@extends('layouts.app')

@section('content')
    @php
        $categorias = \App\Models\Categoria::orderBy('nombre')->get();
    @endphp

    <div class="max-w-lg mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar tarea</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">Por favor, corrige los siguientes errores:</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tareas.update', $tarea) }}" class="bg-white rounded-xl shadow-md p-6">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="titulo" class="block text-gray-700 text-sm font-bold mb-2">Título</label>
                <input id="titulo" type="text" name="titulo" value="{{ old('titulo', $tarea->titulo) }}" required autofocus
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight
                           focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight
                           focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">{{ old('descripcion', $tarea->descripcion) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="categoria_id" class="block text-gray-700 text-sm font-bold mb-2">Categoría</label>
                <select id="categoria_id" name="categoria_id" required
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight
                           focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(old('categoria_id', $tarea->categoria_id) == $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="estado" class="block text-gray-700 text-sm font-bold mb-2">Estado</label>
                <select id="estado" name="estado"
                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight
                           focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                    @foreach (\App\Enums\EstadoTarea::cases() as $estado)
                        <option value="{{ $estado->value }}" @selected(old('estado', $tarea->estado?->value) == $estado->value)>
                            {{ ucfirst(str_replace('_', ' ', $estado->value)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('tareas.index') }}"
                    class="text-gray-600 hover:text-gray-800 font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
@endsection
